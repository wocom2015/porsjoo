<nav>
        <input type="checkbox" id="nav" /><label class="nav-label" for="nav"></label>
        <ul>
            <li style="float: right">
                <a href="/"><img style="width: 62px;margin-top: -8px" alt="{{conf("system_title")}}" src="{{asset("site/images/logo-inverse.png")}}"/></a>
            </li>
            <li style="float: right">
                <a href="/"> خانه </a>
            </li>
            <li style="float: right">
                <a href="/inquiry/request" class="active"> ثبت pJ </a>
            </li>
            <li style="float: right">
                <a href="/plans"> تعرفه </a>
            </li>
            <li style="float: right">
                <a href="/definitions"> تعاریف سایت </a>
            </li>

            <li style="float: right">
                <a href="/page/about"> درباره ما </a>

            </li>
            <li style="float: right">
                <a href="/contact"> تماس با ما </a>

            </li>
            @auth
                <li class="d-xl-none">
                    <a href="/profile">
                        مشاهده پروفایل</a>
                </li>
                <li class="d-xl-none">
                    <a href="/profile/edit">
                        ویرایش پروفایل</a>
                </li>
                <li class="d-xl-none">
                    <a href="/user/logout">خروج از سامانه</a>
                </li>
            @endauth
        </ul>
        <div class="others-options d-flex align-items-center header-m">
            @auth
               <sub-component fullname="{{auth()->user()->name.' '.auth()->user()->last_name}}" img="{{user_picture(auth()->user()->id , 'user-icon' , true)}}"></sub-component>
            @endauth

            @guest
                <div class="menu">
                    <a href="/signin" class="login-btn">ورود / ثبت نام</a>
                </div>
            @endguest
        </div>

</nav>






