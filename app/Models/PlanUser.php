<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    use HasFactory;

    protected $table = 'plan_user';

    protected $fillable = [
        "plan_id",
        "user_id",
        "price",
        "bought_at",
        "expire_at",
        "active",
        "payment_id"
    ];
}
