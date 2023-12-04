<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Http\Resources\CategorySearch as CatRes;
use App\Models\Inquiry;
use Faker\Provider\en_IN\Internet;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /****************************************************************
     * @param Request $request
     * @return array|void
     */
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


    /************************************************************************
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    function search_inquiry(Request $request){
        $catId = $request->catId;
        $inquiries =  \App\Http\Resources\Inquiry::collection(Inquiry::
            where("category_id" , $catId)->orderBy("id" , "desc")
            ->where("close_date" , ">" , date("Y-m-d"))
            ->get());

        if(!empty($inquiries)){
            foreach ($inquiries as $inquiry){
                $inq = Inquiry::find($inquiry['id']);
                $inquiry['user_count'] = $inq->suppliers->count() + 1;
            }
        }
        return $inquiries;
    }
}
