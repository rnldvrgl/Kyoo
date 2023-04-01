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

            <div class="row ">
                <div class="col-lg-8">
                    <div class="row">
                        {{-- Pending --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Pending | Today</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-stopwatch text-pastel-yellow"></i>
                                        </div>
                                    </div>
                                    <hr class="border border-1 border-pastel-yellow my-0">
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
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Current Serving | Today</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fas fa-user-check text-pastel-blue"></i>
                                        </div>
                                    </div>

                                    <hr class="border border-1 border-pastel-blue my-0">
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
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white ">Served | Today</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fas fa-clipboard-check text-pastel-mint"></i>
                                        </div>
                                    </div>

                                    <hr class="border border-1 border-pastel-mint my-0">
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
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-white">Resolved Tickets</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-check-circle text-pastel-sky-blue"></i>
                                        </div>
                                    </div>
                                    <hr class="border border-1 border-pastel-sky-blue my-0">
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
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0  text-white ">Cancelled Tickets</h5>
                                        <div class="card-icon d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-times-circle text-pastel-red"></i>
                                        </div>
                                    </div>
                                    <hr class="border border-1 border-pastel-red my-0">
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
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">Active Staff</h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-user-check text-success"></i>
                                            </div>
                                        </div>
                                        <hr class="border border-1 border-success my-0">
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
                    <div class="card bg-kyoodark text-white rounded-5 shadow-lg h-100">
                        <div class="card-body p-4">
                            <div class="container-fluid">
                                @foreach ($all_data['departments'] as $department)
                                    <div class="d-flex justify-content-between">
                                        <h5 class="fw-bold text-white mb-0">{{ $department->name }}</h5>
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
                                            <div class="mt-3 ">
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
                                                            class="list-group-item d-flex justify-content-between my-2 px-0 bg-kyoodark text-white">
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
                                                <p class="text-secondary text-center mb-0">All accounts in this
                                                    department are idle</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-flex justify-content-center mt-3">
                                            <p class="text-secondary text-center mb-0">No accounts in this
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
                    <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
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
                                    <hr class="border border-1 border-pastel-green my-0">
                                </div>
                                <div class="chart-container mt-3">
                                    <div id="line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    {{-- Chart JS --}}
    <script src="{{ asset('assets/js/department-chart.js') }}"></script>

    {{-- Refresh Page JS --}}
    {{-- <script src="{{ asset('assets/js/refreshPage.js') }}"></script> --}}
</x-layout>
