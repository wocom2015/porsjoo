<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="login-signin">
        <div class="mb-20">
            <h3 class="opacity-40 font-weight-normal">ورود به پنل مدیریت</h3>
            <p class="opacity-40">نام کاربری و کلمه عبور خود را وارد کنید</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-text-input id="email" dir="ltr" class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" placeholder="پست الکترونیک" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text-input id="password" dir="ltr" class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                              type="password"
                              name="password"
                              placeholder="کلمه عبور"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-white font-weight-bold">کلمه عبور را فراموش کرده اید؟</a>
                @endif
                <div class="form-group text-center mt-10">
                    <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">ورود</button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>


