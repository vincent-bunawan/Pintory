<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Auth;
use Illuminate\Support\Carbon;

class SupplierController extends Controller
{
    public function SupplierAll()
    {
        if (Auth::guard('admin')->check()) {
            $id = Auth::guard('admin')->user()->id;
            $suppliers = Supplier::where('created_by', $id)->get();
            return view('backend.supplier.supplier_all', compact('suppliers'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $suppliers = Supplier::where('created_by', $id)->get();
            return view('employee.supplier.supplier_all', compact('suppliers'));
        }
    }

    public function SupplierAdd()
    {
        if (Auth::guard('admin')->check()) {
            return view('backend.supplier.supplier_add');
        } else {
            return view('employee.supplier.supplier_add');
        }
    }

    public function SupplierStore(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Supplier::insert([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::guard('admin')->user()->id,
                'created_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Supplier Berhasil Dibuat',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.supplier.all')->with($notification);
        } else {
            Supplier::insert([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::guard('employee')->user()->owner_id,
                'created_at' => Carbon::now(),

            ]);
            $notification = array(
                'message' => 'Supplier Berhasil Dibuat',
                'alert-type' => 'success'
            );

            return redirect()->route('employee.supplier.all')->with($notification);
        }
    }

    public function SupplierEdit($id)
    {

        if (Auth::guard('admin')->check()) {
            $supplier = Supplier::findOrFail($id);
            return view('backend.supplier.supplier_edit', compact('supplier'));
        } else {
            $supplier = Supplier::findOrFail($id);
            return view('employee.supplier.supplier_edit', compact('supplier'));
        }
    } // End Method 

    public function SupplierUpdate(Request $request)
    {

        if (Auth::guard('admin')->check()) {
            $sullier_id = $request->id;

            Supplier::findOrFail($sullier_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' => Auth::guard('admin')->user()->id,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Supplier Berhasil Diupdate',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.supplier.all')->with($notification);
        } else {
            $sullier_id = $request->id;

            Supplier::findOrFail($sullier_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' => Auth::guard('employee')->user()->owner_id,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Supplier Berhasil Diupdate',
                'alert-type' => 'success'
            );

            return redirect()->route('employee.supplier.all')->with($notification);
        }
    } // End Method 

    public function SupplierDelete($id)
    {

        if (Auth::guard('admin')->check()) {
            Supplier::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Supplier Berhasil Dihapus',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method 
}
