<?php

namespace App\Http\Controllers\admin;

use App\DataTables\PlansDataTable;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PlansController extends Controller
{
    function index(PlansDataTable $dataTable)
    {
        $title = __("p.plans_list");
        return $dataTable->render("admin.plans.index", compact("title"));
    }


    function create()
    {
        $title = __("p.add_new_plan");
        return view("admin.plans.create", compact("title"));
    }

    function store(Request $request)
    {
        $items = [
            'name' => 'required',
            'length' => 'required|integer',
            'pj_per_month' => 'required|integer',
            'suppliers_count' => 'required|integer',
            'price' => 'required',
            'description' => 'nullable',
            'active' => 'nullable'
        ];
        $validator = Validator::make($request->all(), $items);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        $data = $request->all();

        if ($file = $request->file("file")) {
            $ext = $file->extension();
            $name = Str::random(10);

            $width = Image::make($file)->width();
            $height = Image::make($file)->height();
            $ratio = round($width / $height, 2);
            $path = 'storage/plans/';
            $file->move($path, $name . '.' . $ext);
            Image::make($path . '/' . $name . '.' . $ext)->resize(150, 150 / $ratio)->save($path . '/' . $name . '.' . $ext);
            $data['picture'] = $name . '.' . $ext;
        } else {
            $data['picture'] = '';
        }
        Plan::create($data);

        return redirect("admin/plans");

    }


    function edit(Plan $plan)
    {
        $title = __("p.edit_plan") . ' <strong>' . $plan->name . '</strong>';
        return view("admin.plans.edit", compact("title", "plan"));
    }

    function update(Request $request, $plan_id)
    {

        $plan = Plan::find($plan_id);
        $items = [
            'name' => 'required',
            'length' => 'required|integer',
            'pj_per_month' => 'required|integer',
            'suppliers_count' => 'required|integer',
            'price' => 'required',
            'description' => 'nullable',
            'active' => 'nullable'
        ];
        $validator = Validator::make($request->all(), $items);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        if ($file = $request->file("file")) {
            $ext = $file->extension();
            $name = Str::random(10);

            $width = Image::make($file)->width();
            $height = Image::make($file)->height();
            $ratio = round($width / $height, 2);
            $path = 'storage/plans/';
            $file->move($path, $name . '.' . $ext);
            Image::make($path . '/' . $name . '.' . $ext)->resize(150, 150 / $ratio)->save($path . '/' . $name . '.' . $ext);
            $picture = $name . '.' . $ext;
        } else {
            $picture = '';
        }


        $plan->name = $request->name;
        $plan->length = $request->length;
        $plan->pj_per_month = $request->pj_per_month;
        $plan->price = $request->price;
        $plan->suppliers_count = $request->suppliers_count;
        $plan->active = $request->active;
        $plan->description = $request->description;
        $plan->picture = $picture;


        $plan->save();

        return redirect("admin/plans");
    }


    function destroy($plan_id)
    {
        if (Plan::destroy($plan_id))
            return redirect("admin/plans");
    }


}
