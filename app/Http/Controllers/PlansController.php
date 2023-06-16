<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    function index(){
        $plans = Plan::all();
        return view("website.plans.index" , compact("plans"));
    }


    function buy($plan_id){
        echo $plan_id;
    }
}
