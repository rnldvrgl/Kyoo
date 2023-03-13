{{-- Page Title --}}
@section('mytitle', 'View Department')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $profile_image = $details->profile_image;
@endphp

<x-layout :role='$role'>

    {{-- Back to top button --}}
    <x-return-top />

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
                <div class="col-xl-7">
                    <div class="card">
                        <div
                            class="card-body profile-card d-flex flex-column justify-content-center align-items-center pt-4">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class="fw-bold text-kyoored">{{ $department->name }}</h1>
                                    <p>Department Name</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title text-kyoored">Assigned Services</h4>
                                <!-- Add Service Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addServiceModal">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Add Service
                                </button>

                                <!-- Update Services Button trigger modal -->
                                <button id="update-services" type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#updateServiceModal"
                                    data-department-id={{ $department->id }}>
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Update Service
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group">
                                        @if ($services->count() == 0)
                                            <p class="text-danger fw-bold mt-3 text-center">No Service(s) Assigned</p>
                                        @else
                                            @foreach ($services as $service)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $service->name }}
                                                    @if ($service->status == 'active')
                                                        <span
                                                            class="badge bg-success rounded-pill">{{ $service->status }}</span>
                                                    @elseif ($service->status == 'inactive')
                                                        <span
                                                            class="badge bg-danger rounded-pill">{{ $service->status }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
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
                        <form id="add-services-frm" action="{{ route('manage.services.add') }}" method="POST"
                            autocomplete="off">

                            @csrf
                            <input type="hidden" name="department_id" value="{{ $department->id }}">
                            {{-- Full Name --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3"> <input type="text" name="service_name"
                                            class="form-control" id="floatingServiceName" placeholder="Service Name"
                                            pattern="^[a-zA-Z0-9 ]*$">
                                        <label for="floatingServiceName">Service
                                            Name</label>
                                    </div>
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
                                        <button id="btn-save-service" type="submit" class="btn btn-success">
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

        <!-- Update Service Modal -->
        <div class="modal fade" id="updateServiceModal" tabindex="-1" aria-labelledby="updateServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Update Services</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="res">
                            {{-- Append Success/Error Messages here --}}
                        </div>
                        <table id="services-table" class="table-bordered table-hover table" style="width:100%">
                            <caption>List of Services</caption>
                            <thead>
                                <tr>
                                    <th>Service/s</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Insert Data here... --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /Main Content -->

    {{-- For Services Table --}}
    <script>
        $(function() {
            var department_id = {{ $department->id }};

            $('#update-services').on('click', function() {

                var table = $('#services-table').DataTable();

                if ($.fn.DataTable.isDataTable('#services-table')) {
                    table.destroy();
                }

                $('#services-table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('manage.services.fetch', ['id' => ':id']) }}'.replace(':id',
                        department_id),
                    columns: [{
                            data: 'name',
                            name: 'name',
                            width: '30%'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data) {
                                return '<input class="form-check-input" type="checkbox" id="status-switch" name="status" value="active" ' +
                                    '{{ ' + data + ' == 'active' ? 'checked' : '' }}>' +
                                    '<label class="form-check-label" for="status-switch">' +
                                    '<span class="fw-bold">Status:</span>' +
                                    '<span class="ms-2" id="status-label">' +
                                    '{{ ' + data + ' == 'active' ? 'Active' : 'Inactive' }}' +
                                    '</span>' +
                                    '</label>';
                            },
                            width: '15%',
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false,
                            width: '10%',
                            className: 'text-center',
                        }
                    ],
                    paging: true,
                    pageLength: 10,
                    lengthMenu: [10, 25, 50, 100]
                });
            })

            $('#services-table').on('click', '.remove-service', function() {

            });
        });
    </script>
</x-layout>
