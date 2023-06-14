<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = "user_details";

    protected $fillable = [
        'user_id',
        'job_name',
        'phone',
        'address',
        'pm',
        'pm_mobile',
        'boss_mobile',
        'category_id',
        'description',
        'logo',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
