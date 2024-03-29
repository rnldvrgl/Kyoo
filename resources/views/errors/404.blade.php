{{-- Page Title --}}
@section('mytitle', '404')

<x-layout>
    <!-- Main Content -->
    <main>
        <div class="container">
            <section class="section error-404">
                <div class="row py-5">
                    <div class="col-md-7">
                        <img src="{{ asset('assets/images/error-404.png') }}" class="img-fluid py-5" alt="Page Not Found">
                    </div>
                    <div
                        class="col-md-5 d-flex flex-column justify-content-center align-items-right text-center text-md-left gap-3">
                        <h1>Whooops!</h1>
                        <h2>Sorry, the page you are looking for doesn't exist.</h2>
                        <a class="btn rounded-pill btn-kyoored" href="{{ route('landing_page') }}">Back to
                            home</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- /Main Content -->
</x-layout>
