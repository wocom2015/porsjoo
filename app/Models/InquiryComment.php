<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryComment extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id' , 'user_id' , 'inquiry_id' , 'comment'];
}
