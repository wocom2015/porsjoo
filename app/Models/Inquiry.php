<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        "cheque_count",
        "cash_percent",
        "sample_enable",
        "guarantee_enable",
        "multiple_supplier",
        "picture",
        "picture_path",
        "ext",
        "accepted",
        "accepted_at",
        "cheque_count",
        "cash_percent",
        "close_date",
        "move_conditions",
        "is_bought",
        "vendor_id",
        "bought_answered",
        "vendor_introduce_name",
        "vendor_introduce_mobile"
    ];


    public function replies(): HasMany
    {
        return $this->hasMany(InquiryReply::class);
    }

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

    public function suppliers(): HasMany
    {
        return $this->hasMany(InquirySupplier::class);
    }

}
