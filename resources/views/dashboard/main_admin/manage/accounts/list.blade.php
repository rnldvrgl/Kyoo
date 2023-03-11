{{-- Page Title --}}
@section('mytitle', 'Account List')

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
                            <h5 class="card-title">Accounts</h5>

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <div class="table-responsive">
                                <table id="accounts-table" class="table table-bordered table-hover" style="width:100%">
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
    </main>
    <!-- /Main Content -->

    <script>
        $(function() {
            $('#accounts-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.accounts.fetch_accounts') }}',
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
