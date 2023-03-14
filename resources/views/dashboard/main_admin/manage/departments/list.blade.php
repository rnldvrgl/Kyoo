{{-- Page Title --}}
@section('mytitle', 'Department List')

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
            <h1>Departments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Departments</li>
                    <li class="breadcrumb-item active">Department List</li>
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
                                <h5 class="card-title">Departments</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addDepartmentModal">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Add Department
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table id="departments-table" class="table-bordered table-hover table"
                                    style="width:100%">
                                    <caption>List of Departments</caption>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Code</th>
                                            <th>Date Added</th>
                                            <th>Date Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->

        <!-- Add Department Modal -->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="res">
                            {{-- Append Success/Error Messages here --}}
                        </div>
                        <form id="add-departments-frm" action="{{ route('manage.departments.store') }}" method="POST">
                            @csrf
                            {{-- Department Name --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="floatingDepartmentName"
                                    placeholder="Department Name" required>
                                <label for="floatingDepartmentName">Department Name</label>
                            </div>

                            {{-- Department Code --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="code" id="floatingDepartmentCode"
                                    placeholder="Department Code" required>
                                <label for="floatingDepartmentCode">Department Code</label>
                            </div>

                            {{-- Department Description --}}
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Description" name="description" id="floatingDescription"
                                    style="height: 100px; min-height: 100px; max-height: 150px;"></textarea>
                                <label for="floatingDescription">Description</label>
                            </div>

                            <!-- Status Switch -->
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="status-switch" name="status"
                                    value="active">
                                <label class="form-check-label" for="status-switch">
                                    <span class="fw-bold">Status:</span>
                                    <span class="ms-2" id="status-label">Inactive</span>
                                </label>
                            </div>


                            {{-- Buttons --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" id="btn-save-department">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Add Department
                                </button>
                                <button type="reset" class="btn btn-kyoored">
                                    <i class="fas fa-eraser me-2"></i>
                                    Clear Input Fields
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /Main Content -->

    {{-- For Department Table --}}
    <script>
        $(function() {
            $('#departments-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.departments.fetch_departments') }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                        width: '30%'
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
                        data: 'code',
                        name: 'code',
                        width: '10%'
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
