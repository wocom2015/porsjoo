<div id="kt_header" class="header  header-fixed " >
    <!--begin::Container-->
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left pt-5" id="kt_header_menu_wrapper">

            <form method="post" action="{{route("logout")}}">
                <a href="javascript:void(0)" class="menu-link" onclick="$(this).parent('form').submit()">

                    @csrf
                    <i
                        class="menu-icon flaticon-logout"></i><span class="menu-text">  {{__("p.logout")}}</span>

                </a>
            </form>
        </div>

        <div class="topbar">
            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{__("p.hello")}},</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{Auth::user()->name.' '.Auth::user()->last_name}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
		                        <span class="symbol-label font-size-h5 font-weight-bold"><i class="fa fa-user"></i> </span>
		                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
