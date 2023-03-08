{{-- Page Title --}}
@section('mytitle', 'Edit Department')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
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
            <h1>Departments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Departments</li>
                    <li class="breadcrumb-item active">Edit Department</li>
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
                            <h5 class="card-title">Edit Department</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <form id="edit-departments-frm" action="{{ route('manage.departments.update') }}"
                                method="POST" novalidate>

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="id" value="{{ $department->id }}">

                                <div class="row">
                                    <div class="col-12">
                                        {{-- Department Name --}}
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="name"
                                                id="floatingDepartmentName" placeholder="Department Name"
                                                value="{{ $department->name }}" required>
                                            <label for="floatingDepartmentName">Department Name</label>
                                        </div>

                                        {{-- Department Description --}}
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Description" name="description" id="floatingDescription"
                                                style="height: 100px; min-height: 100px; max-height: 150px;">{{ $department->description }}</textarea>
                                            <label for="floatingDescription">Description</label>
                                        </div>

                                        {{-- Department Code --}}
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="code"
                                                id="floatingDepartmentCode" placeholder="Department Code"
                                                value="{{ $department->code }}" required>
                                            <label for="floatingDepartmentCode">Department
                                                Code</label>
                                        </div>

                                        <!-- Status Switch -->
                                        <div class="form-check form-switch mb-5">
                                            <input class="form-check-input" type="checkbox" id="status-switch"
                                                name="status" value="active"
                                                {{ $department->status == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status-switch">Active</label>
                                        </div>

                                        {{-- Buttons --}}
                                        <div class="d-grid gap-2 mb-3">
                                            <a href="{{ route('manage.departments.index') }}" class="btn btn-kyoored">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Go back
                                            </a>

                                            <button type="submit" class="btn btn-success" id="btn-update-department">
                                                Update
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
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
