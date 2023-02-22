{{-- Extend Layout File --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('mytitle', 'Live Queue')

{{-- Main Content --}}
@section('content')
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
                <h1 class="fw-bold mb-3">
                    Now Serving
                </h1>
                <div class="row row-cols-1 row-cols-xl-2">
                    <div class="col mb-4">
                        <div class="row row-cols-1 row-cols-lg-2">
                            <div class="col mb-4">
                                <div data-aos="fade-right" data-aos-delay:"3000">
                                    <div class="card shadow border-start  border-kyoodark border-5">
                                        <div class="card-body p-4">
                                            <span class="display-6 fw-bold mb-3 d-block">Cashier</span>
                                            <span class="display-5 text-center">
                                                C0001
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div data-aos="fade-right" data-aos-delay:"3000">
                                    <div class="card shadow border-start border-kyoodark border-5">
                                        <div class="card-body p-4">
                                            <span class="display-6 fw-bold mb-3 d-block">Cashier</span>
                                            <span class="display-5 text-center">
                                                C0001
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div data-aos="fade-right" data-aos-delay:"3000">
                                    <div class="card shadow border-start border-kyoodark border-5">
                                        <div class="card-body p-4">
                                            <span class="display-6 fw-bold mb-3 d-block">Cashier</span>
                                            <span class="display-5 text-center">
                                                <button class="btn btn-kyoored" id="testButton">TTS Test Button</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-xl-block">
                        <div class="col-auto flex-grow-1">
                            <?php
                            $vid = array_slice(scandir(public_path('assets/video/')), 2);
                            
                            $video = isset($vid[0]) ? $vid[0] : '';
                            
                            ?>
                            <video class="h-100 w-100 shadow" id="loop_video" src="{{ asset('assets/video/' . $video) }}"
                                loop autoplay muted></video>
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
        region, having achieved excellence in its academic programs, research activities and community extension services
        through highly qualified human resources, modern facilities, effective and efficient organization and management
        policies and procedures, as well as sustainable finances.
    </marquee>
    <!-- /Marquee Text  -->
@endsection
