<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeSlidercontroller;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\CategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/admin-panel', function () {
    return view('admins.index');
})->middleware(['auth', 'verified'])->name('admin-panel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin All Route
Route::middleware(['auth'])->group(function () {
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout','destroy')->name('logout.page');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile','editprofile')->name('admin.edit.profile');
    Route::post('/store/profile','Storeprofile')->name('admin.store.profile');
    Route::get('/change/password','ChangePassword')->name('admin.change.password');
    Route::post('/update/password','UpdatePassword')->name('admin.update.password');


});
});

//Home slider controller
Route::controller(HomeSlidercontroller::class)->group(function(){
    Route::get('admin/home/slide','HomeSlider')->name('home.slide');
    Route::post('admin/update/slide','UpdateSlider')->name('update.slide');
    
});

//About slider controller
Route::controller(AboutController::class)->group(function(){
    Route::get('admin/about/page','AboutSection')->name('about.section');
    Route::post('admin/update/about','UpdateAbout')->name('update.aboout');
    Route::get('about_details','AboutDetails')->name('about_details.page');
    Route::get('admin/about/multi_image','MultiImage')->name('multi_image.section');
    Route::post('admin/store/multi_image','AddMultiImage')->name('add_multi_image');
    Route::get('admin/get/multi_image','AllMultiImage')->name('all_multi_image.section');
    Route::get('admin/edit/multi_image/{id}','EditMultiImage')->name('edit_multi_image');
    Route::post('admin/update/multi_image','UpdateMultiImage')->name('update_multi_image');
    Route::get('admin/delete/multi_image/{id}','DeleteMultiImage')->name('delete_multi_image');
    
});

Route::controller(PortfolioController::class)->group(function(){
    Route::get('admin/all/portfolio','AllPortfolio')->name('all_portfolio.section');
    Route::get('admin/add/portfolio','AddPortfolio')->name('add_portfolio.section');
    Route::post('admin/insert/portfolio','InsertPortfolio')->name('add_store.protfolio');
    Route::get('admin/edit/portfolio/{id}','EditPortfolio')->name('edit.portfolio');
    Route::post('admin/update/portfolio','UpdatePortfolio')->name('update.portfolio');
    Route::get('admin/delete/portfolio/{id}','DeletePortfolio')->name('delet.portfolio');

    //frontend
    Route::get('portfolio/details/{id}','PortfolioDetails')->name('portfolio_details');
    Route::get('portfolio','HomePOrtfolio')->name('home_portfolio.section');

    
    
});


//Controller

Route::controller(CategoryController::class)->group(function(){
    Route::get('admin/all/category','AllCategory')->name('all_blog_category.section');
    Route::get('admin/add/category','AddCategor')->name('add_category.section');
    Route::post('admin/insert/category','InsertCategory')->name('insert_category.section');
    Route::get('admin/edit/category/{id}','EditCategory')->name('edit.category');
    Route::post('admin/update/category','UpdateCategory')->name('update.category');
    Route::get('admin/delete/category/{id}','DeleteCategory')->name('delet.category');
    
   

    
    
});

//Blog

Route::controller(BlogController::class)->group(function(){
    Route::get('admin/all/blog','AllBlog')->name('all_blog.section');
    Route::get('admin/add/blog','AddBlog')->name('add_blog.section');
    Route::post('admin/insert/blog','InsertBlog')->name('insert_blog.section');
    Route::get('admin/edit/blog/{id}','EditBlog')->name('edit_blog.secttion');
    Route::post('admin/update/blog','UpdateBlog')->name('update_blog.section');
    Route::get('admin/delete/blog/{id}','DeleteBlog')->name('delet_blog.section');

    //frontend
    Route::get('blog/details/{id}','BlogDetails')->name('blog_details');
    // blog post by category
    Route::get('category/blog/{id}','catByBlog')->name('catby_blog');
    Route::get('blogs','HomeBlog')->name('home_blog');
   
   
   
   

    
    
});


//contact

Route::controller(ContactController::class)->group(function(){
    Route::get('contact/page','Contact')->name('contact');
    //contact send message
    Route::post('contact/message/send','SendContact')->name('send_message');
    //admin message
    Route::get('admin/contact/message','getMessage')->name('message.section');
    Route::get('admin/contact/message/details/{id}','MessageDetails')->name('message_details');
    
   

    
    
});





require __DIR__.'/auth.php';
