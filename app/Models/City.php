<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;


    protected $fillable = ['province_id' , 'name'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }


    public function inquiries(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }
}
