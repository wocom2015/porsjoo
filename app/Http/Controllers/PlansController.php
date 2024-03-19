<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanUser;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        Log::debug("start paying planId=" . $plan_id);
        $plan = Plan::find($plan_id);
        $curl = curl_init();

        $apiKey = '2y7g4r-08YIRbrklEAzqdvANgN_Jm8oC-iRDGB3SlBI';
        $order_id = rand(10000, 100000);

        $data = array(
            'clientrefid' => $order_id,
            'payerIdentity' => auth()->user()->mobile,
            'Amount' => $plan->price,
//            'Amount' => 1000,
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
            Log::debug($erro);
            return false;
        } else {
            if ($header['http_code'] == 200) {
                $response = json_decode($response, true);
                if (isset($response) and $response != '') {
                    $response = $response['code'];
                    $payment = Payment::where("clientrefid", $order_id)->first();
                    Log::debug("payment received code = " . $response);
                    if ($payment) {
                        $payment->code = $response;
                        $payment->update();
                        Log::debug("payment updated code = " . $response);
                    } else {
                        Payment::create([
                            "plan_id" => (int)$plan_id,
                            "user_id" => auth()->user()->id,
                            "amount" => $plan->price,
//                            "amount" => 1000,
                            "code" => $response,
                            "clientrefid" => $order_id,
                        ]);
                        Log::debug("payment created code = " . $response);
                    }
                    ob_start();
                    /* ارسال به درگاه پرداخت با استفاده از کد ارجاع */
                    $GoToIPG = 'https://api.payping.ir/v2/pay/gotoipg/' . $response;
                    header('Location: ' . $GoToIPG);
                    ob_end_flush();
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
        Log::debug("The payment code = " . $response);
        echo $response;
    }


    function callback(Request $request)
    {
        //In payping
        Log::debug("Start callback 1 = ");
        Log::debug("Start callback = " . implode(" ", array_map(
                function ($v, $k) {
                    return $k . ':' . $v;
                }, $request->all(), array_keys($request->all()))));
        Log::debug("Start callback keys = " . implode(" ", $request->all()));
        Log::debug("Start callback values = " . implode(" ", array_keys($request->all())));

        $payment = Payment::where("clientrefid", $request->clientrefid)->first();

        $payment->refId = $request->refid;
        $payment->cardnumber = $request->cardnumber;
        $payment->cardhashpan = $request->cardhashpan;

        $payment->save(); //saving payment even if that's unsuccessful.

        if ($request->refid != "1") { //if payment success

            $plan = Plan::find($payment->plan_id);
            $user = \App\Models\User::find($payment->user_id);
            PlanUser::create([
                "plan_id" => $payment->plan_id,
                "user_id" => $payment->user_id,
                "price" => $payment->amount,
                "bought_at" => now(),
                "expire_at" => Carbon::now()->addMonths($plan->length), //you decide it in the basis of plan period,
                "active" => 1,
                "payment_id" => $payment->id
            ]);
            $user->pj_available += ($plan->pj_per_month*$plan->length); //adding plan pj to user
            $user->save();
            $this->verify($payment->amount, $request->refid);
            return view("website.payment.success");
        }
        return view("website.payment.error");

    }

    function verify($amount, $refid)
    {

        $apiKey = '2y7g4r-08YIRbrklEAzqdvANgN_Jm8oC-iRDGB3SlBI';
        $curl = curl_init();
        $data = array(
            'amount' => $amount,
            'refId' => $refid
        );

        curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.payping.ir/v2/pay/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 45,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Bearer " . $apiKey,
                    "cache-control: no-cache",
                    "content-type: application/json",
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $header = curl_getinfo($curl);
        curl_close($curl);
        if ($err) {
            $msg = 'خطا در ارتباط به پی‌پینگ :شرح خطا' . $err;
            return false;
        } else {
            if ($header['http_code'] == 200) {
                $response = json_decode($response, true);
                if (isset($refid) and $refid != '') {
                    $msg = ' تراکنش موفق بود: ' . $refid;
                    $outp['msg'] = $msg;
                } else {
                    $msg = 'متافسانه سامانه قادر به دریافت کد پیگیری نمی‌باشد! نتیجه درخواست: ' . $header['http_code'];
                }
                return true;
            } elseif ($header['http_code'] == 400) {
                $msg = ' تراکنش ناموفق بود، شرح خطا: ' . $response;
                $outp['msg'] = $msg;
                return false;
            } else {
                $msg = ' تراکنش ناموفق بود، شرح خطا: ' . $header['http_code'];
                return false;
            }
        }

    }
}
