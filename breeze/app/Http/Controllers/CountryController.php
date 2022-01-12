<?php

namespace App\Http\Controllers;

use App\Models\Countries;
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

    //
    public function list(Request $request){
        // return Countries::where("name", "like", "%".$request->input("term")."%")->take(20)->get();
        // return ["results" => Countries::select(["id", "name as text", "code"])->where("name", "like", "%".$request->input("term")."%")->take(20)->get()];
        return ["results" => $this->mapper(Countries::where("name", "like", "%".$request->input("term")."%")->take(20)->get())];

    }

    public function visitedCountries(Request $request){
        return $this->mapper($request->user()->visitedCountries()->get());
    }

    public function toVisitCountries(Request $request){
        return $this->mapper($request->user()->toVisitCountries()->get());
    }

    public function addVisitedCountry(Request $request){
        $user = $request->user();
        $countryId = $request->input("country_id");
        $countryExists = Countries::findOrFail($request->input("country_id"));

        $hasCountry = $user->visitedCountries()->find($countryId);
        if($hasCountry){
            return Response::json(["status" => "fail"], 418);
        }else{
            
            // Remove country from planned countries
            $user->toVisitCountries()->detach($countryId);

            $user->visitedCountries()->attach($request->input("country_id"));
            $user->save();
            
            return ["status" => "success"];
        }
    }
    public function addCountryToVisit(Request $request){
        $user = $request->user();
        $countryId = $request->input("country_id");
        $countryExists = Countries::findOrFail($countryId);

        $hasCountry = $user->toVisitCountries()->find($countryId);
        
        if($hasCountry){
            return response()->json(["status" => "fail"], 418);
        }else{
            
            // Remove country from already visited countries
            $user->visitedCountries()->detach($countryId);

            $user->toVisitCountries()->attach($countryId);
            $user->save();

            return ["status" => "success"];
        }
    }

    public function removeVisitedCountry(Request $request){
        $user = $request->user();
        $countryExists = Countries::findOrFail($request->country_id);

        $user->visitedCountries()->detach($request->country_id);
        $user->save();
        
        return ["status" => "success"];
    }
    public function removeCountryToVisit(Request $request){
        $user = $request->user();
        $countryExists = Countries::findOrFail($request->country_id);

        $user->toVisitCountries()->detach($request->country_id);
        $user->save();

        return ["status" => "success"];
    }
}