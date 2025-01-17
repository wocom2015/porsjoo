<?php

namespace App\Http\Controllers;

use App\Models\ActiveCode;
use App\Models\Inquiry;
use App\Models\InquirySupplier;
use App\Models\User;
use App\Notifications\changePass;
use App\Notifications\UserVerify;
use Exception;
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

        if (is_numeric($request->mobile)) {
            $field = 'mobile';
        } elseif (filter_var($request->mobile, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }


        request()->merge([$field => $request->mobile]);
        $credentials1 = $request->only($field, 'password');
        if (!Auth::validate($credentials1)):

            return redirect()->to('/signin')
                ->withErrors(trans('auth.failed'));
        endif;
        $user = Auth::getProvider()->retrieveByCredentials($credentials1);

        if ($user->active == 0) {
            $this->send_code($user->id);
            $request->session()->put('user_id', $user->id);
            return view("website.users.check_code", ['route' => route("users.verify")]);
        } else {
            Auth::login($user);
        }

        return $this->authenticated($request, $user);

    }


    protected function authenticated(Request $request, $user)
    {
        if ($request->get('redirect') !== null) {
            return redirect($request->get('redirect'));
        }
        return redirect('/profile');
    }


    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'last_name' => 'required|string|min:3',
            'job_name' => 'required|string|min:5',
            'mobile' => 'required|min:11|max:11|unique:users',
            'email' => 'nullable|email',
            'password' => 'required|confirmed|min:6',
            'rules' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::create([
            "name" => $request->name,
            "last_name" => $request->last_name,
            "mobile" => $this->faTOen($request->mobile),
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "job_name" => $request->job_name,
            "category_id" => 0
        ]);

        $this->send_code($user->id);
        $request->session()->put("user_id", $user->id);

//        Auth::loginUsingId($user->id);
        return redirect("/check-code");
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

    public function send_code($userId = 0)
    {

        if ($userId == 0) {
            $userId = auth()->user()->id;
        }

        $user = User::find($userId);
        //generating active code
        $activeCode = ActiveCode::generateCode($user);
        $activeCode->expired = 10; //TODO : must become configurable

        try {
            Notification::send($user, new UserVerify($activeCode->code));
        } catch (Exception $e) {

        }

        return $activeCode;
    }

    public function check_code()
    {
        return view("website.users.check_code", ['route' => route("users.verify")]);
    }

    public function verify(Request $request)
    {

        $code = $request->code;
        if (auth()->user() !== null) {
            $user_id = auth()->user()->id;
        } else if ($request->session()->get("user_id") !== null) {
            $user_id = $request->session()->get("user_id");
        }
        $user = User::find($user_id);

        $result = ActiveCode::where("code", $code)
            //->where("expired_at" , ">=" , now())
            ->where("user_id", '=', $user->id)
            ->first();

        if ($result) {
            if ($user->active == 0) {
                $user->active = 1;
                $user->active_at = now();
                $user->update();
                if (auth()->user() == null) {
                    Auth::login($user);
                }
                return redirect(route("profile"));
            } else {
                if (auth()->user() == null) {
                    Auth::login($user);
                }
                return redirect(route("profile"));
            }
        } else {
            return back()->with('error', __("messages.incorrect_code_for_user"));
        }
    }


    function profile($userId)
    {
        $user = User::find($userId);
        $comments = [];
        $collaborators = [];
        $inquiries = Inquiry::where("user_id", $user->id)->limit(10)->offset(0)->get();
        if ($inquiries) {
            foreach ($inquiries as $inquiry) {
                $suppliers = InquirySupplier::where("inquiry_id", $inquiry->id)->get();
                if ($suppliers) {
                    foreach ($suppliers as $supplier) {
                        $u = User::find($supplier->user_id);
                        if (!in_array($u, $collaborators))
                            $collaborators[] = $u;
                    }
                }
            }

            $inquiries = Inquiry::where('vendor_id', $user->id)->where("is_bought", 1)->where("comment", "!=", "")->get();
            $sc = [];
            if ($inquiries) {
                foreach ($inquiries as $inquiry) {

                    $toAdd = [
                        'supplier' => User::find($inquiry->user_id),
                        'comment' => $inquiry->comment,
                        'commented_at' => $inquiry->updated_at,
                        'score' => $inquiry->score
                    ];
                    if (!in_array($inquiry, $sc)) {
                        $comments[] = $toAdd;
                        $sc[] = $inquiry;
                    }

                }

            }

        }


        return view("website.users.profile", compact("user", "comments", "collaborators"));
    }

    public function forgot()
    {
        return view("website.users.forgot");
    }


    function change_pass(Request $request)
    {

        $user = User::where("mobile", $request->mobile)->first();

        if ($user) {
            $this->send_code($user->id);
            $request->session()->put('user_id', $user->id);
            return view("website.users.check_code", ['route' => route("password_change")]);

        } else {
            return back()->with('error', __("messages.the_user_not_exists_with_this_mobile"));
        }
    }

    function password_change(Request $request)
    {

        $user_id = $request->session()->get('user_id');
        $user = User::find($user_id);
        $password = rand(100000, 999999);

        $passwordHash = Hash::make($password);
        $user->password = $passwordHash;
        User::where("id", $user_id)->update(['password' => $passwordHash]);
        try {
            Notification::send($user, new changePass($password));
        } catch (Exception $e) {

        }

        return redirect("/signin");
    }

    function faTOen($string)
    {
        if ($string === null) return null;
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }
}
