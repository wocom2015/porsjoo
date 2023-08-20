<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\InquiryComment;
use App\Models\InquiryReply;
use App\Models\InquirySupplier;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function index()
    {
        $user = User::find(auth()->user()->id);
        $relatedInquiries = Inquiry::where("category_id", $user->category_id)->where("user_id", '!=', $user->id)->where("accepted", 0)->get();


        if ($user->inquiries->isNotEmpty()) {
            foreach ($user->inquiries as $inquiry) {
                $inquiry->provinceName = $inquiry->province->name;
                $inquiry->repliesCount = $inquiry->replies->count();
                $inquiry->created = jdate($inquiry->created_at)->format('%A, %d %B %Y');
                $inquiry->categoryName = $inquiry->category->name;
                $inquiry->pictureSrc = inquiry_pic($inquiry->id, 100, "thumb-img", false);
            }
        }

        if ($relatedInquiries != null) {
            foreach ($relatedInquiries as $r) {
                $r->provinceName = $r->province->name;
                $r->created = jdate($r->created_at)->format('%A, %d %B %Y');
                $r->reply_by_user = InquiryReply::where("user_id", Auth::user()->id)->where("inquiry_id", $r->id)->exists();
                $r->pictureSrc = inquiry_pic($r->id, 100, "thumb-img", false);
            }
        }

        $last_3 = Inquiry::where("user_id" , $user->id)->where("created_at",">", Carbon::now()->subMonths(6))->count();
        $last_6 = Inquiry::where("user_id" , $user->id)->where("created_at",">", Carbon::now()->subMonths(6))->count();
        $last_12 = Inquiry::where("user_id" , $user->id)->where("created_at",">", Carbon::now()->subMonths(6))->count();
        $collaborators = [];
        $comments = [];
        $inquiries = Inquiry::where("user_id" , $user->id)->get();
        if($inquiries){
            foreach ($inquiries as $inquiry){
                $suppliers = InquirySupplier::where("inquiry_id" , $inquiry->id)->get();
                if($suppliers){
                    foreach($suppliers as $supplier){
                        $collaborators[] = User::find($supplier->user_id);
                    }
                }

                $supplierComments = InquiryComment::where('inquiry_id' , $inquiry->id)->get();
                if($supplierComments){
                    foreach($supplierComments as $comment){
                        $comments[] = [
                          'supplier' => User::find($comment->supplier_id),
                          'comment'  => $comment
                        ];
                    }
                }
            }
        }

        $currentPlan = "";
        return view("website.profile.index", compact("user", "relatedInquiries", "collaborators", "currentPlan" , "last_3" , "last_6" , "last_12" , "comments"));
    }


    public function edit()
    {
        $categories = Category::getA(1);

        $user = User::find(auth()->user()->id);
        return view("website.profile.edit", compact("user", "categories"));

    }


    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $items = [
            'name' => 'required|string|min:2|max:15',
            'last_name' => 'required|string|min:2|max:20',
            'email' => 'required|email',
            'mobile' => 'required',
            'category_id' => 'required|integer',
            'job_name' => 'required|min:5',
            'logo' => 'nullable|mimes:jpg,bmp,png',
            'pm_mobile' => 'required'

        ];
        $validator = Validator::make($request->all(), $items);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }


        $data = [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'job_name' => $request->job_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'pm' => $request->pm,
            'pm_mobile' => $request->pm_mobile,
            'boss_mobile' => $request->boss_mobile,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ];

        if ($request->has("logo")) {
            $name = Str::random(20);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = $name . '.' . $extension;
            $path = 'storage/users/' . $user->id . '/';

            $d = getimagesize($file);
            $width = $d[0];
            $height = $d[1];
            $ratio = round($width / $height, 2);

            $request->file('logo')->move($path, $fileName);
            Image::make($path . $fileName)->resize(200, 200 / $ratio)->save($path . $fileName);
            $data['logo'] = $name . '.' . $extension;

            //delete previous picture
            if ($user->logo != '')
            {
                if(file_exists($path . $user->logo))
                   unlink($path . $user->logo);
            }
        }
        $user->update($data);

        if($request->back_url !='')
            return redirect($request->back_url);

        return back()->with('success', 'اطلاعات کاربری شما به روز شد');
    }


}
