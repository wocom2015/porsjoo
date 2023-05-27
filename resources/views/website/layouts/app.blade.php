<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
    <head>
        <base href="/">
        <meta charset="utf-8"/>
        <title>{{((isset($title))?strip_tags($title).' | ':'').conf('system_title')}}</title>
        <meta name="description" content="Page with empty content"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="stylesheet" href="/site/css/bootstrap.rtl.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/site/css/style.css">
        <link rel="stylesheet" href="/site/css/responsive.css">
        <link rel="stylesheet" href="/site/css/rtl.css">
        <meta name="csrf-token" content="{{csrf_token()}}"/>
    </head>
    <body style="background-color: #ececec">
        <div class="navbar-area navbar-style-two">
        <div class="trifles-responsive-nav">
            <div class="container">
                <div class="trifles-responsive-menu">
                    <div class="logo">
                        <a href="/"> <img src="assets/img/logo-two.png" alt="logo" /> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="trifles-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="/"> <img src="assets/img/logo-two.png" alt="logo" /> </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" style="display: block;">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link active"> خانه <i class="fa fa-chevron-down"></i> </a>
                            </li>
                            <li class="nav-item"><a href="/about" class="nav-link"> درباره ما </a></li>

                            <li class="nav-item">
                                <a href="#" class="nav-link"> خدمات <i class="fa fa-chevron-down"></i> </a>
                            </li>
                            <li class="nav-item"><a href="/contact" class="nav-link"> تماس با ما </a></li>
                        </ul>
                        <div class="others-options">
                            @auth
                            <div class="option-item">
                                <i class="search-btn fa fa-search" style="display: block;"></i> <i class="close-btn fa fa-times"></i>
                                <div class="search-overlay search-popup" style="display: none;">
                                    <div class="search-box">
                                        <form class="search-form">
                                            <input class="search-input" name="search" placeholder="جستجو" type="text" /> <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endauth

                            @guest
                                     <button class="btn text-white" style="background-color: #106CA9;" type="submit"><i class="fas fa-search"></i> لاگین </button>
                            @endguest

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
        <section class="farm-area ptb-100">
            <div class="container">
                @yield("content")
            </div>
        </section>

    </body>
    <script src="/site/js/jquery.min.js"></script>
</html>
