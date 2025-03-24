<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/') }}">
                <span class="brand-logo">
                    {{-- <img src="assets/img/ALCB-logo.png" style="max-width: 147px !important; margin-left: 22px;margin-bottom: 20px !important;"> --}}
                </span>
            </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->routeIs('admin.index')  ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.index') }}">
                    <i data-feather='cast'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Home</span><i data-feather="more-horizontal"></i>
            </li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='home'></i><span class="menu-title text-truncate" data-i18n="Invoice">Home</span></a>
                <ul class="menu-content">
                    <li class="nav-item {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.banner.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate" data-i18n="Banner">Banner</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.event.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.event.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate" data-i18n="Event">Event</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.about-section.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.about-section.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate" data-i18n="About-Section">About</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.running_image.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.running_image.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate" data-i18n="Clients">Clients</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.gallery.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate" data-i18n="Gallery">Gallery</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.why.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.why.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate" data-i18n="Why">Why Choose</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.about.index') }}">
                    <i data-feather='book-open'></i>
                    <span class="menu-title text-truncate" data-i18n="About">About</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.contact.*') && Request::segment(3) != 'form'  ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.contact.index') }}">
                    <i data-feather='phone'></i>
                    <span class="menu-title text-truncate" data-i18n="Contact">Contact</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.career.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.career.index') }}">
                    <i data-feather='layout'></i>
                    <span class="menu-title text-truncate" data-i18n="Career">Career</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.preference.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.preference.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="Preference">Preference</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.contact.form.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.contact.form.list') }}">
                    <i data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="Contact Form">Contact Form</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu -->