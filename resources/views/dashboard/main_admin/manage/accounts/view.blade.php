{{-- Page Title --}}
@section('mytitle', 'View User')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp

<x-layout>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" />

    {{-- Dashboard Sidebar --}}
    <x-dashboard-sidebar name="{{ $role->name }}" />

    <!-- Main Content -->
    <main id="main" class="main">
        <!-- Content Title -->
        <div class="pagetitle">
            <h1>Accounts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Accounts</li>
                    <li class="breadcrumb-item active">User #ID</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->
        <!-- Content Section -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <h1>Personal Details</h1>
                            <p>Full Name : {{ $account->account_details->name }}</p>
                            <p>Address : {{ $account->account_details->address }}</p>
                            <p>Phone : {{ $account->account_details->phone }}</p>
                            <p>About: {{ $account->account_details->about }}</p>

                            <p>Position : {{ $account->account_role->name }}</p>
                            <p>Department : {{ $account->department->name }}</p>

                            <h2>Account Details</h2>
                            <p>Email : {{ $account->account_login->email }}</p>

                            <a href="{{ route('manage.accounts.index') }}" class="btn btn-kyoored">
                                <i class="fa-solid fa-arrow-left"></i>
                                Go back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->
    </main>
    <!-- /Main Content -->
</x-layout>
