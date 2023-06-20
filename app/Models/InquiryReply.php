<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryReply extends Model
{
    use HasFactory;

    protected $fillable = [
      'inquiry_id',
      'user_id',
      'price',
      'description',
      'score',
      'state_id',
      'accepted'
    ];


    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }


}
