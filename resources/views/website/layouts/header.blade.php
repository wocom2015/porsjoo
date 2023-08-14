<nav>
        <input type="checkbox" id="nav" /><label for="nav"></label>
        <ul>
            <li style="float: right">
                <a href="/"> خانه </a>
            </li>
            <li style="float: right">
                <a href="/plans"> طرح ها </a>
            </li>
            <li style="float: right">
                <a href="/" class="active"> استعلام قیمت </a>
            </li>
            <li style="float: right">
                <a href="/page/about"> درباره پرسجو </a>

            </li>
            <li style="float: right">
                <a href="/contact"> تماس با ما </a>

            </li>
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






