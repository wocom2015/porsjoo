<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\InquiryReply;
use App\Models\InquirySupplier;
use App\Models\Province;
use App\Models\Unit;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\In;


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

    public function item(Request $request){
        $inquiry = Inquiry::find($request->id);
        $inquiry->categoryName = $inquiry->category->name;
        $inquiry->provinceName = $inquiry->province->name;
        $inquiry->cityName = $inquiry->city->name;
        $inquiry->pay_date = jdate($inquiry->pay_date)->format('%d %B %Y');
        $inquiry->buy_date = jdate($inquiry->buy_date)->format('%d %B %Y');
        $inquiry->price = number_format($inquiry->price).' تومان';
        $inquiry->unitName = $inquiry->unit->name;
        return ['inquiry' =>  $inquiry, 'state' => 'success'];
    }

    public function reply(Request $request){
        //first check for inquiry points

        $user = User::findOrFail(Auth::user()->id);
        if($user->pj_available>=1){
            $validator = Validator::make($request->all() ,[
                'price' => 'required|integer|min:1000' ,
            ]);

            if ( $validator->fails() )
            {
                return checkValidation($validator , false);
            }

            $inquiry = Inquiry::findOrFail($request->id);

            $inquiryReply = InquiryReply::create([
                'inquiry_id' => $inquiry->id,
                'user_id' => Auth::user()->id,
                'price' => $request->price,
                'description' => $request->description,
                'score' => 0,
                'state_id' => 0,
                'accepted' => 0
            ]);
            if($inquiryReply){
                //decrease pj_available

                $user->pj_available = ($user->pj_available-1);
                $user->update();

                return reply("success" , "your_reply_to_inquiry_submitted_successfully");
            }
        }else{
            return reply("error" , [__("messages.not_sufficient_pj_error")]);
        }
    }


    public function reply_info(Request $request){
        $reply = InquiryReply::where("inquiry_id" , $request->id)->where("user_id" , Auth::user()->id)->first();

        if($reply!=null){
            $reply->created = jdate($reply->created_at)->format('%d %B %Y H:m');
            $reply->name = $reply->inquiry->name;
            $reply->price = number_format($reply->price).' تومان';
        }

        unset($reply->inquiry);
        return $reply;
    }

    public function replies(Request $request){
        $inquiry = Inquiry::findOrFail($request->id);

        $replies = $inquiry->replies;
        if($replies->isNotEmpty()){
            foreach($replies as $r){
                $r->price = number_format($r->price).' تومان';
            }
        }
        return $replies;
    }


    public function supplier(Request $request){
        $user = User::findOrFail($request->id);
        $currentUser = User::find(Auth::user()->id);
        //check pj_available

        $hasSeenBefore = InquirySupplier::where('inquiry_id' , $request->inquiry_id)->where('user_id' , $user->id)->exists();

        if($currentUser->pj_available==0 and !$hasSeenBefore){
            return reply("error" , __("messages.not_sufficient_pj_error"));
        }else{
            //check for viewing the supplier before
            if(!$hasSeenBefore){
                InquirySupplier::create(['inquiry_id'=> $request->inquiry_id , 'user_id' => $user->id]);
                //decreasing the pj_available
                $currentUser->pj_available--;
                $currentUser->update();
            }

            return ['state' => 'success' , 'info' =>['name' => $user->name.' '.$user->last_name , 'mobile' => $user->mobile , 'address' => $user->details->address , 'job_name' => $user->details->job_name]];
        }
    }
}
