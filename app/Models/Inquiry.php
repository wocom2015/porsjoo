<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "user_id",
        "category_id",
        "count",
        "unit_id",
        "description",
        "buy_date",
        "pay_date",
        "province_id",
        "city_id",
        "price",
        "cheque_enable",
        "sample_enable",
        "guarantee_enable",
        "multiple_supplier",
        "picture",
        "picture_path",
        "ext",
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

}
