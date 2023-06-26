<nav>
        <input type="checkbox" id="nav" /><label for="nav"></label>
        <ul>
            <li>
                <a href="/" class="active"> استعلام قیمت </a>
            </li>
            <li>
                <a href="/page/about"> درباره پرسجو </a>

            </li>
            <li>
                <a href="/page/partner-with-us"> مشارکت با ما </a>

            </li>
            <li>
                <a href="/plans"> طرح ها </a>
            </li>
            <li>
                <a href="/contact"> تماس با ما </a>

            </li>
            <li>
                <a href="/page/help"> راهنمای استفاده </a>
            </li>
        </ul>
        <div class="others-options d-flex align-items-center">
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
<!--    <nav class="navbar navbar-inverse">
        &lt;!&ndash; Brand and toggle get grouped for better mobile display &ndash;&gt;
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Brand</a>
        </div>
        &lt;!&ndash; Collection of nav links, forms, and other content for toggling &ndash;&gt;
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </nav>-->




<!--<div class="navbar-area navi-header">
    <div class="mobile-responsive-nav">
        <div class="container">
            <div class="mobile-responsive-menu mean-container">
                <div class="mean-bar">
                    <nav class="mean-nav">
                        <ul class="navbar-nav" style="display: none;">
                            <li>
                                <a href="/" class="active"> استعلام قیمت </a>
                            </li>
                            <li>
                                <a href="/page/about"> درباره پرسجو </a>

                            </li>
                            <li>
                                <a href="/page/partner-with-us"> مشارکت با ما </a>
                            </li>
                            <li>
                                <a href="/plans"> طرح ها </a>
                            </li>
                            <li>
                                <a href="/contact"> تماس با ما </a>

                            </li>
                            <li>
                                <a href="/page/help"> راهنمای استفاده </a>
                            </li>

                        </ul>

                    </nav>
                </div>

            </div>
        </div>
    </div>
    <div class="desktop-nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light navi-header">
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="display: none;">
                    <ul class="navbar-nav m-auto">
                        <li>
                            <a href="/" class="active"> استعلام قیمت </a>
                        </li>
                        <li>
                            <a href="/page/about"> درباره پرسجو </a>

                        </li>
                        <li>
                            <a href="/page/partner-with-us"> مشارکت با ما </a>

                        </li>
                        <li>
                            <a href="/plans"> طرح ها </a>
                        </li>
                        <li>
                            <a href="/contact"> تماس با ما </a>

                        </li>
                        <li>
                            <a href="/page/help"> راهنمای استفاده </a>
                        </li>
                    </ul>
                    <div class="others-options d-flex align-items-center">
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
                </div>
            </nav>
        </div>
    </div>
</div>-->





