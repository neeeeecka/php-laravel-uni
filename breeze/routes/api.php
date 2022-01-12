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

Route::get("/countries/visited", [App\Http\Controllers\CountryController::class, "visitedCountries"])->middleware("auth:sanctum");
Route::get("/countries/tovisit", [App\Http\Controllers\CountryController::class, "toVisitCountries"])->middleware("auth:sanctum");

Route::post("/add-visited-country", [App\Http\Controllers\CountryController::class, "addVisitedCountry"])->middleware("auth:sanctum");
Route::post("/add-country-to-visit", [App\Http\Controllers\CountryController::class, "addCountryToVisit"])->middleware("auth:sanctum");

Route::delete("/remove-visited-country/{country_id}", [App\Http\Controllers\CountryController::class, "removeVisitedCountry"])->middleware("auth:sanctum");
Route::delete("/remove-country-to-visit/{country_id}", [App\Http\Controllers\CountryController::class, "removeCountryToVisit"])->middleware("auth:sanctum");