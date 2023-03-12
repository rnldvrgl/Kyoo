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
            <ul class="nav navbar-nav ms-auto me-4 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-house-chimney"></i>
                        HOME
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faqs">
                        <i class="fa-solid fa-file-circle-question"></i>
                        FAQs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#feedback">
                        <i class="fa-solid fa-message"></i>
                        SEND FEEDBACK
                    </a>
                </li>
            </ul>

            <div class="d-lg-inline-flex d-grid gap-3">
                <a class=" btn btn-outline-kyoored text-white rounded-pill px-3 mb-2 mb-lg-0"
                    href="{{ route('live_queue') }}">Live
                    Queue</a>
                <a class=" btn btn-kyoored rounded-pill px-3 mb-2 mb-lg-0" href="{{ route('login') }}">LOGIN</a>
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
