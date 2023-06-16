<?php

namespace App\Http\Controllers\admin;

use App\DataTables\PlansDataTable;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $items = [
            'name' => 'required' ,
            'length' => 'required|integer' ,
            'pj_per_month' => 'required|integer' ,
            'suppliers_count' => 'required|integer',
            'price' => 'required',
            'description' => 'nullable',
            'active' => 'nullable'
        ];
        $validator = Validator::make($request->all() ,$items);

        if ( $validator->fails() )
        {
            return back()->withErrors($validator->messages());
        }
        Plan::create($request->all());

        return redirect("admin/plans");

    }


    function edit(Plan $plan){
        $title = __("p.edit_plan").' <strong>'.$plan->name.'</strong>';
        return view("admin.plans.edit" , compact("title" , "plan"));
    }

    function update(Request $request , $plan_id){

        $plan = Plan::find($plan_id);
        $items = [
            'name' => 'required' ,
            'length' => 'required|integer' ,
            'pj_per_month' => 'required|integer' ,
            'suppliers_count' => 'required|integer',
            'price' => 'required',
            'description' => 'nullable',
            'active' => 'nullable'
        ];
        $validator = Validator::make($request->all() ,$items);

        if ( $validator->fails() )
        {
            return back()->withErrors($validator->messages());
        }
        $plan->update($request->all());

        return redirect("admin/plans");
    }


    function destroy($plan_id){
        if(Plan::destroy($plan_id))
            return redirect("admin/plans");
    }


}
