<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
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
        'job_name',
        'phone',
        'address',
        'pm',
        'pm_mobile',
        'boss_mobile',
        'category_id',
        'description',
        'pj_available',
        'logo',
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

    use Notifiable;

    public function routeNotificationForKavenegar($driver, $notification = null)
    {
        return $this->mobile;
    }

    public function activeCode(): HasMany
    {
        return $this->hasMany(ActiveCode::class);
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class)->wherePivot('active', '=', 1);
    }


    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class)->orderBy("id" , "desc");
    }


    public function scopeProfileCompleted($query , $userId): bool
    {
        $user = User::findOrFail($userId);
        return (
            $user->name !='' and
            $user->last_name !='' and
            $user->job_name !='' and
            $user->email != '' and
            $user->mobile != '' and
            $user->category_id !=0
        );

    }


    public function replies(){
        return $this->hasMany(InquiryReply::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }




}
