<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\InquiryComment;
use App\Models\InquiryReply;
use App\Models\InquirySupplier;
use App\Models\Province;
use App\Models\Unit;

use App\Models\User;
use App\Notifications\NewPJ;
use App\Notifications\requestComment;
use App\Notifications\requestReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use Intervention\Image\Facades\Image;


class InquiriesController extends Controller
{
    public function index()
    {
        //checking last

        $lastPJ = Inquiry::where("user_id" , auth()->user()->id)->orderBy("id" , "desc")->latest()->first();

        if(!empty($lastPJ) and $lastPJ->bought_answered==0){
            $vendors = $lastPJ->suppliers;
            return view("website.inquiry.feedback" , compact("lastPJ" , "vendors"));
        }

        $categories = Category::where("id" , "!=" ,1)->get();
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

        return view("website.inquiry.index" , compact("categories" , "provinces" , "units"));
    }

    public function store(Request $request){
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

        if($request->close_date > $request->pay_date){
            return reply('error' , [__("messages.close_date_smaller_than_delivery_date")]);
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
            'close_date' => ($request->close_date !='')?jalali2gregorian($request->close_date):null,
            "province_id" => $request->province_id,
            "city_id" => $request->city_id,
            "price" => $request->price,
            "cheque_enable"=> $request->cheque_enable,
            "cheque_count"=> $request->cheque_count,
            "cash_percent"=> $request->cash_percent,
            "sample_enable"=> $request->sample_enable,
            "guarantee_enable" => $request->guarantee_enable,
            "multiple_supplier" => $request->multiple_supplier,
            "move_conditions" => $request->move_conditions,
            "vendor_introduce_name" => $request->vendor_introduce_name,
            "vendor_introduce_mobile" => $request->vendor_introduce_mobile,
        ];

        if ($request->has("picture")) {
            $name = Str::random(50);
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $file_mime = $file->getMimeType();
            $fileName = $name . '.' . $extension;
            $path = 'storage/inquiries/';

            $picture_path = date("Y").'/'.date('m').'/'.date('d');

            $path .= $picture_path.'/';
            if (in_array($file_mime, ['image/jpeg', 'image/png']) and in_array(strtolower($extension), ['jpg', 'png', 'jpeg'])) {
                $sizes = [100, 250, 800];
                $d = getimagesize($file);
                $width = $d[0];
                $height = $d[1];
                $ratio = round($width / $height, 2);

                $request->file('picture')->move($path, $fileName);
                foreach ($sizes as $size) {
                    Image::make($path . $fileName)->resize($size, $size / $ratio)->save($path . $name . '-' . $size . '.' . $extension);
                }
                unlink($path.$fileName);
                $data['picture_path'] = $picture_path;
                $data['picture'] = $name;
                $data['ext'] = $extension;
            } else {
                return reply('error' , [__("messages.picture_format_is_not_correct")]);
            }
        }

        //3. inserting data

        $inquiry = Inquiry::create($data);

        if($inquiry){
            //decrease the pj_available
            $user = User::find(auth()->user()->id);
            $user->pj_available = $pj_available-1;
            $user->update();

            //sending to vendors with this category
            $vendors = User::select("id" , "mobile")->where("category_id" , $request->category_id)->where("id" , '!=' , auth()->user()->id)->get();
            $category = Category::find($request->category_id);

            if($vendors->isNotEmpty()){
                foreach($vendors as $user){
                    //TODO : must be solved
                    Notification::send($user, new NewPJ($category->name));
                }
            }
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
        $inquiry->pictureSrc = ($inquiry->picture!='')?asset("/storage/inquiries/".$inquiry->picture_path.'/'.$inquiry->picture.'-800.'.$inquiry->ext):'';
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
                'accepted' => 0,
                'cheque_enable' , $request->cheque_enable ,
                'sample_enable' , $request->sample_enable ,
                'guarantee_enable' , $request->guarantee_enable ,
                'visit_place_enable' , $request->visit_place_enable ,
            ]);
            if($inquiryReply){
                //decrease pj_available

                $user->pj_available = ($user->pj_available-1);
                $user->update();

                //send sms
                $inquiryUser = User::find($inquiry->user_id);
                Notification::send($inquiryUser , new requestReply($inquiry->name));
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
            $reply->cheque_enable = ($reply->cheque_enable==1)?"بلی":"خیر";
            $reply->sample_enable = ($reply->sample_enable==1)?"بلی":"خیر";
            $reply->guarantee_enable = ($reply->guarantee_enable==1)?"بلی":"خیر";
            $reply->visit_place_enable = ($reply->visit_place_enable==1)?"بلی":"خیر";
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
                $r->hasSeen = InquirySupplier::where('inquiry_id' , $r->inquiry_id)->where('user_id' , $r->user_id)->exists();
                $r->cheque_enable = ($r->cheque_enable==1)?"بلی":"خیر";
                $r->sample_enable = ($r->sample_enable==1)?"بلی":"خیر";
                $r->guarantee_enable = ($r->guarantee_enable==1)?"بلی":"خیر";
                $r->visit_place_enable = ($r->visit_place_enable==1)?"بلی":"خیر";
                $r->url =  '/user/profile/'.$r->user_id;
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

            return ['state' => 'success' , 'info' =>['name' => $user->name.' '.$user->last_name , 'mobile' => $user->mobile , 'address' => $user->address , 'job_name' => $user->job_name ]];
        }
    }


    public function details($id , $slug)
    {
        $inquiry = Inquiry::findOrFail($id);

        if($inquiry->name == str_replace("-" ," " , $slug)){
            return view("website.inquiry.details" , compact("inquiry"));
        }else{
            abort(404);
        }
    }


    public function comment(Request $request){
        $validator = Validator::make($request->all() ,[
            'comment' => 'required' ,
            'supplier_id' => 'required|integer' ,
            'inquiry_id' => 'required|integer' ,
        ]);

        if ( $validator->fails() )
        {
            return checkValidation($validator , false);
        }

        $user_id = auth()->user()->id;

        InquiryComment::create([
            'inquiry_id' => $request->inquiry_id,
            'supplier_id' => $request->supplier_id,
            'user_id' => $user_id,
            'comment' => $request->comment,
        ]);
        $user = User::find($request->supplier_id);
        $inquiry = Inquiry::find($request->inquiry_id);
        Notification::send($user , new requestComment($inquiry->name));

        return reply("success" , "your_comment_added_successfully");
    }


    function comment_info(Request $request){
        $inquiry_id = $request->id;
        $inquiry = Inquiry::find($inquiry_id);
        $user_id = $inquiry->user_id;
        $supplier_id = auth()->user()->id;

        $comment = InquiryComment::where("user_id" , $user_id)->where("supplier_id" , $supplier_id)->where("inquiry_id" , $inquiry_id)->first();

        if($comment != null)
            return ["comment" => $comment->comment , "comment_time" => jdate($comment->created_at)->format('%A, %d %B %Y H:i')];
        else
            return ['comment' => 'هنوز پاسخی از سمت مشتری ارسال نشده است!' , 'comment_time' => ''];
    }


    function report(){
        $title = "گزارش استعلام های ارسالی";
        $user =  Auth::user();
        $last_3 = Inquiry::where("user_id" , $user->id)->where("created_at",">", Carbon::now()->subMonths(3))->count();
        $last_6 = Inquiry::where("user_id" , $user->id)->where("created_at",">", Carbon::now()->subMonths(6))->count();
        $last_12 = Inquiry::where("user_id" , $user->id)->where("created_at",">", Carbon::now()->subMonths(12))->count();
        return view("website.inquiry.report" , compact("title" , "last_3" , "last_6" , "last_12"));
    }


    function show(){
        $user = User::find(auth()->user()->id);


        $collaborators = [];
        $comments = [];
        if ($user->inquiries->isNotEmpty()) {
            foreach ($user->inquiries as $inquiry) {
                $inquiry->provinceName = $inquiry->province->name;
                $inquiry->repliesCount = $inquiry->replies->count();
                $inquiry->created = jdate($inquiry->created_at)->format('%A, %d %B %Y');
                $inquiry->categoryName = $inquiry->category->name;
                $inquiry->pictureSrc = inquiry_pic($inquiry->id, 100, "thumb-img", false);
            }
        }

        $currentPlan = "";
        $type = "archive";
        return view("website.profile.archive", compact("user",  "collaborators", "currentPlan" , "comments" , "type"));
    }


    function feedback(Request $request){
        $inquiry = Inquiry::findOrFail($request->id);
        $inquiry->is_bought = $request->is_bought;
        $inquiry->vendor_id = $request->vendor_id;
        $inquiry->bought_answered = 1;

        $inquiry->save();

        return back();
    }
}
