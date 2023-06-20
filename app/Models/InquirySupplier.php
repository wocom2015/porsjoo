<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquirySupplier extends Model
{
    use HasFactory;

    protected $fillable = ['inquiry_id' , 'user_id'];
}
