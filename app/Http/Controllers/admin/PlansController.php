<?php

namespace App\Http\Controllers\admin;

use App\DataTables\PlansDataTable;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use http\Env\Request;

class PlansController extends Controller
{
    function index(PlansDataTable $dataTable){
        $title = __("p.plans_list");
        return $dataTable->render("admin.plans.index" , compact("title"));
    }


    function create(){
        $title = __("p.add_new_plan");
        return view("admin.plans.create" , compact("title"));
    }

    function store(Request $request){

    }


    function edit(Plan $plan_id){

    }

    function update(Request $request){

    }


}
