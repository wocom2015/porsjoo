<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function details(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function scopeProfileCompleted($query , $userId): bool
    {
        $user = User::findOrFail($userId);
        return (
            $user->name !='' and
            $user->last_name !='' and
            $user->details->job_name !='' and
            $user->email != '' and
            $user->mobile != '' and
            $user->details->category_id !=0
        );

    }


    public function replies(){
        return $this->hasMany(InquiryReply::class);
    }




}
