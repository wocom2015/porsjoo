<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {
        $user = User::find(auth()->user()->id);
        //TODO : just not closed inquiries
        $relatedInquiries = Inquiry::where("category_id" , $user->details->category_id)->where("user_id" , '!=' , $user->id)->get();
        return view("website.profile.index" , compact("user" , "relatedInquiries"));
    }



    public function edit(){
        $categories = Category::getA(1);

        $user = User::find(auth()->user()->id);
        return view("website.profile.edit" , compact("user" , "categories"));

    }


    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $items = [
            'name' => 'required|string|min:2|max:15' ,
            'last_name' => 'required|string|min:2|max:20' ,
            'email' => 'required|email' ,
            'mobile' => 'required' ,
            'category_id' => 'required|integer' ,
            'job_name' => 'required|min:5' ,

        ];
        $validator = Validator::make($request->all() ,$items);

        if ( $validator->fails() )
        {
            return back()->withErrors($validator->messages());
        }
        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        $user->details->update([
            'job_name' => $request->job_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'pm' => $request->pm,
            'pm_mobile' => $request->pm_mobile,
            'boss_mobile' => $request->boss_mobile,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);


        return back()->with(['state' => 'success' , 'message' => 'اطلاعات کاربری شما به روز شد']);
    }
}
