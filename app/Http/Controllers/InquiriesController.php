<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Province;
use App\Models\Unit;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class InquiriesController extends Controller
{
    public function index($category_id)
    {

        $user = User::findOrFail(auth()->user()->id);
        if($user->pj_available<=0){
            return view('website.inquiry.charge');
        }

        $provinces = Province::all();
        $units = Unit::orderBy("name")->get();

        $firstNumber = rand(1,90);
        $secondNumber = rand(1,9);
        $sum =  $firstNumber + $secondNumber;
        session()->put("captcha_sum" , $sum);
        $category = Category::findOrFail($category_id);

        return view("website.inquiry.index" , compact("category" , "provinces" , "units"));
    }

    public function create(Request $request){

        //1. checking that pj_available is enough
        $pj_available = auth()->user()->pj_available;

        if($pj_available<=0){
            return reply("error" , [__("messages.not_enough_pj")]);
        }

        //2. validating data
        $validator = Validator::make($request->all() ,[
            'name' => 'required' ,
            'category_id' => 'required' ,
            'count' => 'required|integer' ,
            'unit_id' => 'required'
        ]);

        if ( $validator->fails() )
        {
            return checkValidation($validator , false);
        }

        //3. inserting data
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

        if($inquiry){
            //decrease the pj_available
            $user = User::find(auth()->user()->id);
            $user->pj_available = $pj_available-1;
            $user->update();

            return reply('success' , "your_pj_inserted_successfully");
        }
    }
}
