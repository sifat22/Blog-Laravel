<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Image;

class BlogController extends Controller
{
    //
    //all Blog
    public function AllBlog(){
        $get_data = Blog::latest()->get();
        return view('admins.home.all_blog',compact('get_data'));

    }

    //add Blog
    public function AddBlog(){
        //get all category
        $get_cat = Category::orderBy('category_name','asc')->get();
        return view('admins.home.add_blog',compact('get_cat'));
    }

    //insert Category

    public function InsertBlog(Request $request){
        $request->validate([
            'blog_title' => 'required',
            'tags' => 'required',
            'blog_image' => 'required',

        ],[

            'blog_title.required' => 'Blog Title is Required',
            'tags.required' => 'Tags is Required',
        ]);

        $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(430,327)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;

            Blog::insert([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'tags' => $request->tags,
                'blog_desc' => $request->blog_desc,
                'blog_image' => $save_url,
                'created_at' => Carbon::now(),

            ]); 
            $notification = array(
            'message' => 'Blog Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all_blog.section')->with($notification);
    }

    //edit blog
    public function EditBlog($id){
        $edit_blog = Blog::findOrFail($id);
        $get_cat = Category::orderBy('category_name','asc')->get();
        return view('admins.home.edit_blog',compact('edit_blog','get_cat'));
    }

    //update Blog
    public function UpdateBlog(Request $request){
        $id = $request->id;

        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(1020,519)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;

            Blog::findOrFail($id)->update([
                'blog_category_id' =>$request->blog_category_id,
                'blog_title' => $request->blog_title,
                'tags' => $request->tags,
                'blog_desc' => $request->blog_desc,
                'blog_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Portfolio Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all_blog.section')->with($notification);

        } else{

            Blog::findOrFail($id)->update([
                'blog_category_id' =>$request->blog_category_id,
                'blog_title' => $request->blog_title,
                'tags' => $request->tags,
                'blog_desc' => $request->blog_desc,


            ]); 
            $notification = array(
            'message' => 'Portfolio Updated without Image Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('all_blog.section')->with($notification);

        } // end Else
    }

    //delete Blog
    public function DeleteBlog($id){
        $portfolio = Blog::findOrFail($id);
        $img = $portfolio->blog_image;
        unlink($img);

        Blog::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Blog Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    //frontend

    public function BlogDetails($id){
        $allblogs = Blog::limit(5)->get();
        $edit_blog = Blog::findOrFail($id);
        $get_cat = Category::all();
        return view('frontend.home_all.blog_details',compact('edit_blog','get_cat','allblogs'));

    }


    // blog by category
    public function catByBlog($id){
        $blog_post = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();//get post depends on id
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = Category::all();
        return view('frontend.home_all.cate_blogpost',compact('blog_post','allblogs','categories'));
    }

    public function HomeBlog(){
        $get_data = Blog::latest()->get();
        return view('frontend.home_all.home_all_blog',compact('get_data'));
    }
}
