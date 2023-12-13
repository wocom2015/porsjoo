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
        return view("website.plans.index", compact("plans"));
    }


    function invoice($plan_id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $plan = Plan::findOrFail($plan_id);
        return view("website.plans.invoice", compact("plan"));
    }


    function payment($plan_id)
    {

        /*        header("Location:" . "https://api.payping.ir/v2/pay/gotoipg/");
                return;*/
        $plan = Plan::find($plan_id);
        $curl = curl_init();

        $apiKey = '2y7g4r-08YIRbrklEAzqdvANgN_Jm8oC-iRDGB3SlBI';
        $order_id = rand(10000, 100000);

        $data = array(
            'clientRefId' => $order_id,
            'payerIdentity' => auth()->user()->mobile,
            'Amount' => $plan->price,
            'Description' => $plan->name,
            'returnUrl' => 'https://porsjou.com/payment/callback'
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.payping.ir/v2/pay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer " . $apiKey,
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $header = curl_getinfo($curl);
        $err = curl_error($curl);

        if ($err) {
            $msg = 'کد خطا: CURL#' . $err;
            $erro = 'در اتصال به درگاه مشکلی پیش آمد.';
            return false;
        } else {
            if ($header['http_code'] == 200) {
                $response = json_decode($response, true);
                if (isset($response) and $response != '') {
                    $response = $response['code'];
                    /* ارسال به درگاه پرداخت با استفاده از کد ارجاع */
                    $GoToIPG = 'https://api.payping.ir/v2/pay/gotoipg/' . $response;
                    header('Location: ' . $GoToIPG);
                } else {
                    $msg = 'تراکنش ناموفق بود - شرح خطا: عدم وجود کد ارجاع';
                }
            } elseif ($header['http_code'] == 400) {
                $msg = 'تراکنش ناموفق بود، شرح خطا: ' . $response;
            } else {
                $msg = 'تراکنش ناموفق بود، شرح خطا: ' . $header['http_code'];
            }
        }

        curl_close($curl);
        echo $response;
    }


    function callback(Request $request)
    {
        $data = $request->all();

    }
}
