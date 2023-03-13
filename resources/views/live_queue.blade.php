{{-- Page Title --}}
@section('mytitle', 'Live Queue')

{{-- Main Content --}}
<x-layout>
    <!-- Header Navbar -->
    <header id="header" class="header d-flex align-items-center bg-kyoodark">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/images/kyoo-logo.png') }}" alt="Kyoo Logo" />
                <span class="d-none d-lg-block">Queueing Management System</span>
            </a>
        </div>
        <nav class="header-nav ms-auto d-none d-md-block">
            <ul id="datetimefield" class="d-flex align-items-center pe-3 text-center text-white ">
                <li class="nav-item pe-3 text-center">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span class="fw-normal date">
                    </span>
                </li>
                <li class="nav-item">
                    <i class="fa-regular fa-clock"></i>
                    <span class="fw-normal time">
                    </span>
                </li>
            </ul>
        </nav>
    </header>
    <!-- /Header Navbar -->

    <!-- Main Content -->
    <main class="px-2 py-3 mh-100">
        <section class="section">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-xl-2">
                    <div class="col mb-4">
                        <div class="row row-cols-1 row-cols-lg-2">
                            @foreach ($ticket_data['departments'] as $department_data)
                                <x-current-serving-card :department="$department_data" />
                            @endforeach
                        </div>
                    </div>
                    {{-- <button class="btn btn-kyoored" id="testButton">TTS Test Button</button> --}}
                    <div class="col d-none d-xl-block">
                        <div class="col-auto flex-grow-1" style="max-width: 100%;">
                            @php
                                $videos = \Illuminate\Support\Facades\File::files(public_path('assets/video'));
                                $video = count($videos) > 0 ? $videos[0]->getBasename() : '';
                            @endphp
                            <video class="video" id="loop_video" src="{{ asset('assets/video/' . $video) }}" loop
                                autoplay muted style="max-width: 100%; height: auto;"></video>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    <!-- Marquee Text  -->
    <marquee class="d-none d-lg-block bg-kyoodark text-white fixed-bottom py-2 fw-normal">
        Republic Central Colleges (RCC) envisions herself to be among the leading higher education institutions in the
        region, having achieved excellence in its academic programs, research activities and community extension
        services
        through highly qualified human resources, modern facilities, effective and efficient organization and management
        policies and procedures, as well as sustainable finances.
    </marquee>
    <!-- /Marquee Text  -->
</x-layout>
