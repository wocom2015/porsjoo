<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['user_id' , 'code' , 'expired_at'];


    public function user(){
        $this->belongsTo(User::class);
    }


    public function scopeGenerateCode($query , $user){
        $code = $this->getAliveCodeForUser($user);
        if($code !=null){
            return $code;
        }else{
            do{
                $code = mt_rand(100000 , 999999);
            }
            while($this->checkCodeIsUnique($user , $code));

            return $user->activeCode()->create([
                'code' => $code ,
                'expired_at' => now()->addMinutes(10)
            ]);

        }
    }

    private function checkCodeIsUnique($user, int $code)
    {
        return $user->activeCode()->whereCode($code)->exists();
    }

    private function getAliveCodeForUser($user)
    {
        return $user->activeCode->where("expired_at" , '>' , now())->first();
    }


}
