{{-- Page Title --}}
@section('mytitle', '429')

<x-layout>
    <!-- Main Content -->
    <main>
        <div class="container">
            <section class="section error-404">
                <div class="row">
                    <div class="col-md-7">
                        <img src="{{ asset('assets/images/error-429.png') }}" class="img-fluid py-5" alt="Page Not Found">
                    </div>
                    <div class="col-md-5 d-flex flex-column justify-content-center align-items-right gap-3">
                        <h1>Error 429</h1>
                        <h2>Too Many Requests.</h2>
                        <a class="btn rounded-pill btn-kyoored" href="{{ route('landing_page') }}">Back to
                            home</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- /Main Content -->
</x-layout>
