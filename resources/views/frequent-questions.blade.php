{{-- Page Title --}}
@section('mytitle', 'Frequently Asked Questions')

{{-- Main Content --}}
<x-layout>

    {{-- Back to top button --}}
    <x-return-top />

    {{-- Include Header Bar --}}
    <x-header-link />

    <!-- Banner -->
    <div class="banner bg-kyoodark text-white shadow">
        <div class="container-fluid py-5 py-lg-4 d-flex justify-content-around align-items-center">
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
    </div>

    <!-- Main Content -->
    <main class="p-5">
        <section class="section">
            <div class="container-fluid px-lg-5">
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
                    <div class="col-lg-6 mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-pill" placeholder="Search a question ..."
                                aria-label="Search input" aria-describedby="search-addon">
                            <button class="btn btn-kyoodark rounded-pill ms-2" type="button" id="search-addon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="row mt-2" id="search-results" style="display:none;">
                    <div class="col-lg-6 mx-auto">
                        <p class="text-center"><span id="results-count"></span> found.</p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-10 mx-auto">
                        <div class="row">
                            <!-- First column of accordion items -->
                            <div class="col-lg-6">
                                <div class="accordion" id="frequent-questions-1">
                                    @foreach ($faqs->take(ceil(count($faqs) / 2)) as $index => $faq)
                                        <div class="accordion-item mb-3">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $index }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $index }}"
                                                data-bs-parent="#frequent-questions-1">
                                                <div class="accordion-body">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Second column of accordion items -->
                            <div class="col-lg-6">
                                <div class="accordion" id="frequent-questions-2">
                                    @foreach ($faqs->slice(ceil(count($faqs) / 2)) as $index => $faq)
                                        <div class="accordion-item mb-3">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $index }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $index }}"
                                                data-bs-parent="#frequent-questions-2">
                                                <div class="accordion-body">
                                                    {{ $faq->answer }}
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

            searchBtn.on('click', function() {
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
            });
        });
    </script>


</x-layout>
