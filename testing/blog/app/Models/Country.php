<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function posts(){
        return $this->hasManyThrough("App\Models\Blog", "App\Models\User");
    }
}