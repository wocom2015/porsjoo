<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Plan;
use App\Models\User;

class DashboardController extends Controller
{


    public function index()
    {
        //\Illuminate\Support\Facades\Session::flush();
        $title = __("p.dashboard");
        $stats = [
            'inquiriesCount' => Inquiry::count(),
            'usersCount' => User::count(),
            'plansCount' => Plan::count()
        ];
        return view("admin.dashboard.index" , compact("title", "stats"));
    }
}
