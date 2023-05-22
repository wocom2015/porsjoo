<?php

use App\Models\Category;
use App\Models\Configuration;
use App\Models\User;

if(!function_exists("conf")){
    function conf($item){
        return Configuration::whereItem($item)->pluck("value")->first();
    }
}

if(!function_exists("user_picture"))
{
    function user_picture(User $user , $size = 100 , $class="img-thumb" , $fancybox = true){
        if($user->picture!=''){
            return (($fancybox==true)?'<a data-fancybox="gallery" href="'.asset('storage/users/'.$user->picture.'-800.'.$user->ext).'">':'').' <img src="'.asset('storage/users/'.$user->picture.'-'.$size.'.'.$user->ext).'" '.(($class!='')?'class="'.$class.'"':'').' alt="'.$user->name.' '.$user->last_name.'">'.(($fancybox==true)?'</a>':'');
        }else{
            return '<span class="symbol-label">
                        <img src="/media/svg/avatars/002-'.$user->gender.'.svg" class="h-75 align-self-end '.$class.'" alt="'.$user->name.' '.$user->last_name.'">
                    </span>';
        }
    }
}

if(!function_exists("category_picture")){
    function category_picture($catId , $size = 30){
        $category = Category::find($catId);
        if($category->picture!=''){
            return '<img src="'.asset('/storage/categories/'.$catId.'/'.$category->picture.'-'.$size.'.'.$category->ext).'"/>';
        }else{
            return '';
        }
    }
}


if(!function_exists("reply")){
    function reply($state , $message = ''){

        switch($state){
            case "success":{
                return response(['state'=> $state , 'message' => __("messages.".(($message=='')?'operation_performed_successfully':$message)) , 'title' => __("p.success_operation")]);
            }
        }

    }
}
