{{-- Page Title --}}
@section('mytitle', 'Services List')

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
                    <li class="breadcrumb-item active">Services List</li>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Services</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addServiceModal">
                                    <i class="fas fa-plus me-2"></i>
                                    Add Service
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="services-list-table" class="display w-100">
                                    <caption>List of Services</caption>
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Services</th>
                                            <th>Status</th>
                                            <th>Date Added</th>
                                            <th>Date Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Insert DataTable here --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->

        <!-- Add Service Modal -->
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Add Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="res">
                            {{-- Append Success/Error Messages here --}}
                        </div>
                        <form id="add-services-from-list-frm" action="{{ route('manage.services-from-list.add') }}"
                            method="POST" autocomplete="off">

                            @csrf

                            {{-- Department --}}
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="department_id" id="floatingDepartment"
                                        aria-label="Department">
                                        <option value="" selected disabled>Select
                                            Department</option>
                                        @foreach ($all_data['departments'] as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingDepartment">Department</label>
                                </div>
                            </div>

                            {{-- Full Name --}}
                            <div class="col-12">
                                <div class="form-floating mb-3"> <input type="text" name="service_name"
                                        class="form-control" id="floatingServiceName" placeholder="Service Name"
                                        pattern="^[a-zA-Z ]*$">
                                    <label for="floatingServiceName">Service
                                        Name</label>
                                </div>
                            </div>

                            <!-- Status Switch -->
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="status-switch" name="status"
                                    value="active">
                                <label class="form-check-label" for="status-switch">Active</label>
                            </div>
                            <div class="row gap-md-0 gap-2">
                                <div class="col-md-6 order-md-first order-last">
                                    <div class="d-grid gap-2">
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fas fa-eraser me-2"></i>
                                            Clear Input Fields
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 order-md-last order-first">
                                    <div class="d-grid gap-2">
                                        <button id="btn-save-service-from-list" type="submit" class="btn btn-success">
                                            <i class="fa-solid fa-plus me-2"></i>
                                            Add Service
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /Main Content -->

    {{-- For FAQs Table --}}
    <script>
        $(function() {
            $('#services-list-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.services.fetchToList') }}',
                columns: [{
                        data: 'department_name',
                        name: 'department_name',
                        width: '10%'
                    },
                    {
                        // Service Name
                        data: 'name',
                        name: 'name',
                        width: '20%'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            var badgeClass = '';
                            var badgeText = '';
                            if (data == 'active') {
                                badgeClass = 'badge rounded-pill text-bg-success';
                                badgeText = 'Active';
                            } else if (data == 'inactive') {
                                badgeClass = 'badge rounded-pill text-bg-danger';
                                badgeText = 'Inactive';
                            }
                            return '<span class="' + badgeClass + '" style="font-size: 14px;" >' +
                                badgeText + '</span>';
                        },
                        width: '15%',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return moment.utc(data).utcOffset(480).format(
                                'MMMM D YYYY, hh:mm:ss A');
                        },
                        width: '20%'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data) {
                            return moment.utc(data).utcOffset(480).format(
                                'MMMM D YYYY, hh:mm:ss A');
                        },
                        width: '20%'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        width: '10%',
                        className: 'text-center'
                    }
                ],
                paging: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100]
            });
        });
    </script>
</x-layout>
