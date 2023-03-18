{{-- Page Title --}}
@section('mytitle', 'Sign In')

@php
    $kyooLogo = asset('assets/images/kyoo-logo.svg');
    $avatarIcon = asset('assets/images/avatar.svg');
@endphp
<x-layout>
    <div class="opacity-25" id="background-image"></div>
    <section class="container d-flex justify-content-center align-items-center p-0 py-lg-5 min-vh-100">
        <div class="card rounded-5 shadow-lg mb-0">
            <div class="card-body pt-5 vstack justify-content-center align-items-center p-sm-3 p-md-4 p-lg-5">
                <!-- Avatar icon -->
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img class="img-fluid" src="{{ $avatarIcon }}" alt="avatar icon">
                </div>
                <h4 class="card-title fw-bold mb-4 text-center">{{ __('Login to Your Account') }}</h4>
                @if (session('error'))
                    <div class="alert alert-danger mb-3">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-kyoored btn-lg">{{ __('Login') }}</button>
                    </div>
                    <div class="d-grid mb-3">
                        <a href="{{ route('kiosk') }}"
                            class="btn btn-outline-kyoodark btn-lg">{{ __('Access Kiosk') }}</a>
                    </div>
                </form>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="btn btn-outline-kyoored rounded-pill px-3 mb-2 mb-lg-0"
                        href="{{ route('landing_page') }}">RETURN
                        TO
                        LANDING PAGE</a>
                </div>
            </div>
        </div>
    </section>
</x-layout>
