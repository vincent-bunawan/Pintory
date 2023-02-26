<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Illuminate\Support\Carbon;
use Image;

class CustomerController extends Controller
{
    public function CustomerAll(){
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $customers = Customer::where('created_by',$id)->get();
            return view('backend.customer.customer_all',compact('customers'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $customers = Customer::where('created_by',$id)->get();
            return view('employee.customer.customer_all',compact('customers'));
}
         

    } // End Method


    public function CustomerAdd(){
        if(Auth::guard('admin')->check()){ 
            return view('backend.customer.customer_add');
        } else {
            return view('employee.customer.customer_add');
        }
     
    }    // End Method


    public function CustomerStore(Request $request){

        // $image = $request->file('customer_image');
        // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
        // Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        // $save_url = 'upload/customer/'.$name_gen;
        if(Auth::guard('admin')->check()){ 
            Customer::insert([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                // 'customer_image' => $save_url ,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now(),
    
            ]);
    
             $notification = array(
                'message' => 'Customer Berhasil Dibuat', 
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.customer.all')->with($notification);
        } else {
            Customer::insert([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                // 'customer_image' => $save_url ,
                'created_by' => Auth::guard('employee')->user()->owner_id,
                'created_at' => Carbon::now(),
    
            ]);
    
             $notification = array(
                'message' => 'Customer Berhasil Dibuat', 
                'alert-type' => 'success'
            );
    
            return redirect()->route('employee.customer.all')->with($notification);
        }
        

    } // End Method


    public function CustomerEdit($id){
    
       if(Auth::guard('admin')->check()){
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit',compact('customer')); 
       } else {
        $customer = Customer::findOrFail($id);
        return view('employee.customer.customer_edit',compact('customer'));
       }
       

    } // End Method


    public function CustomerUpdate(Request $request){

        if(Auth::guard('admin')->check()){ 
            $customer_id = $request->id;
    
        Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            // 'customer_image' => $save_url ,
            'updated_by' => Auth::guard('admin')->user()->id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Berhasil Diupdate', 
            'alert-type' => 'success'
        );

        return redirect()->route('admin.customer.all')->with($notification);
        } else {

          Customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address, 
            'updated_by' => Auth::guard('employee')->user()->owner_id,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Customer Berhasil Diupdate', 
            'alert-type' => 'success'
        );

        return redirect()->route('employee.customer.all')->with($notification);

        } // end else 

    } // End Method


    public function CustomerDelete($id){

        if(Auth::guard('admin')->check()){
            Customer::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Customer Berhasil Dihapu', 
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
        

    } // End Method





}
 