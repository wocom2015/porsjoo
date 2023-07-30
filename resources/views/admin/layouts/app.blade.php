<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
<head>
    <base href="/">
    <meta charset="utf-8"/>
    <title>{{((isset($title))?strip_tags($title).' | ':'').conf('system_title')}}</title>
    <meta name="description" content="Page with empty content"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <script src="/plugins/global/plugins.bundle.js"></script>
    @vite(['resources/admin/css/app.css', 'resources/admin/sass/app.scss', 'resources/admin/js/app.js'])
    <link href="/plugins/global/plugins.bundle.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/css/style.bundle.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="/css/themes/layout/header/base/light.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/css/themes/layout/aside/dark.rtl.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/plugins/custom/fancybox/jquery.fancybox.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="/storage/configuration/{{conf('system_logo')}}"/>
    @yield("styles")

    <script src="/js/scripts.bundle.js?v=7.0.6"></script>


</head>
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<div id="kt_header_mobile" class="header-mobile align-items-center  header-mobile-fixed ">
    <a href="/">

    </a>
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
			<span class="svg-icon svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/عمومی/User.svg--><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path
            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span></button>
        <!--end::Topbar Mobile Toggle-->
    </div>
</div>

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        @include("admin.layouts.sidebar")
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include("admin.layouts.header")
            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
               @include("admin.layouts.sub_header")
                <div class="d-flex flex-column-fluid">
                    <div class=" container ">
                        @yield("content")
                    </div>
                </div>
            </div>

            <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
                <div
                    class=" container-fluid  d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">{{date("Y")}}&copy;</span>
                        <a href="/" target="_blank"
                           class="text-dark-75 text-hover-primary">{{conf("system_title")}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-right: 21px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تایید حذف آیتم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">                کاربر گرامی ایا از حذف این آیتم مطمئن هستید؟ بعد از حذف اطلاعات قابل بازگشت نخواهند بود
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">خیر</button>
                <a onclick='document.getElementById("delete_frm").submit();' target="_blank" type="button" class="btn btn-danger font-bold">بله ، مطمئنم</a>

                <form class="d-none" action="" method="POST" id="delete_frm">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>


<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
	<span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
        <path
            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg></span></div>
<script src="/plugins/custom/fancybox/jquery.fancybox.min.js"></script>
<script>
    $(document).on("click" , ".delete-button" , function(){
        $('#delete_frm').attr('action' , $(this).data("route"));
    })
</script>
@yield("scripts")
</body>
</html>
