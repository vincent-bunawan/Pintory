<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

class EmployeeController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.login.form')->with($notification);
    } // End Method 

    public function EmployeeAll()
    {
        $id = Auth::guard('admin')->user()->id;
        $employees = Employee::where('owner_id', $id)->get();
        // dd($employees);
        // dd($employees);
        return view('admin.employee.employee_all', compact('employees'));
    }

    public function EmployeeAdd()
    {
        $id = Auth::guard('admin')->user()->id;
        $outlet = Outlet::where('created_by', $id)->get();
        return view('admin.employee.employee_add', compact('outlet'));
    }

    public function Index()
    {
        return view('employee.employee_login');
    }

    public function LoginEmployee(Request $request)
    {
        // $check = $request->all();
        // dd($check['email']);
        if (Auth::guard('employee')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('employee.dashboard')->with('error', 'Employee Login Successfully');
        } else {
            return back()->with('error', 'Invalid Email Or Password');
        }
    }

    public function Dashboard()
    {
        return view('employee.index');
    }

    public function EmployeeStore(Request $request)
    {
        // Employee::insert([
        //     'name' = $request->name,
        //     'email' = $request->email,
        //     'password' = Hash::make($request->password),
        //     'position' = $request->position,
        //     'mobile_no' = $request->mobile_no,
        //     'address' = $request->address,
        //     'created_at' = Carbon::now(),
        // ]);
        // dd($request->session()->get('outletId'));
        Employee::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'outlet_id' => $request->session()->get('outletId'),
            'owner_id' => Auth::guard('admin')->user()->id,
            'email_verified_at' => Carbon::now(),

        ]);

        return redirect()->route('employee.all')->with('Error', 'Karyawan Berhasil Dibuat');
    }

    public function EmployeeEdit($id)
    {

        if (Auth::guard('admin')->check()) {
            // dd($id);
            $employee = Employee::findOrFail($id);
            return view('admin.employee.employee_edit', compact('employee'));
        }
    } // End Method

    public function EmployeeUpdate(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $employee_id = $request->id;

            // dd($request);

            Employee::findOrFail($employee_id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                // 'password' => Hash::make($request->password),    
                'position' => $request->position,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
            ]);

            // dd($request);

            $notification = array(
                'message' => 'Karyawan Berhasil Diupdate',
                'alert-type' => 'success'
            );
            return redirect()->route('employee.all')->with($notification);
        }
    }

    public function EmployeeDelete($id)
    {
        if (Auth::guard('admin')->check()) {
            Employee::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Karyawan Berhasil Dihapus',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
