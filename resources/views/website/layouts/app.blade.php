<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
    <head>
        <base href="/">
        <meta charset="utf-8"/>
        <meta name="robots" content="nofollow"/>
        <title>{{((isset($title))?strip_tags($title).' | ':'').conf('system_title')}}</title>
        <meta name="description" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        @vite(['resources/site/css/app.css'])
        <meta name="csrf-token" content="{{csrf_token()}}"/>
    </head>
    <body id="app">
        @include("website.layouts.header")
        <section class="farm-area" style="padding-top: 200px">
            <div class="container">
                @yield("content")
            </div>
        </section>
        @include("website.layouts.footer")
    </body>
    @vite(['resources/site/js/app.js'])
</html>
