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

            <div class="row ">
                <div class="col-lg-8">
                    <div class="row">
                        {{-- Pending --}}
                        <div class="col-xxl-4 col-md-6">
                            <div class="card bg-secondary text-white rounded-5 shadow-lg mb-4">
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
                            <div class="card bg-secondary text-white rounded-5 shadow-lg mb-4">
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
                            <div class="card bg-secondary text-white rounded-5 shadow-lg mb-4">
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
                        <div class="col-md-6">
                            <div class="card bg-secondary text-white rounded-5 shadow-lg mb-4">
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
                        <div class="col-md-6">
                            <div class="card bg-secondary text-white rounded-5 shadow-lg mb-4">
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
                    </div>
                </div>

                <div class="col-lg-4">
                    {{-- Active Staff --}}
                    <div class="card bg-pastel-mint text-kyoodark rounded-5 shadow-lg mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Active Staff</h5>
                                <div class="card-icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                            <hr class="border border-1 border-kyoodark my-0">
                            <div class="d-flex justify-content-between align-items-end mt-3">
                                <div class="h1 mb-0">{{ $activeStaff }} out of {{ $totalStaff }}</div>
                                <div class="text-end">
                                    <p class="card-text mb-0">staffs are currently serving</p>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- Staffs Working --}}
                    <div class="card bg-light text-dark rounded-5 shadow-lg">
                        <div class="card-body px-4">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Staffs Working</h5>
                                    <div class="card-icon d-flex justify-content-center align-items-center">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>

                                @foreach ($all_data['departments'] as $department)
                                    <div class="card mb-3 border py-3 shadow-sm" style="margin-bottom: 1.5rem;">
                                        <div
                                            class="card-body justify-content-center d-flex flex-column justify-content-center">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bold text-secondary mb-0">{{ $department->name }}</h5>
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
                                                                    class="list-group-item d-flex justify-content-between my-2 px-0">
                                                                    <div class="d-flex">
                                                                        <i
                                                                            class="fa-solid fa-user text-primary me-3"></i>
                                                                        <h6 class="mb-0">{{ $staff }}</h6>
                                                                    </div>
                                                                    <span
                                                                        class="badge rounded-pill {{ $staffAccount && $staffAccount->account_login && $staffAccount->account_login->status == 'On Break' ? 'bg-kyooyellow' : 'bg-kyoodarkblue' }}">
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
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>

                {{-- Queue Counts Report (Line Chart) --}}
                <div class="col-12">
                    <div class="card rounded-5 shadow-lg py-3">
                        <div class="container-fluid">
                            <div class="card-body">
                                <div class="col-12 mb-2">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-8">
                                            <h5 class="card-title fw-bold">Queue Counts Report</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <select name="year" id="year-dropdown" class="form-select rounded-5">
                                                @foreach ($years['years'] as $year)
                                                    <option value="{{ $year }}">{{ $year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="chart-container overflow-x-auto">
                                    <div id="line-chart" class="w-100 h-100">
                                        {{-- Insert Chart here --}}
                                    </div>
                                </div>

                                {{-- TODO: Should redirect to another page where all reports should be displayed para isahang Export nalang --}}
                                {{-- <a href="#">Export as PDF</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    {{-- Chart JS --}}
    <script src="{{ asset('assets/js/chart.js') }}"></script>
</x-layout>
