<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slide extends Model
{
    use HasFactory;

    protected $fillable = [
        "url", "slider_id"
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

}
