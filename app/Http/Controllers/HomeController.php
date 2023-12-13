<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\slide;

class HomeController extends Controller
{
    public function index()
    {
        $lastPJ = Inquiry::query()->orderBy("id" , "desc")
            ->where("close_date", ">", date("Y-m-d"))
            ->limit(10)->get();

        foreach ($lastPJ as $pj) {
            $pj->url = "/inquiry/details/" . $pj->id . "/" . str_replace(" ", "-", $pj->name);
            $pj->provinceName = $pj->province->name;
            $pj->categoryName = $pj->category->name;
            $pj->involved = $pj->suppliers->count() + 1;
            $pj->closeDate = ($pj->close_date != '') ? jdate($pj->close_date)->format('%A, %d %B %Y') : '';
        }
        $slides = Slide::all();
        return view("website.home.index", compact("lastPJ", "slides"));
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
