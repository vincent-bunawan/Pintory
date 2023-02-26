<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon; 
use App\Models\Admin;

class CategoryController extends Controller
{
    public function CategoryAll(){

        if(Auth::guard('admin')->check()){ 
            $id = Auth::guard('admin')->user()->id;
            $categoris = Category::where('created_by',$id)->get();
        return view('backend.category.category_all',compact('categoris'));
        } else {
            $id = Auth::guard('employee')->user()->owner_id;
            $categoris = Category::where('created_by',$id)->get();
        return view('employee.category.category_all',compact('categoris'));
        }
        
        

    } // End Mehtod 
    public function CategoryAdd(){
        return view('backend.category.category_add');
       } // End Mehtod 
   
   
       public function CategoryStore(Request $request){
   
           Category::insert([
               'name' => $request->name, 
               'created_by' => Auth::guard('admin')->user()->id,
               'created_at' => Carbon::now(), 
   
           ]);
   
            $notification = array(
               'message' => 'Kategori Berhasil Dibuat', 
               'alert-type' => 'success'
           );
   
           return redirect()->route('admin.category.all')->with($notification);
   
       } // End Method 
       public function CategoryEdit($id){

        $category = Category::findOrFail($id);
      return view('backend.category.category_edit',compact('category'));

  }// End Method 


   public function CategoryUpdate(Request $request){

      $category_id = $request->id;

      Category::findOrFail($category_id)->update([
          'name' => $request->name, 
          'updated_by' => Auth::guard('admin')->user()->id,
          'updated_at' => Carbon::now(), 

      ]);

       $notification = array(
          'message' => 'Kategori Berhasil Diupdate', 
          'alert-type' => 'success'
      );

      return redirect()->route('admin.category.all')->with($notification);

  }// End Method 


  public function CategoryDelete($id){

        Category::findOrFail($id)->delete();

     $notification = array(
          'message' => 'Kategori Berhasil Dihapus', 
          'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);

  } // End Method 
}
