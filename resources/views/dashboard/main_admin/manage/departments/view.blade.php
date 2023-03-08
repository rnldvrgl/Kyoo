{{-- Page Title --}}
@section('mytitle', 'View Department')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
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
            <h1>Department Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('manage.departments.index') }}">Departments</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('manage.departments.index') }}">Department List</a></li>
                    <li class="breadcrumb-item active">{{ $department->name }}</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->

        <!-- Content Section -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div
                            class="card-body profile-card pt-4 d-flex flex-column justify-content-center align-items-center">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class="fw-bold text-kyoored">{{ $department->name }}</h1>
                                    <p>Department Name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card profile-overview">
                        <div class="card-body pt-3">
                            <h4 class="text-kyoored mb-3">Department Details</h4>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 fw-bold">
                                    <h6 class="mb-0"><strong>Description:</strong></h6>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <p class="mb-0">{{ $department->description }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 fw-bold">
                                    <h6 class="mb-0"><strong>Department Code:</strong></h6>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <p class="mb-0">{{ $department->code }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 fw-bold">
                                    <h6 class="mb-0"><strong>Status:</strong></h6>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    @if ($department->status == 'active')
                                        <span class="badge rounded-pill text-bg-success">Active</span>
                                    @elseif($department->status == 'inactive')
                                        <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 fw-bold">
                                    <h6 class="mb-0"><strong>Created at:</strong></h6>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <p class="mb-0">{{ $department->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 fw-bold">
                                    <h6 class="mb-0"><strong>Last updated:</strong></h6>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <p class="mb-0">{{ $department->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
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
