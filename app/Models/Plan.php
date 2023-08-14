<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
      "name" , "length" , "suppliers_count" , "pj_per_month" , "price" , "active" , "description" , "picture"
    ];
}
