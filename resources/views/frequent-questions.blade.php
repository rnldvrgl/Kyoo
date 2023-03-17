{{-- Page Title --}}
@section('mytitle', 'Frequently Asked Questions')

{{-- Main Content --}}
<x-layout>
    <style>
        @media (max-width: 991.98px) {
            .accordion-collapse.collapse:not(.show) {
                display: none !important;
            }
        }
    </style>

    {{-- Back to top button --}}
    <x-return-top />

    {{-- Include Header Bar --}}
    <x-header-link />

    <!-- Banner -->
    <div class="banner bg-kyoodark text-white shadow">
        <div class="container-fluid py-5 py-lg-4 d-flex justify-content-center align-items-center">
            <div class="row">
                <div data-aos="fade-right" data-aos-duration="2000"
                    class="col-lg-8 col-12 d-sm-flex flex-column justify-content-center d-none text-left">
                    <h1>Frequently Asked Questions</h1>
                    <h4>What can we help you?</h4>
                </div>

                <div data-aos="fade-right" data-aos-duration="2000"
                    class="col-lg-8 col-12 d-sm-none flex-column justify-content-center d-flex text-center">
                    <h1>Frequently Asked Questions</h1>
                    <h4>What can we help you?</h4>
                </div>

                <div data-aos="fade-left" data-aos-duration="1000"
                    class="col-lg-4 col-12 d-none d-lg-flex flex-column justify-content-center align-items-center">
                    <img class="img-fluid" src="{{ asset('assets/images/question.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <main class="p-3 p-md-5">
        <section class="section">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="fa-solid fa-house-chimney"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Frequently Asked Questions</li>
                    </ol>
                </nav>

                <div class="row mt-4">
                    <div class="col-lg-6 col-12 mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-pill" placeholder="Search a question ..."
                                aria-label="Search input" aria-describedby="search-addon">
                            <button class="btn btn-kyoodark rounded-pill ms-2" type="button" id="search-addon"
                                onclick="searchFunction()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="row mt-2" id="search-results" style="display:none;">
                    <div class="col-lg-6 col-12 mx-auto">
                        <p class="text-center"><span id="results-count"></span> found.</p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="row">
                            <!-- First column of accordion items -->
                            <div class="col-md-6 col-12">
                                <div class="accordion" id="frequent-questions-1">
                                    @foreach ($faqs->take(ceil(count($faqs) / 2)) as $index => $faq)
                                        <div class="accordion-item mb-md-3">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $index }}">
                                                    <span class="d-block d-md-none">{{ $faq->question }}</span>
                                                    <span class="d-none d-md-block fs-6">{{ $faq->question }}</span>
                                                </button>
                                            </h2>

                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $index }}"
                                                data-bs-parent="#frequently-asked-questions">
                                                <div class="accordion-body">
                                                    <span class="d-block d-md-none">{{ $faq->answer }}</span>
                                                    <span class="d-none d-md-block">{{ $faq->answer }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Second column of accordion items -->
                            <div class="col-md-6 col-12">
                                <div class="accordion" id="frequent-questions-2">
                                    @foreach ($faqs->slice(ceil(count($faqs) / 2)) as $index => $faq)
                                        <div class="accordion-item mb-md-3">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $index }}">
                                                    <span class="d-block d-md-none">{{ $faq->question }}</span>
                                                    <span class="d-none d-md-block fs-6">{{ $faq->question }}</span>
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $index }}">
                                                <div class="accordion-body p-3 p-md-4">
                                                    <span class="d-block d-md-none fs-6">{{ $faq->answer }}</span>
                                                    <span class="d-none d-md-block">{{ $faq->answer }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </main>
    <!-- /Main Content -->

    <script>
        $(document).ready(function() {
            const searchBtn = $('#search-addon');
            const searchInput = $('input[type="text"]');
            const faqs = $('.accordion-item');
            const searchResults = $('#search-results');

            const searchFAQs = function() {
                const query = searchInput.val().toLowerCase();
                let count = 0;

                faqs.each(function() {
                    const question = $(this).find('.accordion-button').text().toLowerCase();
                    const answer = $(this).find('.accordion-body').text().toLowerCase();

                    if (question.includes(query) || answer.includes(query)) {
                        $(this).show();
                        count++;
                    } else {
                        $(this).hide();
                    }
                });

                if (count === 0 || count === 1) {
                    searchResults.show().find('#results-count').text(count + ' result');
                } else {
                    searchResults.show().find('#results-count').text(count + ' results');
                }
            };

            searchBtn.on('click', searchFAQs);

            searchInput.on('keypress', function(event) {
                if (event.keyCode === 13) {
                    searchFAQs();
                }
            });
        });
    </script>



</x-layout>
