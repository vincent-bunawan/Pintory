<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;  


class UnitController extends Controller
{
    public function UnitAll(){
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
            $units = Unit::where('created_by',$id)->get();
            return view('backend.unit.unit_all',compact('units'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $units = Unit::where('created_by',$id)->get();
            return view('employee.unit.unit_all',compact('units'));
        }
        
    }
    public function UnitAdd(){
        if(Auth::guard('admin')->check()){ 
            return view('backend.unit.unit_add');
        } else {
            return view('employee.unit.unit_add');
        }
        
    }
    public function UnitStore(Request $request){
        if(Auth::guard('admin')->check()){ 
            Unit::insert([
                'name' => $request->name, 
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now(), 
            ]);
            $notification = array(
                'message' => 'Unit Berhasil Dibuat',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.unit.all')->with($notification);
        } 
        // else {
        //     Unit::insert([
        //         'name' => $request->name, 
        //         'created_by' => Auth::guard('employee')->user()->owner_id,
        //         'created_at' => Carbon::now(), 
        //     ]);
        //     $notification = array(
        //         'message' => 'Unit Inserted Successfully',
        //         'alert-type' => 'success'
        //     );
        //     return redirect()->route('employee.unit.all')->with($notification);
        // }
        
    }
    public function UnitEdit($id){
        if(Auth::guard('admin')->check()){ 
            $unit = Unit::findOrFail($id);
      return view('backend.unit.unit_edit',compact('unit'));
        } else {
            $unit = Unit::findOrFail($id);
      return view('employee.unit.unit_edit',compact('unit'));
        }
        

  }// End Method 


  public function UnitUpdate(Request $request){

    if(Auth::guard('admin')->check()){ 
        $unit_id = $request->id;

      Unit::findOrFail($unit_id)->update([
          'name' => $request->name, 
          'updated_by' => Auth::guard('admin')->user()->id, 
          'updated_at' => Carbon::now(), 

      ]);

       $notification = array(
          'message' => 'Unit Berhasil Diupdate', 
          'alert-type' => 'success'
      );

      return redirect()->route('admin.unit.all')->with($notification);
    } else {
        $unit_id = $request->id;

      Unit::findOrFail($unit_id)->update([
          'name' => $request->name, 
          'updated_by' => Auth::guard('employee')->user()->owner_id,  
          'updated_at' => Carbon::now(), 

      ]);

       $notification = array(
          'message' => 'Unit Berhasil Diupdate', 
          'alert-type' => 'success'
      );

      return redirect()->route('employee.unit.all')->with($notification);
    }
      

  }// End Method 


  public function UnitDelete($id){

    if(Auth::guard('admin')->check()){ 
        Unit::findOrFail($id)->delete();

     $notification = array(
          'message' => 'Unit Berhasil Dihapus', 
          'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);
    }
        

  } // End Method 
}
