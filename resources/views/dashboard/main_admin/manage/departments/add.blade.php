{{-- Page Title --}}
@section('mytitle', 'Add Department')

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
            <h1>Departments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Departments</li>
                    <li class="breadcrumb-item active">Add Department</li>
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
                            <h5 class="card-title">Add Department</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <form id="add-departments-frm" class="row g-3" action="{{ route('manage.departments.store') }}" method="POST">

                                @csrf
                                
                                {{-- Department Name --}}
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" id="floatingDepartmentName"
                                            placeholder="Department Name" required> <label
                                            for="floatingDepartmentName">Department
                                            Name</label>
                                    </div>
                                </div>

                                {{-- Department Description --}}
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Description" name="description" id="floatingDescription"
                                            style="height: 100px; min-height: 100px; max-height: 150px;"></textarea><label for="floatingDescription">Description</label>
                                    </div>
                                </div>

                                {{-- Status Role --}}
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="status" id="floatingStatus" aria-label="State">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        <label for="floatingStatus">Status</label>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" id="btn-save-department">
                                        <i class="fa-solid fa-plus"></i>
                                        Add Department
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
