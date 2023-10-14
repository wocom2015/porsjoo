<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;


class PlansController extends Controller
{
    function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $plans = Plan::all();
        return view("website.plans.index" , compact("plans"));
    }


    function invoice($plan_id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $plan = Plan::findOrFail($plan_id);
        return view("website.plans.invoice" , compact("plan"));
    }


    function payment($plan_id){

        $plan = Plan::find($plan_id);
        $curl = curl_init();

        $apiKey = '59b055df-cc7f-4163-9c34-af72a425f910';
        $order_id = rand(10000,100000);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://nextpay.org/nx/gateway/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'api_key='.$apiKey.'&amount='.$plan->price.'&order_id='.$order_id.'&customer_phone='.auth()->user()->mobile.'&custom_json_fields={ "productName":"'.$plan->name.'" , "id":'.$plan->id.' }&callback_uri=https://porsjou.com/payment/callback',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


    function callback(Request $request){
        $data = $request->all();

    }
}
