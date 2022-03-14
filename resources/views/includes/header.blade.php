@php
$appHeaderClass = (!empty($appHeaderInverse)) ? 'app-header-inverse ' : '';
$appHeaderMenu = (!empty($appHeaderMenu)) ? $appHeaderMenu : '';
$appHeaderMegaMenu = (!empty($appHeaderMegaMenu)) ? $appHeaderMegaMenu : '';
$appHeaderTopMenu = (!empty($appHeaderTopMenu)) ? $appHeaderTopMenu : '';
@endphp

<!-- BEGIN #header -->
<div id="header" class="app-header {{ $appHeaderClass }}">
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
        @if ($appSidebarTwo)
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-end-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        @endif
        <a href="/" class="navbar-brand"><span class="navbar-logo"><img src="{{ asset('images/funkweb_logo.png')}}"
                                                                        style="height: 25px"></span>
            <!-- <b class='ms-2 fs-5'>Funkweb</b> --></a>
        @if ($appHeaderMegaMenu && !$appSidebarTwo)
        <button type="button" class="navbar-mobile-toggler" data-bs-toggle="collapse" data-bs-target="#top-navbar">
			<span class="fa-stack fa-lg">
				<i class="far fa-square fa-stack-2x"></i>
				<i class="fa fa-cog fa-stack-1x mt-1px"></i>
			</span>
        </button>
        @endif
        @if($appTopMenu && !$appSidebarHide && !$appSidebarTwo)
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
			<span class="fa-stack fa-lg">
				<i class="far fa-square fa-stack-2x"></i>
				<i class="fa fa-cog fa-stack-1x mt-1px"></i>
			</span>
        </button>
        @endif
        @if($appTopMenu && $appSidebarHide && !$appSidebarTwo)
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        @endif
        @if (!$appSidebarHide)
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        @endif
    </div>

    @includeWhen($appHeaderMegaMenu, 'includes.component.header-mega-menu')

    <!-- BEGIN header-nav -->
    <div class="navbar-nav">
        <div class="navbar-item dropdown">
            <!--<a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
                <i class="fa fa-bell"></i>
                <span class="badge">0</span>
            </a>
            -->
            @include('includes.component.header-dropdown-notification')
        </div>
        @can('checkin-ip')   
            @if(Auth::user()->getCheckedInAttribute() == 1)
                <a href="/checkin"><button class="check-in-btn checkedIn"><i class="fa fa-clock"></i><strong>Check Out</strong></button></a>
                @else
                <a href="/checkin"><button class="check-in-btn"><i class="fa fa-clock"></i><strong>Check In</strong></button></a>
            @endif
        @endcan
        @cannot('checkin-ip')
             <button class="check-in-btn disabled"><i class="fa fa-clock"></i><strong>Check In</strong></button>
        @endcannot

        @isset($appHeaderLanguageBar)
        @include('includes.component.header-language-bar')
        @endisset

        <div class="navbar-item navbar-user dropdown me-30px d-flex">
            
            @if (!Auth::check())
            <a class="navbar-link d-flex align-items-center">
                <div class="image image-icon bg-gray-800 text-gray-600">
                    <i class="fa fa-user"></i>
                </div>
                <span>
                    <a href="/auth/google" style='text-decoration: none; margin: auto 0;'>Log In</a>
                </span>
            </a>
            @else
                <a href="#" class="navbar-link dropdown-toggle d-flex" style="top:2px; position:relative;" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->user_thumbnail }}" style="width:30px; height:30px"/>
                    <span class="navbar-username" style="margin-left: 8px;">   
                        {{ Auth::user()->name}}
                    </span>
                </a>
                @include('includes.component.header-dropdown-profile')
            @endif
            
        </div>

        @if($appSidebarTwo)
        <div class="navbar-divider d-none d-md-block"></div>
        <div class="navbar-item d-none d-md-block">
            <a href="javascript:;" data-toggle="app-sidebar-end" class="navbar-link icon">
                <i class="fa fa-th"></i>
            </a>
        </div>
        @endif
    </div>
    <!-- END header-nav -->
</div>
<!-- END #header -->
