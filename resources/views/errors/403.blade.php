{{-- Page Title --}}
@section('mytitle', '403')

<x-layout>
    <!-- Main Content -->
    <main>
        <div class="container ">
            <section class="section error-404">
                <div class="row py-5">
                    <div class="col-md-7">
                        <img src="{{ asset('assets/images/error-403.png') }}" class="img-fluid py-5" alt="Page Not Found">
                    </div>
                    <div class="col-md-5 d-flex flex-column justify-content-center text-center text-md-start gap-3">
                        <h1>Access Denied</h1>
                        <h2>Sorry, you do not have permission to access this page.</h2>
                        <p>If you believe this is an error, please contact the website administrator.</p>
                        <a class="btn rounded-pill btn-kyoored" href="{{ route('landing_page') }}">Go back to Home</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- /Main Content -->
</x-layout>
