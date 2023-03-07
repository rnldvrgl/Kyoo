{{-- Page Title --}}
@section('mytitle', 'Add Account')

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
                    <li class="breadcrumb-item active">Add Account</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->
        <!-- Content Section -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Account</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <form id="add-accounts-frm" class="row g-3" action="{{ route('manage.accounts.store') }}"
                                method="POST">

                                @csrf

                                {{-- Full Name --}}
                                <div class="col-md-12">
                                    <div class="form-floating"> <input type="text" name="fullname"
                                            class="form-control" id="floatingName" placeholder="Full Name"> <label
                                            for="floatingName">Full
                                            Name</label></div>
                                </div>

                                {{-- Email Address --}}
                                <div class="col-md-12">
                                    <div class="form-floating"> <input type="email" name="email"
                                            class="form-control" id="floatingEmail" placeholder="Email Address"> <label
                                            for="floatingEmail">
                                            Email Address</label></div>
                                </div>

                                {{-- Department --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="department" id="floatingDepartment"
                                            aria-label="Department">
                                            <option value="" selected disabled>Select Department</option>
                                            @foreach ($all_data['departments'] as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingDepartment">Department</label>
                                    </div>
                                </div>

                                {{-- Account Role --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="role" id="floatingRole" aria-label="State">
                                            <option value="" selected disabled>Select Account Role</option>
                                            @foreach ($all_data['account_roles'] as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingRole">Role</label>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" id="btn-save-account">
                                        <i class="fa-solid fa-user-plus"></i>
                                        Add Account
                                    </button>
                                    <button type="reset" class="btn btn-kyoored">
                                        <i class="fa-regular fa-trash-can"></i>
                                        Clear Input Fields
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->
    </main>
    <!-- /Main Content -->
</x-layout>
