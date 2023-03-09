{{-- Page Title --}}
@section('mytitle', 'Kiosk')

@php
    $kyooLogo = asset('assets/images/kyoo-logo.svg');
@endphp

<x-layout>
    <div class="opacity-25" id="background-image"></div>
    <section class="container d-flex justify-content-center align-items-center min-vh-100 p-5">
        <div
            class="row row-cols-1 row-cols-md-2 justify-content-center align-items-center h-100 w-100 p-lg-5 position-relative">
            @if (isset($message))
                <div id="message"
                    class="alert alert-success position-absolute top-0 start-50 translate-middle text-center mt-5"
                    data-aos="fade-down">
                    {{ $message }}
                </div>
            @endif
            <div
                class="col-md-9 bg-light gap-3 shadow d-flex flex-column justify-content-center align-items-center py-5">
                <h3 class="fw-semibold text-uppercase" data-aos="fade-down">
                    Welcome to
                </h3>
                <img class="img-fluid mb-3" src="{{ $kyooLogo }}" alt="Kyoo logo" data-aos="zoom-out">
                <h4 class="fw-semibold text-uppercase" data-aos="fade-up">
                    Queueing Management System
                </h4>

                <div class="d-grid col-8 col-md-6 mx-auto p-3" data-aos="zoom-in" data-aos-easing="ease-in-out">
                    <a href="{{ route('select-department') }}" class="btn btn-kyoored text-uppercase">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
