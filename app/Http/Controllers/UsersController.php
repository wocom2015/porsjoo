<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function signup()
    {
        return view("website.users.signup");
    }


    public function signin(){

        return view("website.users.signin");
    }


    public function login(Request $request){
        $validator = Validator::make($request->all() ,[
            "email" => 'required|string',
            "password" => 'required|min:6'
        ]);

        if ( $validator->fails() )
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        //dd($request->all());
        $credentials1 = $request->only('email' , 'password');
        if(!Auth::validate($credentials1)):

            return redirect()->to('/signin')
                ->withErrors(trans('auth.failed'));
        endif;
        $user = Auth::getProvider()->retrieveByCredentials($credentials1);

        Auth::login($user);

        return $this->authenticated($request, $user);

    }


    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all() ,[
           'name'  => 'required|string|min:2',
           'last_name'  => 'required|string|min:3',
           'job_name'  => 'required|string|min:5',
           'mobile'    => 'required|min:11|max:11|unique:users',
           'email'     => 'required|email|unique:users',
           'password'  => 'required|confirmed|min:6',

        ]);


        if ( $validator->fails() )
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $user = User::create([
           "name" => $request->name,
           "last_name" => $request->last_name,
           "mobile" => $request->mobile,
           "email"  => $request->email,
           "password" => Hash::make($request->password)
        ]);


        $user->details()->create([
           "job_name" => $request->job_name,
           "user_id" => $user->id,
           "category_id" => 0
        ]);

        Auth::loginUsingId($user->id);
        return redirect("/");
    }

    public function checkValidation(\Illuminate\Validation\Validator $validator): ResponseFactory|\Illuminate\Contracts\Foundation\Application|null|\Illuminate\Http\Response|\Illuminate\Foundation\Application
    {
        $messages = [];
        foreach ($validator->errors()->messages() as $k => $v) {
            $messages[] = $v['0'];
        }

        return reply("error", implode("<br>", $messages));
    }


    public function logout()
    {
        Auth::logout();
        return redirect("/signin");
    }
}
