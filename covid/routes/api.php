<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/countries/list", [App\Http\Controllers\CountryController::class, "list"])->middleware("auth:sanctum");
Route::get("/countries/selected", [App\Http\Controllers\CountryController::class, "selectedCountries"])->middleware("auth:sanctum");
Route::post("/add-selected-country", [App\Http\Controllers\CountryController::class, "addSelectedCountry"])->middleware("auth:sanctum");
Route::delete("/remove-selected-country/{country_id}", [App\Http\Controllers\CountryController::class, "removeSelectedCountry"])->middleware("auth:sanctum");