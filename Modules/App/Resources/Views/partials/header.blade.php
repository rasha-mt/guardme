<div class="row">
    <div class="col-9 p-1 bg-site-blue"></div>
    <div class="col-3 p-1 bg-site-green"></div>
</div>
<header class="{{ $header_class ?? 'on-section' }}">
    <div class="logo">
        <a href="/" title="">
            <img src="/assets/img/logo_2.png" alt="" class="ui image medium"/>
        </a>
    </div>

    <ul class="quick-btn-headers">
        @if(auth()->guest())
            <li class="account-login">
                <a href="javascript:void(0)" class="d-inline-block p-3"><i class="la la-sign-in"></i> Login</a>
            </li>
            <li class="account-register">
                <a href="javascript:void(0)" class="d-inline-block p-3"><i class="la la-user-plus"></i> Register</a>
            </li>
        @else
            <li class="">
                <a href="/account/dashboard" class="d-inline-block p-3"><i class="la la-dashboard"></i> Dashboard</a>
            </li>
            <li class="">
                <a href="/account/logout" class="d-inline-block p-3"><i class="la la-sign-out"></i> Logout</a>
            </li>
        @endif
    </ul>

    <div class="menu-options open-responsive-menu"><span class="menu-action"><i></i></span></div>
    <div class="header-menus">
        <nav>
            <ul>
                <li class="">
                    <a href="#" title="">About us</a>
                </li>
                <li class="">
                    <a href="/personnel" title="">SIA Personnel</a>
                </li>
                <li class="">
                    <a href="#" title="">Job Openings</a>
                </li>
                <li class="">
                    <a href="#" title="">Blog</a>
                </li>
                <li class="">
                    <a href="#" title="">FAQ</a>
                </li>
            </ul>
        </nav>
        <a class="add-listing" href="/jobs/new" title=""><i class="la la-plus"></i>Post Job</a>
    </div>
</header><!-- Header -->
