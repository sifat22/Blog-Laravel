<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator\validate;
use Image;

class PortfolioController extends Controller
{

    public function AllPortfolio(){
        $get_data = Portfolio::latest()->get();
        return view('admins.home.portfolio',compact('get_data'));
    }

    //design add portfolio
    public function AddPortfolio(){
        return view('admins.home.add_portfolio');
    }

    public function InsertPortfolio(Request $request){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'images' => 'required',

        ],[

            'name.required' => 'Portfolio Name is Required',
            'title.required' => 'Portfolio Titile is Required',
        ]);

        $image = $request->file('images');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(1020,519)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;

            Portfolio::insert([
                'name' => $request->name,
                'title' => $request->title,
                'desc' => $request->desc,
                'images' => $save_url,
                'created_at' => Carbon::now(),

            ]); 
            $notification = array(
            'message' => 'Portfolio Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all_portfolio.section')->with($notification);

        

    }


    //edit
    public function EditPortfolio($id){
        $edit_data = Portfolio::findOrFail($id);
        return view('admins.home.edit_portfolio',compact('edit_data'));
    }

    //update
    public function UpdatePortfolio(Request $request){
        $id = $request->id;

        if ($request->file('images')) {
            $image = $request->file('images');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(1020,519)->save('upload_image/about_image/'.$name_gen);
            $save_url = 'upload_image/about_image/'.$name_gen;

            Portfolio::findOrFail($id)->update([
                'name' => $request->name,
                'title' => $request->title,
                'desc' => $request->desc,
                'images' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Portfolio Updated with Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all_portfolio.section')->with($notification);

        } else{

            Portfolio::findOrFail($id)->update([
                'name' => $request->name,
                'title' => $request->title,
                'desc' => $request->desc,


            ]); 
            $notification = array(
            'message' => 'Portfolio Updated without Image Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('all_portfolio.section')->with($notification);

        } // end Else


    }
    //delete

    public function DeletePortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->images;
        unlink($img);

        Portfolio::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Portfolio Image Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);   

    }

    //frontend portfolio details page

    public function PortfolioDetails($id){
        $get_details_data = Portfolio::findOrFail($id);
        return view('frontend.home_all.portfolio_details',compact('get_details_data'));
    }


    public function HomePOrtfolio(){
        $get_data = Portfolio::latest()->get();
        return view('frontend.home_all.home_portfolio',compact('get_data'));
    }

}
