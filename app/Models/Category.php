<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'name' , "slug" , "parent_id" , "img" , "description"
    ];

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
