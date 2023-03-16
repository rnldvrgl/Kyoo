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
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    <!-- Add Service Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addServiceModal">
                                        <i class="fas fa-plus me-2"></i>
                                        Add Service
                                    </button>

                                    <!-- Update Services Button trigger modal -->
                                    <button id="update-services" type="button" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#updateServiceModal"
                                        data-department-id="{{ $department->id }}">
                                        <i class="fas fa-edit me-2"></i>
                                        Update Services
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    @if ($services->count() == 0)
                                        <p class="text-danger fw-bold mt-3 text-center">No Service(s) Assigned</p>
                                    @else
                                        <ul class="list-group list-group-flush mt-3">
                                            @foreach ($services->sortBy('name') as $service)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>{{ $service->name }}</div>
                                                    @if ($service->status == 'active')
                                                        <span
                                                            class="badge bg-success rounded-pill">{{ $service->status }}</span>
                                                    @elseif ($service->status == 'inactive')
                                                        <span
                                                            class="badge bg-danger rounded-pill">{{ $service->status }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
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
                                            pattern="^[a-zA-Z ]*$">
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
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalLabel">Update Services</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="services-res">
                            {{-- Append Success/Error Messages here --}}
                        </div>
                        <table id="services-table" class="table-bordered w-100 table">
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

                        {{-- Buttons --}}
                        <div class="text-center">
                            <button class="btn btn-kyoored">
                                <i class="fas fa-trash me-2"></i>
                                Delete All
                            </button>

                            <button class="btn btn-success" id="btn-update-services">
                                Update
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
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

            $('#services-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.services.fetch', ['id' => $department->id]) }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            return '<input class="form-control w-100" type="text" value="' + data +
                                '" style="max-width: 90%;">';
                        },
                        width: '60%',
                        targets: 0,
                        padding: '10px',
                        orderable: true,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            let isChecked = data == 'active';
                            let statusText = isChecked ? 'Active' : 'Inactive';
                            return '<div class="form-check form-switch mb-4"> ' +
                                '<input class="form-check-input status-switch" type="checkbox" name="status" value="active" ' +
                                (isChecked ? 'checked' : '') + '> ' +
                                '<label class="form-check-label" for="status-switch"> ' +
                                '<span class="fw-bold"> Status: </span> ' +
                                '<span class="ms-2" id="status-label">' + statusText +
                                '</span> ' +
                                '</label> ' +
                                '</div>';
                        },
                        width: '30%',
                        targets: 1,
                        padding: '10px'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        width: '10%',
                        targets: 2,
                        padding: '10px',
                        render: function(data, type, full, meta) {
                            return '<button class="btn btn-danger btn-delete remove-service" data-id="' +
                                full.id +
                                '"><i class="fa fa-trash"></i></button>';
                        }
                    }
                ],
                paging: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    searchPlaceholder: 'Search Services...',
                    zeroRecords: 'No matching services found'
                },
                autoWidth: false,
                order: [
                    [0, 'asc']
                ],
            });

            $('#services-table').on('click', '.remove-service', function() {
                let row = $(this).closest('tr');
                $.confirm({
                    type: "red",
                    title: 'Remove Confirmation',
                    icon: "fa-solid fa-trash-can",
                    content: 'Are you sure you want to remove this service?',
                    theme: "Modern",
                    draggable: false,
                    typeAnimated: true,
                    buttons: {
                        confirm: function() {
                            row.remove();
                            // Add an AJAX request to remove the service from the database here
                        },
                        cancel: function() {
                            // Do nothing
                        }
                    }
                });
            });


            $('#btn-update-services').on('click', function() {

                let services = [];
                let status = [];

                // Fetch all services and push them into the services array
                $('#services-table tr td:nth-child(1) input').map(function() {
                    return services.push($(this).val());
                }).get();

                // Fetch all status and push them into the status array
                $('#services-table tr td:nth-child(2) .status-switch').map(function() {
                    return status.push($(this).prop('checked') ? 'active' : 'inactive');
                }).get();

                // CSRF Protection
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                // AJAX Request to ServiceController update() method
                $.ajax({
                    url: '{{ route('manage.services.update') }}',
                    type: "POST",
                    data: {
                        department_id: department_id,
                        services: services,
                        status: status
                    },
                    success: function(response) {
                        if (response.code == 400) {
                            // List of errors
                            let errors = Object.values(response
                                .errors
                                ); // Extract the array of error messages from the response.errors object
                            let errorsHtml = "<ul class='list-unstyled'>";
                            errorsHtml += "<li>" + errors[0] +
                                "</li>"; // This return only the first index key value pair
                            errorsHtml += "</ul>";

                            // Encase error messages here
                            $("#services-res").html(
                                '<div class="row alert alert-danger pb-0">' +
                                errorsHtml +
                                "</div>"
                            );
                        } else if (response.code == 200) {
                            let success =
                                '<div class="alert alert-success">' +
                                response.success +
                                "</div>";

                            $("#services-res").html(success);

                            // Auto refresh the current page
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
</x-layout>
