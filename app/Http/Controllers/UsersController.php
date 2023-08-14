<?php

namespace App\Http\Controllers;

use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\UserVerify;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{


    public function signup()
    {
        return view("website.users.signup");
    }


    public function signin()
    {

        return view("website.users.signin");
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "mobile" => 'required|string',
            "password" => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        //dd($request->all());
        $credentials1 = $request->only('mobile', 'password');
        if (!Auth::validate($credentials1)):

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'last_name' => 'required|string|min:3',
            'job_name' => 'required|string|min:5',
            'mobile' => 'required|min:11|max:11|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $user = User::create([
            "name" => $request->name,
            "last_name" => $request->last_name,
            "mobile" => $request->mobile,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "job_name" => $request->job_name,
            "category_id" => 0
        ]);

        $this->send_code($user->id);


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

    public function send_code($userId = 0){

        if($userId==0){
            $userId = auth()->user()->id;
        }

        $user = User::find($userId);
        //generating active code
        $activeCode = ActiveCode::generateCode($user);
        $activeCode->expired = 10; //TODO : must become configurable


        Notification::send($user, new UserVerify($activeCode->code));

        return $activeCode;
    }

    public function verify(Request $request)
    {
        $code = $request->code;
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $result = ActiveCode::where("code" , $code)
            ->where("expired_at" , ">=" , now())
            ->where("user_id" ,'=',$user_id)
            ->exists();

        if($result){
            if($user->active==0){
                $user->active = 1;
                $user->active_at = now();
                $user->update();
                return reply('success' , 'authentication_done_successfully');
            }else{
                return reply('success' , 'code_accepted_successfully');
            }
        }else{
            return reply('error' , __("messages.incorrect_code_for_user"));
        }
    }
}
