{{-- Page Title --}}
@section('mytitle', 'Edit Account')

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
            <h1>Accounts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Accounts</li>
                    <li class="breadcrumb-item active">Edit Account</li>
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
                            
                            @if (session('deleteSuccess'))
                                <div class="alert alert-danger">
                                    {{ session('deleteSuccess') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="accounts-table" class="display w-100">
                                    <caption>List of Accounts</caption>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date Added</th>
                                            <th>Date Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($accounts as $account)
                                        <tr>
                                            <td>{{ $account->account_details->name }}</td>
                                            <td>{{ $account->department->name }}</td>
                                            <td>{{ $account->account_role->name }}</td>
                                            <td>{{ $account->account_login->email }}</td>
                                            <td>{{ $account->account_details->phone }}</td>
                                            <td>{{ $account->created_at }}</td>
                                            <td>{{ $account->updated_at }}</td>
                                            <td class="text-center d-grid gap-1">
                                                <!-- View -->
                                                <button class="btn btn-primary view-account" data-id="#">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>

                                                <!-- Update -->
                                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#update-account-modal" data-id="#">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>

                                                <!-- Delete -->
                                                <button class="btn btn-danger" id="deleteData" href="#">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach --}}
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
            $('#accounts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.accounts.fetch_accounts') }}',
                columns: [
                    { data: 'account_details.name', name: 'account_details.name' },
                    { data: 'department.name', name: 'department.name' },
                    { data: 'account_role.name', name: 'account_role.name' },
                    { data: 'account_login.email', name: 'account_login.email' },
                    { data: 'account_details.phone', name: 'account_details.phone' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
</x-layout>
