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
use PDF;
use App\Exports\PurchasesExport;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends Controller
{
    public function PurchaseAll(Request $request){
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $outlet_id = $request->session()->get('outletId'); 
            $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('backend.purchase.purchase_all',compact('allData'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $outlet_id = Auth::guard('employee')->user()->outlet_id;
            $allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('employee.purchase.purchase_all',compact('allData'));
        }
        

    } // End Method 


    public function PurchaseAdd(){

        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id; 
            $supplier = Supplier::where('created_by',$id)->get();
        $unit = Unit::where('created_by',$id)->get();
        $category = Category::where('created_by',$id)->get();
        return view('backend.purchase.purchase_add',compact('supplier','unit','category'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id; 
            $supplier = Supplier::where('created_by',$id)->get();
        $unit = Unit::where('created_by',$id)->get();
        $category = Category::where('created_by',$id)->get();
        return view('employee.purchase.purchase_add',compact('supplier','unit','category'));
        }
        

    } // End Method 


    public function PurchaseStore(Request $request){

        if(Auth::guard('admin')->check()) { 
            if ($request->category_id == null) {

                $notification = array(
                 'message' => 'Sorry you do not select any item', 
                 'alert-type' => 'error'
             );
             return redirect()->back( )->with($notification);
             } else {
         
                 $count_category = count($request->category_id);
                 for ($i=0; $i < $count_category; $i++) { 
                     $purchase = new Purchase();
                     $purchase->outlet_id = $request->session()->get('outletId');
                     $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                     $purchase->purchase_no = $request->purchase_no[$i];
                     $purchase->supplier_id = $request->supplier_id[$i];
                     $purchase->category_id = $request->category_id[$i];
         
                     $purchase->product_id = $request->product_id[$i];
                     $purchase->buying_qty = $request->buying_qty[$i];
                     $purchase->unit_price = $request->unit_price[$i];
                     $purchase->buying_price = $request->buying_price[$i];
                     $purchase->description = $request->description[$i];
         
                     $purchase->created_by = Auth::guard('admin')->user()->id;
                     $purchase->status = '0';
                     $purchase->save();
                 } // end foreach
             } // end else 
         
             $notification = array(
                 'message' => 'Data Berhasil Disimpan', 
                 'alert-type' => 'success'
             );
             return redirect()->route('admin.purchase.all')->with($notification); 
        } else {
            if ($request->category_id == null) {

                $notification = array(
                 'message' => 'Sorry you do not select any item', 
                 'alert-type' => 'error'
             );
             return redirect()->back( )->with($notification);
             } else {
         
                 $count_category = count($request->category_id);
                 for ($i=0; $i < $count_category; $i++) { 
                     $purchase = new Purchase();
                     $purchase->outlet_id = Auth::guard('employee')->user()->outlet_id;
                     $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                     $purchase->purchase_no = $request->purchase_no[$i];
                     $purchase->supplier_id = $request->supplier_id[$i];
                     $purchase->category_id = $request->category_id[$i];
         
                     $purchase->product_id = $request->product_id[$i];
                     $purchase->buying_qty = $request->buying_qty[$i];
                     $purchase->unit_price = $request->unit_price[$i];
                     $purchase->buying_price = $request->buying_price[$i];
                     $purchase->description = $request->description[$i];
         
                     $purchase->created_by = Auth::guard('employee')->user()->owner_id;
                     $purchase->status = '0';
                     $purchase->save();
                 } // end foreach
             } // end else 
         
             $notification = array(
                 'message' => 'Data Berhasil Disimpan', 
                 'alert-type' => 'success'
             );
             return redirect()->route('employee.purchase.all')->with($notification);
        }

    
    } // End Method 


    public function PurchaseDelete($id){
        if(Auth::guard('admin')->check()){ 
            Purchase::findOrFail($id)->delete();

         $notification = array(
        'message' => 'Barang Stock In Berhasil Dihapus', 
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification); 
        }
        

    } // End Method 


    public function PurchasePending(Request $request){
        if(Auth::guard('admin')->check()){
            $outlet_id = $request->session()->get('outletId');
            $id = Auth::guard('admin')->user()->id; 
            $allData = Purchase::where('created_by',$id)->where('outlet_id',$id)->orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.purchase_pending',compact('allData'));
        } else {
            $outlet_id = Auth::guard('employee')->user()->outlet_id;
            $id = Auth::guard('employee')->user()->owner_id; 
            $allData = Purchase::where('created_by',$id)->where('outlet_id',$id)->orderBy('date','desc')->orderBy('id','desc')->where('status','0')->where('created_by',$id)->where('outlet_id',$id)->get();
            return view('employee.purchase.purchase_pending',compact('allData'));
        }
        
    }// End Method 


    public function PurchaseApprove($id){
        if(Auth::guard('admin')->check()){ 
            $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);

             $notification = array(
        'message' => 'Berhasil Status Approved', 
        'alert-type' => 'success'
          );
    return redirect()->route('admin.purchase.all')->with($notification); 

        }
        }
        

    }// End Method 

    public function PurchaseReject($id){
        if(Auth::guard('admin')->check()){ 
            $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => '2',
            ]);

             $notification = array(
        'message' => 'Berhasil Status Rejected', 
        'alert-type' => 'warning'
          );
    return redirect()->route('admin.purchase.all')->with($notification); 

        }
        }
    }

    public function DailyPurchaseReport(){
        if(Auth::guard('admin')->check()){ 
            return view('backend.purchase.daily_purchase_report');
        } else {
            return view('employee.purchase.daily_purchase_report');
        }
        
    } // End Method

    public function DailyPurchasePdf(Request $request){
        if(Auth::guard('admin')->check()){ 
            $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $outlet_id = $request->session()->get('outletId');
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        

        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('backend.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));
        } else {
            $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $outlet_id = Auth::guard('employee')->user()->outlet_id;
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        

        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('employee.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));
        }
        
    } // End Method

    public function PrintDailyPurchasePdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $outlet_id = $request->session()->get('outletId') || Auth::guard('employee')->user()->outlet_id;
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadview('backend.pdf.purchase_report_pdf',compact('allData','start_date','end_date'));
        $pdf->setPaper('A4','potrait');    
	    return $pdf->download('daily_purchase_report.pdf');
    }

    public function ExportDailyPurchase(Request $request){
        return Excel::download(new PurchasesExport($request), 'purchases.xlsx');
    }



}
  