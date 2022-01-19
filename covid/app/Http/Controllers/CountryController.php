<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
{

    /**
     * Maps table data to match format of Select2
     * 
     */
    private function mapper($data){
        return collect($data)->map(
            function ($column) {
                return ["id" => $column["id"], "text" => $column["name"], "code" => $column["code"]];
            }
        );
    }

    /**
     * Returns list of all countries saved in databse for select2 requests
     */
    public function list(Request $request){
      return ["results" => $this->mapper(Country::where("name", "like", "%".$request->input("term")."%")->take(20)->get())];
    }

    /**
    * Returns list of countries that user has selected
    */
    public function selectedCountries(Request $request){
        return $this->mapper($request->user()->selectedCountries()->get());
    }

    /**
    * Adds new country that user has added
    * Fails if country doesn't exist in database
    * Fails if user already has country added
    */
    public function addSelectedCountry(Request $request){
        $user = $request->user();
        $countryId = $request->input("country_id");
        $countryExists = Country::findOrFail($request->input("country_id"));

        $hasCountry = $user->selectedCountries()->find($countryId);
        if($hasCountry){
            return Response::json(["status" => "fail"], 418);
        }else{
            
            $user->selectedCountries()->attach($request->input("country_id"));
            $user->save();
            
            return ["status" => "success"];
        }
    }

    /**
    * Removes country that user has removed
    * Fails if country doesn't exist in database
    */
    public function removeSelectedCountry(Request $request){
        $user = $request->user();
        $countryExists = Country::findOrFail($request->country_id);

        $user->selectedCountries()->detach($request->country_id);
        $user->save();
        
        return ["status" => "success"];
    }
    
}