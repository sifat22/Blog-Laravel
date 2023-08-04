<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Image;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function AboutSection(){
        $about = About::find(1);
        return view('admins.home.about',compact('about'));
    }

    public function UpdateAbout(Request $request){
        $about_id = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(636,852)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'about_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'About Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } else{

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                

            ]); 
            $notification = array(
            'message' => 'About Updated without Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        }
    } // end Else

    public function AboutDetails(){
        $about = About::find(1);
        return view('frontend.home_all.about_details',compact('about'));
    }

    public function MultiImage(){
        return view('admins.home.multi_image');
    }
    //adding multiple images
    public function AddMultiImage (Request $request){

        $image = $request->file('multi_image');
        foreach ($image as $multi_image ) {

            # code...
            $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($multi_image)->resize(220,220)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;
            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at' => Carbon::now()

            ]); 
        }
        $notification = array(
        'message' => 'Multiple Images Insert Succesfully', 
        'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
 

    }

    //get Image

    public function AllMultiImage(){
        $get_image = MultiImage::orderBy('multi_image', 'ASC')->get();
        return view('admins.home.all_image',compact('get_image'));
    }

    public function EditMultiImage($id){
        $editMultiImage = MultiImage::findOrFail($id);
        return view('admins.home.edit_image',compact('editMultiImage'));

    }

    public function UpdateMultiImage(Request $request){
        $multi_image_id = $request->id;

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(220,220)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;

            MultiImage::findOrFail($multi_image_id)->update([

                'multi_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Multi Image Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        }
    }

    //delete image

    public function DeleteMultiImage($id){
        //delete from image folder
        $multi = MultiImage::findOrFail($id);
        $image = $multi->multi_image;
        unlink($image);
        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Multi Image Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
    //

