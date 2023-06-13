<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Province;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InquiriesController extends Controller
{
    public function index($category_id)
    {
        $provinces = Province::all();
        $units = Unit::orderBy("name")->get();

        $firstNumber = rand(1,90);
        $secondNumber = rand(1,9);
        $sum =  $firstNumber + $secondNumber;
        session()->put("captcha_sum" , $sum);

        return view("website.inquiry.index" , compact("category_id" , "provinces" , "units"));
    }


    public function create(Request $request){


        $validator = Validator::make($request->all() ,[
            'name' => 'required' ,
            'category_id' => 'required' ,
            'count' => 'required|integer' ,
            'unit_id' => 'required'
        ]);

        if ( $validator->fails() )
        {
            return checkValidation($validator);
        }

        $data = [
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'count' => $request->count,
            'unit_id' => $request->unit_id,
            'description' => $request->description,
            'buy_date' => ($request->buy_date !='')?jalali2gregorian($request->buy_date):null,
            'pay_date' => ($request->pay_date !='')?jalali2gregorian($request->pay_date):null,
            "province_id" => $request->province_id,
            "city_id" => $request->city_id,
            "price" => $request->price,
            "cheque_enable"=> $request->cheque_enable,
            "sample_enable"=> $request->sample_enable,
            "guarantee_enable" => $request->guarantee_enable,
            "multiple_supplier" => $request->multiple_supplier,
            "picture" => "", //TODO
            "picture_path",
            "ext",
        ];


        $inquiry = Inquiry::create($data);
    }
}
