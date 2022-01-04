<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = array(
            ["name" => "Georgia"],
            ["name" => "Russia"],
            ["name" => "Italy"],
            ["name" => "Nigeria"],
            ["name" => "France"],
            ["name" => "Spain"],
            ["name" => "Croatia"],
            ["name" => "Slovakia"],
            ["name" => "Czech republic"],
            ["name" => "Poland"],
            ["name" => "Lithuania"],
            ["name" => "Denmark"],

        );

        DB::table("countries")->insert($countries);
    }
}