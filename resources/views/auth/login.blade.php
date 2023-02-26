{{-- Extend Layout File --}}
@extends('layouts.app')

{{-- Page Title --}}
@section('mytitle', 'Sign In')

{{-- Main Content --}}
@section('content')
    <div class="opacity-50" id="background-image"></div>
    <section class="container d-flex justify-content-center vh-100 p-5">
        <div class="row row-cols-2 justify-content-center align-items-center h-100 w-100 p-lg-5">
            {{-- Left --}}
            <div
                class="col-lg-5 bg-kyoodark d-none d-lg-flex flex-column justify-content-center align-items-center h-100 px-5 text-center text-white">
                <img class="img-fluid mb-3" src="{{ asset('assets/images/kyoo-logo.svg') }}" alt="Kyoo logo">
                <h4 class="fw-bold text-uppercase">Queueing Management System</h4>
            </div>
            {{-- Right --}}
            <div class="col-12 col-lg-7 bg-light shadow d-flex flex-column justify-content-center align-items-center h-100">
                <img class="img-fluid mb-3" src="{{ asset('assets/images/avatar.svg') }}" alt="avatar icon">
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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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

                    <div class="d-grid col-6 mx-auto">
                        <button type="submit" class="btn btn-kyoored">
                            {{ __('Login') }}
                        </button>

                        {{-- @if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
									@endif --}}
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
