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


    public function users(){
        return $this->hasMany(UserDetail::class);
    }

    public function inquiries(){
        return $this->belongsTo(Inquiry::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    function scopeGetA($query , $parent)
    {
        $info = Category::where("id" , $parent)->select("id" , "name")->first();
        $info->level = $this->findLevel($info->id);
        $output[] = $info;
        $children = Category::where("parent_id" , $parent)->get();
        if ($children->isNotEmpty()) {
            foreach ($children as $child) {
                $CH = self::getA($child->id);
                if (!empty($CH)) {
                    foreach ($CH as $C){
                        $output[] = $C;
                    }
                }
            }
        }
        return $output;
    }

    public function findLevel($category_Id)
    {
        $parent = $category_Id;

        if($parent==1){
            return 0;
        }
        $level = 0;
        while ($parent != 0) {
            $category = Category::find($parent);
            $parent = $category->parent_id;
            $level++;
        }
        return $level-1;
    }



}
