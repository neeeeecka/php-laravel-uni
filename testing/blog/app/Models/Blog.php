<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "body", 
        "slug",
        "created_at",
        "updated_at",
        "author" ,
        "category",
        "image"
    ];
}