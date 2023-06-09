<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl" >
<!--begin::Head-->
<head><base href="/">
    <meta charset="utf-8"/>
    <title>ورود به سامانه</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="/css/pages/login/classic/login-5.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>

    <link href="/plugins/global/plugins.bundle.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/plugins/custom/prismjs/prismjs.bundle.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/css/style.bundle.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>



    <link rel="shortcut icon" href="/images/logo.png"/>

</head>

<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >

<div class="d-flex flex-column flex-root">
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(/media/bg/bg-2.jpg);">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="/images/logo.png" class="max-h-75px" alt=""/>
                    </a>
                </div>

               {{$slot}}
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->


<!--begin::Global تم Bundle(used by all pages)-->
<script src="/plugins/global/plugins.bundle.js?v=7.0.6"></script>
<script src="/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6"></script>
<script src="/js/scripts.bundle.js?v=7.0.6"></script>
<!--end::Global تم Bundle-->


<!--begin::Page Scripts(used by this page)-->
<script src="/js/pages/custom/login/login-general.js?v=7.0.6"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
