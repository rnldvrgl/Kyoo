<nav id="scrollspy" class="navbar sticky-top navbar-expand-lg shadow bg-kyoodark navbar-dark">
    <div class="container px-5 gap-3">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/kyoo-logo.svg') }}" alt="Kyoo Logo" width=" 40" height="34">
        </a>
        <!-- Navbar toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center d-lg-inline-flex d-grid gap-3">
                <li class="nav-item">
                    <div class="d-grid">
                        <a class=" btn btn-outline-kyoored text-white rounded-pill px-3 mb-2 mb-lg-0 d-block d-lg-inline-block"
                            href="{{ route('live_queue') }}">Live
                            Queue</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-grid">
                        <a class=" btn btn-kyoored rounded-pill px-3 mb-2 mb-lg-0 d-block d-lg-inline-block"
                            href="{{ route('login') }}">LOGIN</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
