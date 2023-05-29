<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
