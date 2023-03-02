<!-- Header Navbar -->
<header id="header" class="header fixed-top d-flex align-items-center bg-kyoodark">
    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/images/kyoo-logo.png') }}" alt="" />
            <span class="d-none d-lg-block">
                Queueing Management System
            </span>
        </a>
        @if ($role->name === 'Main Admin')
            <i class="fa-solid fa-bars toggle-sidebar-btn"></i>
        @endif
    </div>
    <nav class="header-nav ms-auto">
        <ul id="datetimefield" class="d-flex align-items-center">
            <li class="nav-item d-none d-md-block datetime pe-3 text-center text-white">
                <h6 class="time mb-0"></h6>
                <span class="date"></span>
            </li>
            <li class=" nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/images/profiles/' . $details->profile_picture) }}" alt="Profile"
                        class="rounded-circle" />
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        {{ $attributes['details']->name }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                            {{ $attributes['details']->name }}
                        </h6>
                        <span>
                            {{ $attributes['role']->name }}
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('user_profile') }}">
                            <i class="fa-solid fa-user"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <button id="logout_account" class="dropdown-item d-flex align-items-center logout-link"
                            href="{{ route('logout') }}">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            {{ __('Sign Out') }}
                        </button>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!-- /Header Navbar -->
