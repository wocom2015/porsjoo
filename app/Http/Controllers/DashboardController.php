<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        //\Illuminate\Support\Facades\Session::flush();
        $title = __("p.dashboard");
        return view("admin.dashboard.index" , compact("title"));
    }
}
