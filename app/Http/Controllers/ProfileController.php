<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        $user = User::find(auth()->user()->id);
        //TODO : just not closed inquiries
        $relatedInquiries = Inquiry::where("category_id" , $user->details->category_id)->where("user_id" , '!=' , $user->id)->get();
        return view("website.profile.index" , compact("user" , "relatedInquiries"));
    }
}
