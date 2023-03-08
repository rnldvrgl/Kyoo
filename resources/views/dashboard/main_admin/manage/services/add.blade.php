{{-- Page Title --}}
@section('mytitle', 'Add Service')

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
            <h1>Services</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Services</li>
                    <li class="breadcrumb-item active">Add Service</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->
        <!-- Content Section -->
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Service</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            {{-- {{ route('manage.services.store') }} --}}
                            <form id="add-services-frm" action="#" method="POST">

                                @csrf

                                {{-- Full Name --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating mb-3"> <input type="text" name="service_name"
                                                class="form-control" id="floatingServiceName"
                                                placeholder="Service Name">
                                            <label for="floatingServiceName">Service
                                                Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        {{-- Department Name --}}
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="department" id="floatingDepartment"
                                                aria-label="Department">
                                                <option value="" selected disabled>Select Department</option>
                                                @foreach ($all_data['departments'] as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="floatingDepartment">Department</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Switch -->
                                <div class="form-check form-switch mb-5">
                                    <input class="form-check-input" type="checkbox" id="status-switch" name="status"
                                        value="active">
                                    <label class="form-check-label" for="status-switch">Active</label>
                                </div>


                                {{-- Buttons --}}
                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-success" id="btn-save-service">
                                        <i class="fa-solid fa-plus"></i>
                                        Add Service
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
