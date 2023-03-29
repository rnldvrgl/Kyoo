{{-- Page Title --}}
@section('mytitle', 'Main Admin Dashboard')

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

            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
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

                        {{-- Queue Counts Report (Line Chart) --}}
                        <div class="col-12">
                            <div class="card rounded-5 shadow-lg py-3">
                                <div class="container-fluid">
                                    <div class="card-body mb-0">
                                        <div class="col-12 mb-2">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-lg-8">
                                                    <h5 class="card-title fw-bold">Queue Counts Report</h5>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select name="year" id="year-dropdown"
                                                        class="form-select rounded-5">
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


                        {{-- Staffs Completed Tickets (Sort by Most Completed Tickets) --}}
                        <div class="col-md-7">
                            <div class="card text-dark rounded-5 shadow-lg pb-3"
                                style="max-height: 40vh; overflow-y: auto;">
                                <div
                                    class="card-header bg-transparent text-kyoodark border-bottom border-kyooblue border-5 py-0">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0">Staff Leaderboard</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-0" style="max-height: 40vh; overflow-y: auto;">
                                    <div class="d-flex flex-column justify-content-center mt-3">
                                        @if ($completedTicketsByStaffs > 0)
                                            <table class="table table-responsive text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Rank</th>
                                                        <th>Staff Name</th>
                                                        <th>Department</th>
                                                        <th>Completed Tickets</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($completedTicketsByStaffs as $key => $completedTicketsByStaff)
                                                        @if (
                                                            $completedTicketsByStaff['department'] != 'College Library' &&
                                                                $completedTicketsByStaff['department'] != 'High School Library')
                                                            <tr>
                                                                <td>
                                                                    @if ($key == 0)
                                                                        <i class="fa-solid fa-star gold"
                                                                            style="color: #ffd700;"></i>
                                                                    @elseif($key == 1)
                                                                        <i class="fa-solid fa-star silver"
                                                                            style="color: #808080;"></i>
                                                                    @elseif($key == 2)
                                                                        <i class="fa-solid fa-star bronze"
                                                                            style="color: #CD7F32;"></i>
                                                                    @else
                                                                        {{ $key + 1 }}.
                                                                    @endif
                                                                </td>
                                                                <td>{{ $completedTicketsByStaff['name'] }}</td>
                                                                <td>{{ $completedTicketsByStaff['department'] }}</td>
                                                                <td>{{ $completedTicketsByStaff['served_count'] }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="no-data-message">
                                                <p class="text-secondary">No recorded data yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Feedbacks --}}
                        <div class="col-md-5">
                            <div class="card text-dark rounded-5 shadow-lg pb-3"
                                style="max-height: 40vh; overflow-y: auto;">
                                <div
                                    class="card-header bg-transparent text-kyoodark border-bottom border-kyooblue border-5 py-0">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0">Feedbacks</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-comment-dots"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-0" style="max-height: 40vh; overflow-y: auto;">
                                    <div class="d-flex flex-column justify-content-center mt-3">
                                        @if (count($feedbacks) > 0)
                                            @foreach ($feedbacks as $feedback)
                                                <div class="card py-2 shadow-sm mb-2">
                                                    <div
                                                        class="card-body justify-content-center d-flex flex-column justify-content-center pb-0">
                                                        <p class="fw-semibold text-kyoodark mb-0">
                                                            @if ($feedback->name)
                                                                {{ $feedback->name }}
                                                            @else
                                                                Anonymous
                                                            @endif
                                                        </p>
                                                        <p class="card-text">{{ $feedback->feedback }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="d-flex justify-content-center my-3">
                                                <p class="text-secondary text-center mb-0">No feedback yet.</p>
                                            </div>
                                        @endif
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

                    {{-- Occupied Departments --}}
                    <div class="card text-dark rounded-5 shadow-lg" style="max-height: 80vh; overflow-y: auto;">
                        <div
                            class="card-header bg-transparent text-kyoodark border-bottom border-warning border-5 py-0">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="fw-bold mb-0">Occupied Departments</h4>
                                    <div class="card-icon d-flex justify-content-center align-items-center">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-3" style="max-height: 80vh; overflow-y: auto;">
                            <div class="container-fluid">
                                @foreach ($all_data['departments'] as $department)
                                    <div class="card mb-3 border py-3 shadow-sm" style="margin-bottom: 1.5rem;">
                                        <div
                                            class="card-body justify-content-center d-flex flex-column justify-content-center ">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bold text-kyoodark mb-0">{{ $department->name }}
                                                </h5>
                                                <span
                                                    class="badge bg-primary">{{ $department->accounts->where('account_login.status', 'Logged In')->count() }}</span>
                                            </div>
                                            @if ($department->accounts->count() > 0)
                                                @php
                                                    $occupiedStaff = [];
                                                @endphp
                                                @foreach ($department->accounts as $account)
                                                    @if ($account->account_login->status == 'Logged In' || $account->account_login->status == 'On Break')
                                                        @php
                                                            $occupiedStaff[] = $account->account_details->name;
                                                        @endphp
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
                                                                        <h6 class="mb-0">{{ $staff }}
                                                                        </h6>
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
                                                        <p class="text-secondary text-center mb-0">All accounts in
                                                            this
                                                            department are idle</p>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="d-flex justify-content-center mt-3">
                                                    <p class="text-danger text-center mb-0">No accounts in this
                                                        department</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach


                                <p class="text-secondary mt-3">Total occupied departments: <span
                                        class="text-primary fw-semibold">{{ $occupiedDepartment }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    {{-- Chart JS --}}
    <script src="{{ asset('assets/js/Chart.js') }}"></script>

    {{-- Refresh Page JS --}}
    <script src="{{ asset('assets/js/refreshPage.js') }}"></script>
</x-layout>
