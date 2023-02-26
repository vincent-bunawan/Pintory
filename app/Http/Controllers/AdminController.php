<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Auth;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    //     //OR
    //     // $this->middleware('web');
    // }
     public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User berhasil keluar', 
            'alert-type' => 'success'
        );

        return redirect()->route('admin.login.form')->with($notification);
    } // End Method 

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form')->with('status','Owner Logout Successfully');
    }

    public function Index() {
        // $id = Auth::guard('admin')->user()->id;
        // $outlet = Outlet::where('created_by',$id)->get();
        // if(!$outlet){
        //     return route('admin.create_outlet');
        // } else {
        //     return view('admin.admin_login');
        // }
        return view('admin.admin_login');
    }

    public function LoginAdmin(Request $request){
        // $check = $request->all();
        // dd($check['email']);
        if(Auth::guard('admin')->attempt(['email' => $request->input('email'),'password' => $request->input('password') ])){
            $id = Auth::guard('admin')->user()->id;
        $outlet = Outlet::where('created_by',$id)->get();
        // dd(sizeof($outlet) == 0);
        if(sizeof($outlet) == 0){
            // dd('asdadasd');
            return redirect()->route('admin.outlet.first.add');
        } else {
            return redirect()->route('admin.outlet.all');
        }
        //     return redirect()->route('admin.dashboard')->with('error','Owner Login Successfully');
        // } 
    } else {
            return back()->with('error','Invalid Email Or Password');
        }
    }

    public function RegisterAdmin(){
        return view('admin.admin_register');
    }

    public function StoreAdmin(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string','max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Admin::insert([
            'name' =>  $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login.form')->with('Error','Please Login with Your Account');
    }


    public function Profile(){
        $id = Auth::guard('admin')->user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile_view',compact('adminData'));

    }// End Method 


    public function EditProfile(){

        $id = Auth::guard('admin')->user()->id;
        $editData = Admin::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }// End Method 

    public function StoreProfile(Request $request){
        $id = Auth::guard('admin')->user()->id;
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->file('profile_image')) {
           $file = $request->file('profile_image');

           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$filename);
           $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);

    }// End Method


    public function ChangePassword(){

        return view('admin.admin_change_password');

    }// End Method


    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',

        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
        } else{
            session()->flash('message','Old password is not match');
            return redirect()->back();
        }

    }// End Method



}
 