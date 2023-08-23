<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function index()
    {
        $lastPJ = Inquiry::orderBy("id" , "desc")->limit(10)->get();
        return view("website.home.index" , compact("lastPJ"));
    }

    public function page($title)
    {
        switch($title){
            case "about":{$item = "about_us_text";$pageTitle= "درباره پرسجو";break;}
            case "partner-with-us":{$item = "partner_with_us_text";$pageTitle="مشارکت با ما";break;}
            case "help":{$item="use_help_text";$pageTitle="راهنمای استفاده";break;}
        }
        $content = conf($item);
        return view("website.page.index" , compact("content" , "pageTitle"));
    }


    public function contact(){
        $pageTitle = "تماس با ما";
        return view("website.page.contact" , compact( "pageTitle"));
    }

    public function rules(){
        $pageTitle = "قوانین و مقررات";
        return view("website.page.rules" , compact( "pageTitle"));
    }
}
