<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Outlet;
use Illuminate\Support\Carbon;

class OutletController extends Controller
{
    public function OutletAll() {
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $outlets = Outlet::where('created_by',$id)->get();
            return view('admin.outlet.outlet_all',compact('outlets'));
        }
    }

    public function OutletAdd() {
        if(Auth::guard('admin')->check()){
            return view('admin.outlet.outlet_add');
        }
    }

    public function OutletFirstAdd() {
        if(Auth::guard('admin')->check()){
            return view('admin.outlet.outlet_first_add');
        }
    }

    public function OutletStore(Request $request) {
        Outlet::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'owner_id' => Auth::guard('admin')->user()->id,
            'created_by' => Auth::guard('admin')->user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.outlet.all')->with('Error','Outlet Berhasil Dibuat');
    }

    public function OutletChoose(Request $request) {
        $request->session()->put('outletId',(int)$request->id);
        // dd($request->session()->put('outletId',(int)$request->id));
        return redirect()->route('admin.dashboard');
    }

    public function OutletEdit($id){
        if(Auth::guard('admin')->check()){ 
            $outlet = Outlet::findOrFail($id);
            return view ('admin.outlet.outlet_edit',compact('outlet'));
        }
    }

    public function OutletUpdate(Request $request){
        if(Auth::guard('admin')->check()){
            $outlet_id = $request->id;

            Outlet::findOrFail($outlet_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address
            ]);

            $notification = array(
                'message' => 'Outlet Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.outlet.all')->with($notification);
        }
    }
}
