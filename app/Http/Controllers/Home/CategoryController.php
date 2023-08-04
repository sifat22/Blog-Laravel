<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class CategoryController extends Controller
{

    // All category

    public function AllCategory(){
        $get_data = Category::all();
        return view('admins.home.all_category',compact('get_data'));
    }
    //

    //Add category

    public function AddCategor(){
        return view('admins.home.add_category');
    }

    //insert category

    public function InsertCategory(Request $request){
        $request->validate([
            'category_name' => 'required',
           
            
            
        ],[

            'category_name.required' => 'Category Name is Required',
            
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
            

        ]); 

        $notification = array(
            'message' => 'Category Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all_blog_category.section')->with($notification);
}

//Edit Category

    public function EditCategory($id){
        $edit_cate = Category::findOrFail($id);
        return view('admins.home.edit_category',compact('edit_cate'));
    }

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;
        Category::findOrFail($cat_id)->update([

            'category_name' => $request->category_name,

        ]); 
        $notification = array(
        'message' => 'Category Updated Successfully', 
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

    }

    //delete
    public function DeleteCategory($id){
       Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);   
    }
    
}
