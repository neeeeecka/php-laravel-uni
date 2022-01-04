<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    //

    public function index()
    {
        $countries = Countries::all();
     
        return $countries;
    }
}