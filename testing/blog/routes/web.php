<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostsController;

use App\Models\Blog;
use App\Models\Country;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/blog', [BlogController::class, "showBlog"])->name("blog");

// Route::get('/post/{slug}', [BlogController::class, "showPost"])->name("viewPost");

// Route::get('/blogs', [BlogController::class, "index"]);
// Route::get('/blogs/recommended', [BlogController::class, "recommended"]);

Route::resource("posts", "App\Http\Controllers\PostsController")->parameters(["posts" => "slug"]);

Route::get("/dev", function(){
    // return Blog::all();
    // return Blog::withTrashed()->get();
    // return Blog::onlyTrashed()->get();

    // Blog::withTrashed()->find(62)->restore();
    // Blog::withTrashed()->find(62)->forceDelete();

    // return User::find(1)->post;

    // return Blog::find(62)->user->name;

    return User::find(1)->posts;

    // return User::find(1)->roles()->get();
    // return User::find(2)->roles()->get();

    // $roles = User::find(1)->roles()->get();
    // foreach($roles as $role){
    //     echo $role->name;
    // }

    // return Role::find(1)->roles()->get();
    // $role = new App\Models\Role();
    // return $role->find(2)->users()->get();

    // foreach(Country::find(1)->posts as $post){
    //     echo $post->title." by ".$post->user->name;
    //     echo "<br />";
    // }

});