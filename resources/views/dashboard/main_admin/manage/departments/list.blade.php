{{-- Page Title --}}
@section('mytitle', 'Department List')

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
                            <h5 class="card-title">Departments</h5>
                            <div class="table-responsive">
                                <table id="departments-table" class="table table-bordered table-hover"
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
    </main>
    <!-- /Main Content -->

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
                            return moment.utc(data).utcOffset(480).format('YYYY-MM-DD HH:mm:ss');
                        },
                        width: '20%'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data) {
                            return moment.utc(data).utcOffset(480).format('YYYY-MM-DD HH:mm:ss');
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
