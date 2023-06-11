<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Http\Resources\Category as CatRes;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function search(Request $request){
       $phrase = $request->p;
       if(strlen($phrase)>=2){
           $categories = Category::where("name" , "like" , "%".$phrase."%")->get();
           if($categories->isNotEmpty()){
               return CatRes::collection($categories);
           }
       }
    }
}
