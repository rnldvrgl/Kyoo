{{-- Page Title --}}
@section('mytitle', 'Sign In')

@php
    $kyooLogo = asset('assets/images/kyoo-logo.svg');
    $avatarIcon = asset('assets/images/avatar.svg');
@endphp

<x-layout>
    <div class="opacity-25" id="background-image"></div>
    <section class="container d-flex justify-content-center p-5">
        <div class="row row-cols-1 row-cols-md-2 justify-content-center align-items-center p-lg-5">
            {{-- Left --}}
            <div
                class="col-md-5 bg-kyoodark d-flex flex-column justify-content-center align-items-center h-100 px-5 text-center text-white">
                <img class="img-fluid mb-3" src="{{ $kyooLogo }}" alt="Kyoo logo">
                <h4 class="fw-bold text-uppercase">Queueing Management System</h4>
            </div>
            {{-- Right --}}
            <div class="col-md-7 bg-light shadow d-flex flex-column justify-content-center align-items-center p-5">
                <img class="img-fluid mb-3" src="{{ $avatarIcon }}" alt="avatar icon">
                <h4 class="fw-semibold">Login to Your Account</h4>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="col-form-label text-md-start">
                            {{ __('Email Address') }}
                        </label>
                        <div class="col">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-form-label text-md-start">{{ __('Password') }}</label>
                        <div class="col">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid col-6 mx-auto mb-3">
                        <button type="submit" class="btn btn-kyoored">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="d-grid col-6 mx-auto mb-3">
                        <a href="{{ route('kiosk') }}" class="btn btn-link">
                            Access Kiosk
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</x-layout>
