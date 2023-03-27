{{-- Page Title --}}
@section('mytitle', 'View Account')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp

<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" />

    {{-- Dashboard Sidebar --}}
    <x-dashboard-sidebar name="{{ $role->name }}" :role="$role" />

    <!-- Main Content -->
    <main id="main" class="main">
        <!-- Content Title -->
        <div class="pagetitle">
            <h1>Accounts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('manage.accounts.index') }}">Accounts</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('manage.accounts.index') }}">Account List</a></li>
                    <li class="breadcrumb-item active">{{ $account->account_details->name }}</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->
        <!-- Content Section -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <a href="{{ route('manage.accounts.index') }}"
                                class="btn btn-kyoored btn-sm align-self-start">
                                <i class="fa-solid fa-arrow-left"></i>
                                Return
                            </a>

                            <img id="image_avatar"
                                src="{{ asset('storage/profile_images/' . ($account->account_details->profile_image ?? 'avatar.png')) }}"
                                alt="Profile" class="rounded-circle" />
                            <h2>{{ $account->account_details->name }}</h2>
                            <h3>{{ $account->account_role->name }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card profile-overview">
                        <div class="card-body pt-3">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">
                                {{ $account->account_details->about }}
                            </p>
                            <h5 class="card-title">
                                Profile Details
                            </h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Full Name
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $account->account_details->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Department
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $account->department->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Position
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $account->account_role->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Address
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $account->account_details->address }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Phone
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $account->account_details->phone }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Email
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $account->account_login->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /Content Section -->
    </main>
    <!-- /Main Content -->
</x-layout>
