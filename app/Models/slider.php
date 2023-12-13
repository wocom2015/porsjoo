<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "title", "sub_title"
    ];

    public function slides()
    {
        return $this->hasMany(Slides::class)->orderBy("created_at");
    }

}
