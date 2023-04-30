{{-- Page Title --}}
@section('mytitle', 'Department Admin Dashboard')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp


<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" :department="$department" />


    <x-dashboard-sidebar :role="$role" />

    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/main-admin/dashboard">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <h5 class="date mb-3"></h5>
        <section class="section dashboard">

            {{-- Hidden Department ID --}}
            <input type="hidden" id="department_id" value="{{ $department->id }}">

            <div class="row">
                <div class="col-lg-8">
                    {{-- ! Export Button --}}
                    <button type="button" class="me-3" data-bs-toggle="modal" data-bs-target="#exportModal">Export
                        Report</button>
                    <div class="row">
                        {{-- Pending --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark rounded-5 mb-4 text-white shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Pending | Today</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-stopwatch text-pastel-yellow"></i>
                                        </div>
                                    </div>
                                    <hr class="border-1 border-pastel-yellow my-0 border">
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div class="h1 mb-0">{{ $pending_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Current Serving --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark rounded-5 mb-4 text-white shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Current Serving | Today</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fas fa-user-check text-pastel-blue"></i>
                                        </div>
                                    </div>

                                    <hr class="border-1 border-pastel-blue my-0 border">
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div class="h1 mb-0">{{ $serving_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Served --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark rounded-5 mb-4 text-white shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Served | Today</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fas fa-clipboard-check text-pastel-mint"></i>
                                        </div>
                                    </div>

                                    <hr class="border-1 border-pastel-mint my-0 border">
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div class="h1 mb-0">{{ $served_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Completed Tickets --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark rounded-5 mb-4 text-white shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Resolved Tickets</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-check-circle text-pastel-sky-blue"></i>
                                        </div>
                                    </div>
                                    <hr class="border-1 border-pastel-sky-blue my-0 border">
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div class="h1 mb-0">{{ $completed_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">tickets have been resolved</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Cancelled Tickets --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark rounded-5 mb-4 text-white shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Cancelled Tickets</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-times-circle text-pastel-red"></i>
                                        </div>
                                    </div>
                                    <hr class="border-1 border-pastel-red my-0 border">
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div class="h1 mb-0">{{ $cancelled_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">tickets have been cancelled</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Active Staff --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">Active Staff</h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-user-check text-success"></i>
                                            </div>
                                        </div>
                                        <hr class="border-1 border-success my-0 border">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end mt-3">
                                        <div class="h1 mb-0">{{ $activeStaff }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">staff(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    {{-- Staffs Working --}}
                    <div class="card bg-kyoodark rounded-5 h-100 text-white shadow-lg">
                        <div class="card-body p-4">
                            <div class="container-fluid">
                                @foreach ($all_data['departments'] as $department)
                                    <div class="d-flex justify-content-between">
                                        <h5 class="fw-bold mb-0 text-white">{{ $department->name }}</h5>
                                        <span class="badge bg-primary">
                                            {{ $department->accounts->filter(function ($account) {
                                                    return ($account->account_login->status == 'Logged In' || $account->account_login->status == 'On Break') &&
                                                        $account->role_id !== 2;
                                                })->count() }}
                                        </span>
                                    </div>
                                    @if ($department->accounts->count() > 0)
                                        @php
                                            $occupiedStaff = [];
                                        @endphp
                                        @foreach ($department->accounts as $account)
                                            @if ($account->account_login->status == 'Logged In' || $account->account_login->status == 'On Break')
                                                @php
                                                    $accountDetails = $account->account_details;
                                                    $role_id = $account->role_id;
                                                @endphp
                                                @if ($role && $role_id !== 2)
                                                    @php
                                                        $occupiedStaff[] = $accountDetails->name;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        @if (count($occupiedStaff) > 0)
                                            <div class="mt-3">
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($occupiedStaff as $staff)
                                                        @php
                                                            $staffAccount = App\Models\Accounts::where('department_id', $department->id)
                                                                ->whereHas('account_details', function ($query) use ($staff) {
                                                                    $query->where('name', $staff);
                                                                })
                                                                ->with('account_login')
                                                                ->first();
                                                        @endphp
                                                        <li
                                                            class="list-group-item d-flex justify-content-between bg-kyoodark my-2 px-0 text-white">
                                                            <div class="d-flex">
                                                                <i class="fa-solid fa-user text-primary me-3"></i>
                                                                <h6 class="mb-0">{{ $staff }}</h6>
                                                            </div>
                                                            <span
                                                                class="badge rounded-pill text-kyoodark d-flex justify-content-center align-items-center {{ $staffAccount && $staffAccount->account_login && $staffAccount->account_login->status == 'On Break' ? 'bg-pastel-yellow' : 'bg-pastel-blue' }}">
                                                                @if ($staffAccount && $staffAccount->account_login)
                                                                    {{ $staffAccount->account_login->updated_at->diffForHumans() }}
                                                                    @if ($staffAccount->account_login->status == 'On Break')
                                                                        (On Break)
                                                                    @endif
                                                                @else
                                                                    <i class="fa-solid fa-clock"></i> Not
                                                                    logged in
                                                                @endif
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center mt-3">
                                                <p class="text-secondary mb-0 text-center">All accounts in this
                                                    department are idle</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-flex justify-content-center mt-3">
                                            <p class="text-secondary mb-0 text-center">No accounts in this
                                                department</p>
                                        </div>
                                    @endif

                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>

                {{-- Queue Counts Report (Line Chart) --}}
                <div class="col-12">
                    <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                        <div class="containter-fluid">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <h5 class="fw-bold mb-0 text-white">Queue Counts Report</h5>
                                        <div class="d-flex justify-content-center align-items-center py-2">
                                            <select name="year" id="year-dropdown"
                                                class="form-select-sm rounded-5 bg-transparent text-white">
                                                @if (count($years['years']) > 0)
                                                    @foreach ($years['years'] as $year)
                                                        <option value="{{ $year }}"
                                                            class="bg-transparent text-white">
                                                            {{ $year }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" class="bg-transparent text-white" disabled>
                                                        No
                                                        Available Data
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="border-1 border-pastel-green my-0 border">
                                </div>
                                <div class="chart-container mt-3">
                                    <div id="line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filter Modal --}}
                <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exportModalLabel">Export Report</h5>

                                {{-- Give this a margin-left --}}
                                <span style="margin-left: 1rem;"
                                    title="Leave the filters blank to export dashboard data."><i
                                        class="fa-solid fa-circle-question" style="color: #0080ff;"></i></span>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div id="res">
                                    {{-- Insert Message here --}}
                                </div>

                                <form id="export-department-admin-report"
                                    action="{{ route('export-department-admin-report') }}" method="POST"
                                    autocomplete="off">

                                    @csrf

                                    {{-- Hidden Role --}}
                                    <input type="hidden" name="role" value="{{ $role->name }}">

                                    {{-- Tickets --}}
                                    <div class="row">
                                        <strong>Ticket Status</strong>
                                        <div class="form-floating rounded-pill mb-3">
                                            <select class="form-select" name="ticketStatus" id="floatingTicketStatus"
                                                aria-label="TicketStatus">
                                                <option value="" selected disabled>Select Ticket Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Serving">Serving</option>
                                                <option value="Complete">Complete</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                            <label for="floatingTicketStatus">Staff Status</label>
                                        </div>

                                        <div class="col-6 form-floating mb-3">
                                            <input class="form-control" type="date" name="ticketStartDate"
                                                id="floatingTicketStartDate">
                                            <label for="floatingTicketStartDate">From</label>
                                        </div>

                                        <div class="col-6 form-floating mb-3">
                                            <input class="form-control" type="date" name="ticketEndDate"
                                                id="floatingTicketEndDate">
                                            <label for="floatingTicketEndDate">To</label>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Staff --}}
                                    <strong>Staff Status</strong>
                                    <div class="form-floating rounded-pill mb-3">
                                        <select class="form-select" name="staffStatus" id="floatingStaffStatus"
                                            aria-label="StaffStatus">
                                            <option value="" selected disabled>Select Staff Status</option>
                                            <option value="On Break">On Break</option>
                                            <option value="Logged In">Logged In</option>
                                            <option value="Logged Out">Logged Out</option>
                                        </select>
                                        <label for="floatingStaffStatus">Staff Status</label>
                                    </div>

                                    <input type="hidden" name="department" value="{{ $department->id }}">

                                    <hr>

                                    {{-- Queue Counts --}}
                                    <div class="row">
                                        <strong>Queue Counts</strong>
                                        <div class="col-6 form-floating mb-3">
                                            <input class="form-control" type="date" name="queueStartDate"
                                                id="floatingQueueCountStartDate">
                                            <label for="floatingQueueCountStartDate">From</label>
                                        </div>

                                        <div class="col-6 form-floating mb-3">
                                            <input class="form-control" type="date" name="queueEndDate"
                                                id="floatingQueueCountEndDate">
                                            <label for="floatingQueueCountEndDate">To</label>
                                        </div>
                                    </div>

                                    {{-- Occupied Department --}}
                                    <input type="hidden" name="occupiedDepartment" value="{{ $department->id }}">

                                    <button class="btn btn-primary flex" type="submit" id="btn-submit-filter">
                                        Export
                                        <i class="fa-solid fa-clipboard"></i>
                                    </button>

                                    <button type="reset" class="btn btn-kyoored">
                                        Clear Filter
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Filter Modal --}}
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    {{-- Chart JS --}}
    <script src="{{ asset('assets/js/department-chart.js') }}"></script>

    {{-- Refresh Page JS --}}
    {{-- <script src="{{ asset('assets/js/refreshPage.js') }}"></script> --}}
</x-layout>
