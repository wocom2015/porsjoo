<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Http\Resources\CategorySearch as CatRes;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function search(Request $request){
       $phrase = $request->p;
       if(strlen($phrase)>=2){
           $categories = Category::where("name" , "like" , "%".$phrase."%")->get();
           if($categories->isNotEmpty()){
               return [
                    'categories' => CatRes::collection($categories),
                    'hasMore' => false
               ] ;
           }else{
               return [];
           }
       }
    }


    function search_inquiry(Request $request){
        $catId = $request->catId;
        return \App\Http\Resources\Inquiry::collection(Inquiry::
            where("category_id" , $catId)->orderBy("id" , "desc")
            ->where("close_date" , ">" , date("Y-m-d"))
            ->get());
    }
}