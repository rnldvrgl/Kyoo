{{-- Page Title --}}
@section('mytitle', 'Edit Account')

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
                    <li class="breadcrumb-item active">Edit Account</li>
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
                            <h5 class="card-title">Edit Account</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <form id="edit-accounts-frm" class="row g-3" action="{{ route('manage.accounts.update') }}"
                                method="POST" novalidate>

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="id" value="{{ $account->id }}">

                                {{-- Full Name --}}
                                <div class="col-md-12">
                                    <div class="form-floating"> <input type="text" name="fullname"
                                            class="form-control" id="floatingName" placeholder="Full Name"
                                            value="{{ $account->account_details->name }}" required
                                            pattern="/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/"> <label
                                            for="floatingName">Full Name</label></div>
                                </div>

                                {{-- Email Address --}}
                                <div class="col-md-12">
                                    <div class="form-floating"> <input type="email" name="email"
                                            class="form-control" id="floatingEmail" placeholder="Email Address"
                                            value="{{ $account->account_login->email }}" required> <label
                                            for="floatingEmail">
                                            Email Address</label></div>
                                </div>

                                {{-- Department --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="department" id="floatingDepartment"
                                            aria-label="Department">
                                            <option value="" disabled>Select Department</option>
                                            @foreach ($all_data['departments'] as $department)
                                                <option
                                                    {{ $account->department->id == $department->id ? 'selected' : '' }}
                                                    value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingDepartment">Department</label>
                                    </div>
                                </div>

                                {{-- Account Role --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="role" id="floatingRole" aria-label="State">
                                            <option value="" disabled>Select Account Role</option>
                                            @foreach ($all_data['account_roles'] as $role)
                                                <option {{ $account->account_role->id == $role->id ? 'selected' : '' }}
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingRole">Role</label>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="text-center">
                                    <a href="{{ route('manage.accounts.index') }}" class="btn btn-kyoored">
                                        <i class="fa-solid fa-arrow-left"></i>
                                        Go back
                                    </a>

                                    {{-- TODO: Update functionality --}}
                                    <button type="submit" class="btn btn-success" id="btn-update-account">
                                        Update
                                        <i class="fa-solid fa-chevron-right"></i>
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
