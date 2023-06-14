<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lastPJ = Inquiry::orderBy("id" , "desc")->limit(10)->get();
        return view("website.home.index" , compact("lastPJ"));
    }
}
