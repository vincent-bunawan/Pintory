<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function ProductAll(Request $request){
        if(Auth::guard('admin')->check()){
            $id = $request->session()->get('outletId');
            $product = Product::where('outlet_id',$id)->get();
            return view('backend.product.product_all',compact('product'));
        } else {
            $id = Auth::guard('employee')->user()->outlet_id;
            $product = Product::where('outlet_id',$id)->get();
            return view('employee.product.product_all',compact('product'));
        }
        

    } // End Method 


    public function ProductAdd(){
        iF(Auth::guard('admin')->check()) {
            $id = Auth::guard('admin')->user()->id;
            $supplier = Supplier::where('created_by',$id)->get();
            $category = Category::where('created_by',$id)->get();
            $unit = Unit::where('created_by',$id)->get();
            return view('backend.product.product_add',compact('supplier','category','unit'));
        }
    } // End Method 

    public function ProductStore(Request $request){

        iF(Auth::guard('admin')->check()) { 
            Product::insert([

                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'outlet_id' => $request->session()->get('outletId'),
                'quantity' => $request->quantity,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now(), 
            ]);
    
            $notification = array(
                'message' => 'Produk Berhasil Dibuat', 
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.product.all')->with($notification); 
        }
        

    } // End Method 

    public function ProductEdit($id){

        $id = Auth::guard('admin')->user()->id;
        $supplier = Supplier::where('created_by',$id)->get();
        $category = Category::where('created_by',$id)->get();
        $unit = Unit::where('created_by',$id)->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('product','supplier','category','unit'));
    } // End Method 



    public function ProductUpdate(Request $request){

        $product_id = $request->id;

         Product::findOrFail($product_id)->update([

            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id, 
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(), 
        ]);

        $notification = array(
            'message' => 'Produk Berhasil Diupdate', 
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product.all')->with($notification); 


    } // End Method 

    public function ProductDelete($id){

        Product::findOrFail($id)->delete();
             $notification = array(
             'message' => 'Produk Berhasil Dihapus', 
             'alert-type' => 'success'
         );
 
         return redirect()->back()->with($notification); 
 
     } // End Method 




}