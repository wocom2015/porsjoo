<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
    <head>
        <base href="/">
        <meta charset="utf-8"/>
        <meta name="robots" content="nofollow"/>
        <title>{{((isset($title))?strip_tags($title).' | ':'').conf('system_title')}}</title>
        <meta name="description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="icon" href="{{asset("storage/configurations/".conf('system_logo'))}}"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @vite('resources/site/css/app.css')
        @vite('resources/site/js/app.js')

        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <!-- append assets of pwa package -->
        @laravelPWA
    </head>
    <body id="app">
        @include("website.layouts.header")
        <section class="farm-area" style="padding-top: 100px">
            <div class="container">
                @yield("content")
            </div>
        </section>
        @include("website.layouts.footer")
        @yield("scripts")
    </body>

</html>
