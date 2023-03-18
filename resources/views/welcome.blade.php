{{-- Page Title --}}
@section('mytitle', 'Home')

@auth
    @php
        $details = $user_data['details'];
        $role = $user_data['role'];
        $login = $user_data['login'];
        $department = $user_data['department'];
    @endphp
@endauth

<x-layout>

    {{-- Back to top button --}}
    <x-return-top />

    {{-- Include Navigation Bar --}}
    <x-navigation-bar />

    {{-- Hero Section --}}
    <section class="bg-kyoodark text-white pt-5 px-2 mb-0 overflow-hidden" id="home">
        <div class="container">
            <div class="row gx-5 align-items-center">
                {{-- Left Item --}}
                <div class="col-lg-6">
                    <div data-aos="fade-right" data-aos-duration="1000"
                        class="d-flex align-items-center justify-content-center">
                        <img class="img-fluid" src="{{ asset('assets/images/waiting-line.svg') }}" alt="Waiting Line">
                    </div>
                </div>
                {{-- Right Item --}}
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="container">
                        <h1 class="display-5 fw-normal" data-aos="fade-down-left" data-aos-delay="500"
                            data-aos-easing="ease-in-sine">
                            Manage your <span class="fw-bold">queues</span> <span class="fw-semibold">efficiently</span>
                            and <br class="d-lg-none">
                            <span class="fw-semibold">effectively</span>
                        </h1>
                        <p class="lead text-white-50 fw-light" data-aos="zoom-in-down" data-aos-easing="ease-in-sine"
                            data-aos-delay="1200">
                            At The Republic Central Colleges, we understand the importance of efficient queueing. Our
                            queue management system provides <span class="fw-semibold">fast and reliable</span> service
                            to
                            students, graduates, faculty, and other members of the school.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <img class="img-fluid" src="{{ asset('assets/images/wave.png') }}" alt="wave-down" style="max-width: 100%;">
    {{-- /Hero Section --}}


    <section id="faqs" class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <h2 class="display-6 fw-bold">FAQs</h2>
                    <p>Frequently Asked Questions</p>
                </div>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
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
                                <strong>This is the first item's accordion body.</strong> It is shown by default,
                                until
                                the collapse plugin adds the appropriate classes that we use to style each element.
                                These classes control the overall appearance, as well as the showing and hiding via
                                CSS
                                transitions. You can modify any of this with custom CSS or overriding our default
                                variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
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
                                <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                until the collapse plugin adds the appropriate classes that we use to style each
                                element. These classes control the overall appearance, as well as the showing and
                                hiding
                                via CSS transitions. You can modify any of this with custom CSS or overriding our
                                default variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
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
                                <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                until
                                the collapse plugin adds the appropriate classes that we use to style each element.
                                These classes control the overall appearance, as well as the showing and hiding via
                                CSS
                                transitions. You can modify any of this with custom CSS or overriding our default
                                variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                until
                                the collapse plugin adds the appropriate classes that we use to style each element.
                                These classes control the overall appearance, as well as the showing and hiding via
                                CSS
                                transitions. You can modify any of this with custom CSS or overriding our default
                                variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                until
                                the collapse plugin adds the appropriate classes that we use to style each element.
                                These classes control the overall appearance, as well as the showing and hiding via
                                CSS
                                transitions. You can modify any of this with custom CSS or overriding our default
                                variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="/frequent_questions" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                        class="btn btn-outline-kyoored">View More
                        Questions
                        >></a>
                </div>
            </div>
        </div>
    </section>

    {{-- Send Feedback Section --}}
    <section id="feedback" class="bg-kyoodark border-bottom py-5 border-2 border-kyoored">
        <div class="container-fluid px-lg-5">
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="gap-3 text-center text-white">
                    <h2 class="display-6 fw-bold">SEND FEEDBACK</h2>
                    <p>We value your feedback and appreciate you taking the time to share your thoughts with us.</p>
                </div>
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center p-3">
                        <img class="img-fluid" src="{{ asset('assets/images/kyoo-logo.svg') }}" alt="Kyoo Logo"
                            data-aos="zoom-in" data-aos-anchor-placement="top-bottom">
                    </div>

                    <div class="col-lg-7 p-lg-3">
                        <form id="send-feedback-frm" action="{{ route('feedback.store') }}" method="POST"
                            class="needs-validation d-flex flex-column gap-3" novalidate>
                            @csrf
                            <!-- Full Name Input -->
                            <div data-aos="zoom-in-right">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Full Name" title="Enter Full Name">
                                    <label for="fullname">Full Name (Optional)</label>
                                </div>
                            </div>
                            <!-- Feedback Message Input -->
                            <div data-aos="zoom-in-right">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Feedback Message" id="feedback-message" name="feedback-message"
                                        style="min-height: 100px; max-height: 200px;" required></textarea>
                                    <label for="feedback-message">Feedback</label>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                            </div>

                            <!-- Button Send -->
                            <button data-aos="zoom-in-right" type="submit" class="btn btn-success"
                                id="btn-send-feedback">
                                Send Feedback
                                <i class="fa-solid fa-paper-plane ms-3"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- /Send Feedback Section --}}



    {{-- Include Footer Bar --}}
    <x-footer />
    {{-- /Include Footer Bar --}}
</x-layout>
