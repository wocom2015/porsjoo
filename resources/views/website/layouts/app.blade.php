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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <meta name="csrf-token" content="{{csrf_token()}}"/>
    </head>
    <body style="background-color: #ececec">
        @include("website.layouts.header")
        <section class="farm-area" style="padding-top: 200px">
            <div class="container">
                @yield("content")
            </div>
        </section>
        @include("website.layouts.footer")

    </body>
    <script src="/site/js/jquery.min.js"></script>
</html>
