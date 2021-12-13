<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $fillable = [
        "title",
        "body", 
        "slug",
        "author" ,
        "category",
        "image"
    ];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}