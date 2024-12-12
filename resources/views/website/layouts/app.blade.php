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
        @vite(['resources/site/css/app.css'])
        @vite('resources/site/js/app.js')
        @yield("styles")
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
    <script type="text/javascript">
        ["keydown", "touchmove", "touchstart", "mouseover"].forEach(function (v) {
            window.addEventListener(v, function () {
                if (!window.isGoftinoAdded) {
                    window.isGoftinoAdded = 1;
                    var i = "3MCHKi", d = document, g = d.createElement("script"),
                        s = "https://www.goftino.com/widget/" + i, l = localStorage.getItem("goftino_" + i);
                    g.type = "text/javascript", g.async = !0, g.src = l ? s + "?o=" + l : s;
                    d.getElementsByTagName("head")[0].appendChild(g);
                }
            })
        });
    </script>
    </body>

</html>
