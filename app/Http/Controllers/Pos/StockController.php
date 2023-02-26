<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use DB;
use PDF;
use App\Exports\StocksExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class StockController extends Controller
{
    public function StockReport(Request $request){
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $outlet_id = $request->session()->get('outletId');
            $allData = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
            return view('backend.stock.stock_report',compact('allData'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $outlet_id = Auth::guard('employee')->user()->owner_id;
            $allData = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
            return view('employee.stock.stock_report',compact('allData'));
        }
        

    } // End Method

    public function StockReportPdf(){
        if(Auth::guard('admin')->check()){ 
            $id = Auth::guard('admin')->user()->id;
            $allData = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
            return view('backend.pdf.stock_report_pdf',compact('allData'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $allData = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
            return view('employee.pdf.stock_report_pdf',compact('allData'));
        }
        

    } // End Method

    public function PrintStockReportPdf(Request $request){
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $outlet_id = $request->session()->get('outletId');
            $allData = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
            $pdf = PDF::loadview('backend.pdf.stock_report_print_pdf',compact('allData'));
            $pdf->setPaper('A4','potrait');
	        return $pdf->download('stock_report.pdf');
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $outlet_id = Auth::guard('employee')->user()->owner_id;
            $allData = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
            $pdf = PDF::loadview('employee.pdf.stock_report_print_pdf',compact('allData'));
            $pdf->setPaper('A4','potrait');
	        return $pdf->download('stock_report.pdf');
        }
    } // End Method

    public function ExportStock(Request $request){
        return Excel::download(new StocksExport($request), 'stocks.xlsx');
    }





}