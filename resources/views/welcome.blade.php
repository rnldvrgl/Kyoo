{{-- Extend Layout File --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('mytitle', 'Home')

{{-- Include Navbar --}}
@include('partials.__navbar')

{{-- Main Content --}}
@section('content')
    {{-- Hero Section --}}
    <section class="d-flex justify-content-center align-items-center bg-kyoodark text-white pt-5 px-2 mb-0 overflow-hidden">
        <div class="container">
            <div class="row gx-5 align-items-center">
                {{-- Left Item --}}
                <div class="col-lg-5">
                    <div data-aos="fade-right" data-aos-duration="1000"
                        class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid" src="{{ asset('assets/images/waiting-line.svg') }}" alt="Waiting Line">
                    </div>
                </div>
                {{-- Right Item --}}
                <div class="col-lg-7">
                    <div data-aos="fade-left" data-aos-duration="2000" class="text-center text-lg-start">
                        <h1 class="display-5 fw-bold">Handle your queues wisely and instantaneously</h1>
                        <p class="text-white-50">The Republic Central Colleges is committed to providing quality services to
                            students, graduates, faculty, and other members of the school.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <img class="img-fluid" src="{{ asset('assets/images/wave.png') }}" alt="wave-down">
    {{-- /Hero Section --}}

    {{-- Frequently Asked Questions --}}
    <section id="faqs" class="container col-lg-8 p-md-5 p-0 section" style="margin-top: -50px;">
        <div class="d-flex flex-column gap-3 p-md-5 px-3 py-5 ">
            <div data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                class="d-flex flex-column justify-content-center align-items-center gap-3 text-center mb-3">
                <h2 class="display-6 fw-bold">FAQs</h2>
                <p>Frequently Asked Questions</p>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div data-aos="fade-up" data-aos-delay:"3000" class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the
                            collapse plugin adds the appropriate classes that we use to style each element. These classes
                            control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                            modify any of this with custom CSS or overriding our default variables. It's also worth noting
                            that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay:"3000" class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
                            collapse plugin adds the appropriate classes that we use to style each element. These classes
                            control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                            modify any of this with custom CSS or overriding our default variables. It's also worth noting
                            that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay:"3000" class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                            collapse plugin adds the appropriate classes that we use to style each element. These classes
                            control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                            modify any of this with custom CSS or overriding our default variables. It's also worth noting
                            that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
            <a href="/frequent-questions" data-aos="fade-up" data-aos-delay:"3000" class="btn btn-outline-kyoored">View More
                >></a>
        </div>
    </section>
    {{-- /Frequently Asked Questions --}}

    {{-- Send Feedback Section --}}
    <img class="img-fluid" src="{{ asset('assets/images/wave-up.svg') }}" alt="wave-down">
    <section id="feedback" class="bg-kyoodark border-bottom pb-5 border-2 border-kyoored ">
        <div class="container col-lg-12 p-5">
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay:"3000"
                    class="gap-3 text-center text-white mb-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua.</p>
                    <h2 class="display-6 fw-bold">SEND FEEDBACK</h2>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center align-items-center gap-5">
                        <div data-aos="zoom-in" data-aos-anchor-placement="top-bottom" class="d-none d-lg-flex col-lg-4">
                            <img class="img-fluid" src="{{ asset('assets/images/kyoo-logo.svg') }}" alt="Kyoo Logo">
                        </div>
                        <div class="col-lg-8">
                            <!-- Form -->
                            <form action="#" method="POST" class="needs-validation d-flex flex-column gap-3"
                                novalidate>
                                <!-- Full Name Input -->
                                <div data-aos="zoom-in-right" data-aos-delay:"3000" class="col-lg-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingName" name="fullname"
                                            placeholder="Full Name" title="Enter Full Name">
                                        <label for="floatingName">Full Name (Optional)</label>
                                    </div>
                                </div>
                                <!-- Department Description Input -->
                                <div data-aos="zoom-in-right" data-aos-delay:"1000" class="col-lg-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Description" id="floatingMessage" name="dept-desc"
                                            style="min-height: 100px; max-height: 200px;" required></textarea>
                                        <label for="floatingMessage">Feedback</label>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Required
                                        </div>
                                    </div>
                                </div>

                                <!-- Button Send -->
                                <button data-aos="zoom-in-right" data-aos-delay:"3000" type="submit"
                                    name="send-feedback" class="btn btn-kyoored">
                                    Send Feedback
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    {{-- /Send Feedback Section --}}

    {{-- Include Footer Bar --}}
    @include('partials.__footer')
    {{-- /Include Footer Bar --}}

@endsection