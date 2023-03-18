<!-- Navbar -->
<nav id="scrollspy" class="navbar sticky-top navbar-expand-lg shadow bg-kyoodark navbar-dark">
    <!-- Container wrapper -->
    <div class="container px-5">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/kyoo-logo.svg') }}" alt="Kyoo Logo" width=" 40" height="34">
        </a>

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mx-auto d-flex justify-content-center mb-2 mb-lg-0" data-bs-spy="scroll"
                data-bs-target="#scrollspy" data-bs-offset="50">
                <li class="nav-item">
                    <a class="nav-link" href="#home">
                        <span class="link-text">HOME</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faqs">
                        <span class="link-text">FAQs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#feedback">
                        <span class="link-text">SEND FEEDBACK</span>
                    </a>
                </li>
            </ul>

            <div class="d-lg-inline-flex d-grid gap-3 mb-3 mb-lg-0">
                <a class="btn btn-outline-kyoored text-white rounded-pill px-3 py-2 mb-2 mb-lg-0"
                    href="{{ route('live_queue') }}" aria-label="Live Queue">
                    <span class="d-inline-block">Live Queue</span>
                </a>
                <a class="btn btn-kyoored rounded-pill px-3 py-2" href="{{ route('login') }}" aria-label="Log In">
                    <span class="d-inline-block">Log In</span>
                </a>
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
