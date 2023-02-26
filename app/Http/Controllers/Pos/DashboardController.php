<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Purchase;
use App\Models\Outlet;
use Auth;

class DashboardController extends Controller
{
    public function Dashboard(Request $request) {
        if(Auth::guard('admin')->check()){ 
            $id = Auth::guard('admin')->user()->id;
            $outlet_id = $request->session()->get('outletId');
            // $outlet_name = Outlet::where('id',$outlet_id)->pluck('name')->get();
            $produk_tersedia = Product::where('outlet_id',$outlet_id)->get()->count();
            $item_terjual = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->where('created_by',$id)->where('outlet_id',$outlet_id)->get()->count();
            $produk_dipesan = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('created_by',$id)->where('outlet_id',$outlet_id)->get()->count(); 
            $produk_kosong = Product::where('outlet_id',$outlet_id)->where('quantity',0)->get()->count();
            $stokProduk = Product::where('created_by',$id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->orderBy('quantity','desc')->get();
            $latestTransaction = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('admin.dashboard.dashboard',compact('produk_tersedia','item_terjual','produk_dipesan','produk_kosong','stokProduk','latestTransaction'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $outlet_id = Auth::guard('employee')->user()->outlet_id;
            $produk_tersedia = Product::where('outlet_id',$outlet_id)->get()->count();
            $item_terjual = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->where('created_by',$id)->where('outlet_id',$outlet_id)->get()->count();
            $produk_dipesan = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('created_by',$id)->where('outlet_id',$outlet_id)->get()->count(); 
            $produk_kosong = Product::where('outlet_id',$outlet_id)->where('quantity',0)->get()->count();
            $stokProduk = Product::where('created_by',$id)->where('outlet_id',$outlet_id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->orderBy('quantity','desc')->get();
            $latestTransaction = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->where('created_by',$id)->where('outlet_id',$outlet_id)->get();
            return view('employee.dashboard.dashboard',compact('produk_tersedia','item_terjual','produk_dipesan','produk_kosong','stokProduk','latestTransaction'));
        }
        
    }
}
