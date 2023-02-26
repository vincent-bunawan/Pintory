<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Customer;
use DB;
use PDF;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function InvoiceAll(Request $request){
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $outlet_id = $request->session()->get('outletId');
            $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('backend.invoice.invoice_all',compact('allData'));
        } else {
            // dd(Auth::guard('employee')->user());
            $id = Auth::guard('employee')->user()->owner_id;
            $outlet_id = Auth::guard('employee')->user()->outlet_id;
            $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('employee.invoice.invoice_all',compact('allData'));
        }
        

    } // End Method


    public function invoiceAdd(){ 

        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $costomer = Customer::where('created_by',$id)->get();
            $category = Category::where('created_by',$id)->get();
            $invoice_data = Invoice::orderBy('id','desc')->first();

            if ($invoice_data == null) {
                $firstReg = '0';
                $invoice_no = $firstReg+1;
             }else{
                 $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
                 $invoice_no = $invoice_data+1;
             }
             $date = date('Y-m-d');
             return view('backend.invoice.invoice_add',compact('invoice_no','category','date','costomer'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $costomer = Customer::where('created_by',$id)->get();
            $category = Category::where('created_by',$id)->get();
            $invoice_data = Invoice::orderBy('id','desc')->first();

            if ($invoice_data == null) {
                $firstReg = '0';
                $invoice_no = $firstReg+1;
             }else{
                 $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
                 $invoice_no = $invoice_data+1;
             }
             $date = date('Y-m-d');
             return view('employee.invoice.invoice_add',compact('invoice_no','category','date','costomer'));
        }

    } // End Method


    public function InvoiceStore(Request $request){
    
    if(Auth::guard('admin')->check()) {
        if ($request->category_id == null) {

            $notification = array(
             'message' => 'Sorry You do not select any item', 
             'alert-type' => 'error'
         );
         return redirect()->back()->with($notification);
     
         } else{
             if ($request->paid_amount > $request->estimated_amount) {
     
                $notification = array(
             'message' => 'Sorry Paid Amount is Maximum the total price', 
             'alert-type' => 'error'
         );
         return redirect()->back()->with($notification);
     
             } else {
     
         $invoice = new Invoice();
         $invoice->invoice_no = $request->invoice_no;
         $invoice->date = date('Y-m-d',strtotime($request->date));
         $invoice->description = $request->description;
         $invoice->status = '0';
         $invoice->created_by = Auth::guard('admin')->user()->id;
         $invoice ->outlet_id = $request->session()->get('outletId');

        //  dd($invoice);
     
         DB::transaction(function() use($request,$invoice){
             if ($invoice->save()) {
                $count_category = count($request->category_id);
                for ($i=0; $i < $count_category ; $i++) { 
     
                   $invoice_details = new InvoiceDetail();
                   $invoice_details->date = date('Y-m-d',strtotime($request->date));
                   $invoice_details->invoice_id = $invoice->id;
                   $invoice_details->category_id = $request->category_id[$i];
                   $invoice_details->product_id = $request->product_id[$i];
                   $invoice_details->selling_qty = $request->selling_qty[$i];
                   $invoice_details->unit_price = $request->unit_price[$i];
                   $invoice_details->selling_price = $request->selling_price[$i];
                   $invoice_details->status = '0'; 
                   $invoice_details->save(); 
                }
     
                 if ($request->customer_id == '0') {
                     $customer = new Customer();
                     $customer->name = $request->name;
                     $customer->mobile_no = $request->mobile_no;
                     $customer->email = $request->email;
                     $customer->save();
                     $customer_id = $customer->id;
                 } else{
                     $customer_id = $request->customer_id;
                 } 
     
                 $payment = new Payment();
                 $payment_details = new PaymentDetail();
     
                 $payment->invoice_id = $invoice->id;
                 $payment->customer_id = $customer_id;
                 $payment->paid_status = $request->paid_status;
                 $payment->discount_amount = $request->discount_amount;
                 $payment->total_amount = $request->estimated_amount;
     
                 if ($request->paid_status == 'full_paid') {
                     $payment->paid_amount = $request->estimated_amount;
                     $payment->due_amount = '0';
                     $payment_details->current_paid_amount = $request->estimated_amount;
                 } elseif ($request->paid_status == 'full_due') {
                     $payment->paid_amount = '0';
                     $payment->due_amount = $request->estimated_amount;
                     $payment_details->current_paid_amount = '0';
                 }elseif ($request->paid_status == 'partial_paid') {
                     $payment->paid_amount = $request->paid_amount;
                     $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                     $payment_details->current_paid_amount = $request->paid_amount;
                 }
                 $payment->save();
     
                 $payment_details->invoice_id = $invoice->id; 
                 $payment_details->date = date('Y-m-d',strtotime($request->date));
                 $payment_details->save(); 
             } 
     
                 }); 
     
             } // end else 
         }
     
          $notification = array(
             'message' => 'Invoice Data Inserted Successfully', 
             'alert-type' => 'success'
         );
         return redirect()->route('admin.invoice.pending.list')->with($notification);
    } else {
        if ($request->category_id == null) {

            $notification = array(
             'message' => 'Sorry You do not select any item', 
             'alert-type' => 'error'
         );
         return redirect()->back()->with($notification);
     
         } else{
             if ($request->paid_amount > $request->estimated_amount) {
     
                $notification = array(
             'message' => 'Sorry Paid Amount is Maximum the total price', 
             'alert-type' => 'error'
         );
         return redirect()->back()->with($notification);
     
             } else {
     
         $invoice = new Invoice();
         $invoice->invoice_no = $request->invoice_no;
         $invoice->date = date('Y-m-d',strtotime($request->date));
         $invoice->description = $request->description;
         $invoice->status = '0';
         $invoice->created_by = Auth::guard('employee')->user()->owner_id;
         $invoice ->outlet_id = $request->session()->get('outletId');
     
         DB::transaction(function() use($request,$invoice){
             if ($invoice->save()) {
                $count_category = count($request->category_id);
                for ($i=0; $i < $count_category ; $i++) { 
     
                   $invoice_details = new InvoiceDetail();
                   $invoice_details->date = date('Y-m-d',strtotime($request->date));
                   $invoice_details->invoice_id = $invoice->id;
                   $invoice_details->category_id = $request->category_id[$i];
                   $invoice_details->product_id = $request->product_id[$i];
                   $invoice_details->selling_qty = $request->selling_qty[$i];
                   $invoice_details->unit_price = $request->unit_price[$i];
                   $invoice_details->selling_price = $request->selling_price[$i];
                   $invoice_details->status = '0'; 
                   $invoice_details->save(); 
                }
     
                 if ($request->customer_id == '0') {
                     $customer = new Customer();
                     $customer->name = $request->name;
                     $customer->mobile_no = $request->mobile_no;
                     $customer->email = $request->email;
                     $customer->save();
                     $customer_id = $customer->id;
                 } else{
                     $customer_id = $request->customer_id;
                 } 
     
                 $payment = new Payment();
                 $payment_details = new PaymentDetail();
     
                 $payment->invoice_id = $invoice->id;
                 $payment->customer_id = $customer_id;
                 $payment->paid_status = $request->paid_status;
                 $payment->discount_amount = $request->discount_amount;
                 $payment->total_amount = $request->estimated_amount;
     
                 if ($request->paid_status == 'full_paid') {
                     $payment->paid_amount = $request->estimated_amount;
                     $payment->due_amount = '0';
                     $payment_details->current_paid_amount = $request->estimated_amount;
                 } elseif ($request->paid_status == 'full_due') {
                     $payment->paid_amount = '0';
                     $payment->due_amount = $request->estimated_amount;
                     $payment_details->current_paid_amount = '0';
                 }elseif ($request->paid_status == 'partial_paid') {
                     $payment->paid_amount = $request->paid_amount;
                     $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                     $payment_details->current_paid_amount = $request->paid_amount;
                 }
                 $payment->save();
     
                 $payment_details->invoice_id = $invoice->id; 
                 $payment_details->date = date('Y-m-d',strtotime($request->date));
                 $payment_details->save(); 
             } 
     
                 }); 
     
             } // end else 
         }
     
          $notification = array(
             'message' => 'Invoice Data Inserted Successfully', 
             'alert-type' => 'success'
         );
         return redirect()->route('employee.invoice.pending.list')->with($notification);
    }

      
    } // End Method


    public function PendingList(Request $request){
        if(Auth::guard('admin')->check()){
            $outlet_id = $request->session()->get('outletId');
            $id = Auth::guard('admin')->user()->id;
            $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->where('created_by',$id)->where('outlet_id',$id)->get();
            return view('backend.invoice.invoice_pending_list',compact('allData'));
        } else {
            $outlet_id = $request->session()->get('outletId');
            $id = Auth::guard('employee')->user()->owner_id;
            $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('employee.invoice.invoice_pending_list',compact('allData'));
        }
        
    } // End Method



    public function InvoiceDelete($id){
        if(Auth::guard('admin')->check()){
            $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete(); 
        Payment::where('invoice_id',$invoice->id)->delete(); 
        PaymentDetail::where('invoice_id',$invoice->id)->delete(); 

         $notification = array(
        'message' => 'Invoice Berhasil Dihapus', 
        'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
        }
    }// End Method

    public function InvoiceApprove($id){

        if(Auth::guard('admin')->check()){
            $invoice = Invoice::findOrFail($id);
            $invoice = Invoice::with('invoice_details')->findOrFail($id);
            return view('backend.invoice.invoice_approve',compact('invoice'));
        }
    
    }// End Method

    public function InvoiceReject($id){

        if(Auth::guard('admin')->check()){
            $invoice = Invoice::findOrFail($id);
            $invoice = Invoice::with('invoice_details')->findOrFail($id);
            return view('backend.invoice.invoice_reject',compact('invoice'));
        }
    
    }// End Method

    public function ApprovalStore(Request $request, $id){
        if(Auth::guard('admin')->check()){
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $product = Product::where('id',$invoice_details->product_id)->first();
                if($product->quantity < $request->selling_qty[$key]){
    
            $notification = array(
            'message' => 'Maaf, Stok produk ini sudah habis', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification); 
    
                }
            } // End foreach 
    
            $invoice = Invoice::findOrFail($id);
            $invoice->updated_by = Auth::guard('admin')->user()->id;
            $invoice->status = '1';
    
            DB::transaction(function() use($request,$invoice,$id){
                foreach($request->selling_qty as $key => $val){
                 $invoice_details = InvoiceDetail::where('id',$key)->first();
                 $product = Product::where('id',$invoice_details->product_id)->first();
                 $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                 $product->save();
                } // end foreach
    
                $invoice->save();
            });
    
        $notification = array(
            'message' => 'Invoice Approve Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('admin.invoice.pending.list')->with($notification); 
    
        }
    } // End Method

    public function RejectStore(Request $request, $id){
        if(Auth::guard('admin')->check()){
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $product = Product::where('id',$invoice_details->product_id)->first();
                if($product->quantity < $request->selling_qty[$key]){
    
            $notification = array(
            'message' => 'Maaf, Stok produk ini sudah habis', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification); 
    
                }
            } // End foreach 
    
            $invoice = Invoice::findOrFail($id);
            $invoice->updated_by = Auth::guard('admin')->user()->id;
            $invoice->status = '2';
    
            // DB::transaction(function() use($request,$invoice,$id){
            //     foreach($request->selling_qty as $key => $val){
            //      $invoice_details = InvoiceDetail::where('id',$key)->first();
            //      $product = Product::where('id',$invoice_details->product_id)->first();
            //      $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
            //      $product->save();
            //     } // end foreach
    
            //     $invoice->save();
            // });
    
        $notification = array(
            'message' => 'Invoice Ditolak', 
            'alert-type' => 'error'
        );
        return redirect()->route('admin.invoice.pending.list')->with($notification); 
    
        }
    } // End Method

    public function DailyInvoiceReport(){
        if(Auth::guard('admin')->check()){
            return view('backend.invoice.daily_invoice_report');
        } else {
            return view('employee.invoice.daily_invoice_report');
        }
        
    } // End Method

    public function DailyInvoicePdf(Request $request){

        if(Auth::guard('admin')->check()){
            $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $outlet_id = $request->session()->get('outletId');
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        // dd($outlet_id);


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('backend.pdf.daily_invoice_report_pdf',compact('allData','start_date','end_date'));
        } else {
            $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $outlet_id = Auth::guard('employee')->user()->outlet_id;
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        // dd($outlet_id);


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('employee.pdf.daily_invoice_report_pdf',compact('allData','start_date','end_date'));
        }
        
        

        // $pdf = PDF::loadview('backend.pdf.daily_invoice_report_pdf',['invoice'=>$allData]);
	    // return $pdf->download('backend.pdf.daily_invoice_report_pdf');
    } // End Method

    public function PrintDailyInvoicePdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $outlet_id = $request->session()->get('outletId') || Auth::guard('employee')->user()->outlet_id;
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        // // $start_date = date('Y-m-d',strtotime($request->start_date));
        // // $end_date = date('Y-m-d',strtotime($request->end_date));
        // // return view('backend.pdf.daily_invoice_report_pdf',compact('allData','start_date','end_date'));
        $pdf = PDF::loadview('backend.pdf.invoice_report_pdf',compact('allData','start_date','end_date'));
        $pdf->setPaper('A4','potrait');
	    return $pdf->download('daily_invoice_report.pdf');
    } // End Method

    public function ExportDailyInvoice(Request $request){
        return Excel::download(new InvoicesExport($request), 'invoices.xlsx');
    }


}
 