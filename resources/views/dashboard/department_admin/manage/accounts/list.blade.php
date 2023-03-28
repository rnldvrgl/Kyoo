{{-- Page Title --}}
@section('mytitle', 'Accounts List')

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
    <x-dashboard-sidebar name="{{ $role->name }}" :role="$role" />

    <!-- Main Content -->
    <main id="main" class="main">
        <!-- Content Title -->
        <div class="pagetitle">
            <h1>Accounts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Accounts</li>
                    <li class="breadcrumb-item active">Account List</li>
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
                                <h5 class="card-title">Accounts</h5>
                                {{-- Button Trigger --}}
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addAccountModal">
                                    Add Account
                                    <i class="fa-solid fa-user-plus ms-2"></i>
                                </button>
                            </div>

                            <div class="table-responsive">
                                <div id="res">
                                    {{-- Append Success/Error Messages here --}}
                                </div>
                                <table id="accounts-table" class="table-bordered table-hover table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->

        <!-- Modal -->
        <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAccountModalLabel">Add Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="res">
                            {{-- Append Success/Error Messages here --}}
                        </div>

                        <form id="add-accounts-frm" class="row g-3" action="{{ route('manage.accounts.store') }}"
                            method="POST">
                            @csrf

                            {{-- Full Name --}}
                            <div class="col-md-12">
                                <div class="form-floating"> <input type="text" name="fullname" class="form-control"
                                        id="floatingName" placeholder="Full Name"> <label for="floatingName">Full
                                        Name</label></div>
                            </div>

                            {{-- Email Address --}}
                            <div class="col-md-12">
                                <div class="form-floating"> <input type="email" name="email" class="form-control"
                                        id="floatingEmail" placeholder="Email Address"> <label for="floatingEmail">Email
                                        Address</label></div>
                            </div>

                            {{-- Department --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="department" id="floatingDepartment"
                                        aria-label="Department">
                                        @foreach ($all_data['departments'] as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingDepartment">Department</label>
                                </div>
                            </div>

                            {{-- Account Role --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="role" id="floatingRole" aria-label="State">
                                        @foreach ($all_data['account_roles'] as $role)
                                            @if ($role->name == 'Staff')
                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}</option>
                                            @endif
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

    </main>
    <!-- /Main Content -->

    <script>
        $(function() {
            $('#accounts-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.department_accounts.fetch_accounts') }}',
                columns: [{
                        data: 'account_details.name',
                        name: 'account_details.name',
                        width: '15%'
                    },
                    {
                        data: 'department.name',
                        name: 'department.name',
                        width: '10%'
                    },
                    {
                        data: 'account_role.name',
                        name: 'account_role.name',
                        width: '10%'
                    },
                    {
                        data: 'account_login.email',
                        name: 'account_login.email',
                        width: '20%'
                    },
                    {
                        data: 'account_details.phone',
                        name: 'account_details.phone',
                        width: '15%'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return moment.utc(data).utcOffset(480).format(
                                'MMMM D YYYY, hh:mm:ss A');
                        },
                        width: '15%'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data) {
                            return moment.utc(data).utcOffset(480).format(
                                'MMMM D YYYY, hh:mm:ss A');
                        },
                        width: '15%'
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
