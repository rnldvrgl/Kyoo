{{-- Page Title --}}
@section('mytitle', 'Frequently Asked Questions')

{{-- Main Content --}}
<x-layout>

    {{-- Back to top button --}}
    <x-return-top />


    <!-- Banner -->
    <div class="banner bg-kyoodark text-white shadow">
        <div class="container-fluid py-3 py-lg-4 d-flex justify-content-around align-items-center">
            <div class="row">
                <div data-aos="fade-right" data-aos-duration="2000"
                    class="col-lg-8 d-flex flex-column justify-content-center align-items-left">
                    <h1>Frequently Asked Questions</h1>
                    <h4>What can we help you?</h4>
                </div>
                <div data-aos="fade-left" data-aos-duration="1000"
                    class="col-lg-4 d-none d-lg-block d-flex flex-column justify-content-center align-items-left">
                    <img class="img-fluid" src="{{ asset('assets/images/question.png') }}" alt="">
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="p-5">
            <section class="section">
                <div class="container-fluid px-lg-5">
                    <div class="d-flex flex-column gap-3">
                        <div class="pagetitle">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="fa-solid fa-house-chimney"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Frequently Asked Questions</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="input-group border-bottom border-2 my-4 col-6 mx-auto">
                            <span class="input-group-text bg-transparent border-0">
                                <button class="btn rounded-circle text-kyoored" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                            <input class="form-control py-2 border-0" type="search" placeholder="Type something..."
                                id="example-search-input">
                        </div>
                        <div class="row">
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                            <div data-aos="fade-right" class="col-lg-4">
                                <div class="card border-start border-kyoored border-5">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Quill Editor Bubble</h5>
                                        <p>Select some text to display options in poppovers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- /Main Content -->
</x-layout>
