<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
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

Route::get('/blog', [BlogController::class, "showBlog"])->name("blog");

Route::get('/post/{slug}', [BlogController::class, "showPost"])->name("viewPost");

Route::get('/blogs', [BlogController::class, "index"]);
Route::get('/blogs/recommended', [BlogController::class, "recommended"]);