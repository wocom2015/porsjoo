<nav>
        <input type="checkbox" id="nav" /><label class="nav-label" for="nav"></label>
        <ul>
            <li style="float: right">
                <a href="/"> خانه </a>
            </li>
            <li style="float: right">
                <a href="/plans"> طرح ها </a>
            </li>
            <li style="float: right">
                <a href="/inquiry/request" class="active"> ثبت pJ </a>
            </li>
            <li style="float: right">
                <a href="/page/about"> درباره پرسجو </a>

            </li>
            <li style="float: right">
                <a href="/contact"> تماس با ما </a>

            </li>
            @auth
            <li class="d-xl-none">
                <a href="/profile/edit" target="_blank">
                    ویرایش پروفایل</a>
            </li>
            <li class="d-xl-none">
                <a href="/user/logout">خروج از سامانه</a>
            </li>
            @endauth
        </ul>
        <div class="others-options d-flex align-items-center" style="margin-top: -10px">
            @auth
                {!! user_picture(auth()->user()->id) !!}
                <a href="/profile" class="text-white"
                   title="برای مشاهده پروفایل خود کلیک کنید">{{auth()->user()->name.' '.auth()->user()->last_name}}</a>
            @endauth

            @guest
                <div class="menu">
                    <a href="/signin" class="login-btn">ورود / ثبت نام</a>
                </div>
            @endguest
        </div>

</nav>






