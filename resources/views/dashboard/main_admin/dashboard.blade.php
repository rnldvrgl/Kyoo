{{-- Page Title --}}
@section('mytitle', 'Main Admin Dashboard')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp

{{-- {{ dd($months) }} --}}

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


        <div class="d-flex justify-content-between align-items-center">
            {{-- Date --}}
            <h5 class="date mb-3"></h5>

            {{-- Export Button --}}
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exportModal">
                Export
                Report
                <i class="fa-solid fa-file-arrow-down ms-2"></i>
            </button>
        </div>


        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportModalLabel">Export Report</h5>

                        {{-- Give this a margin-left --}}
                        <span style="margin-left: 1rem;" title="Leave the filters blank to export dashboard data."><i
                                class="fa-solid fa-circle-question" style="color: #0080ff;"></i></span>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div id="res">
                            {{-- Insert Message here --}}
                        </div>

                        <form id="export-main-admin-report" action="{{ route('export-main-admin-ticket') }}"
                            method="POST" autocomplete="off">

                            @csrf

                            {{-- Tickets --}}
                            <div class="row">
                                <strong class="mb-1">Ticket Status</strong>
                                <div class="form-floating rounded-pill mb-3 px-1">
                                    <select class="form-select form-control" name="ticketStatus"
                                        id="floatingTicketStatus" aria-label="TicketStatus">
                                        <option value="" selected>All Tickets</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Serving">Serving</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <label class="form-label" for="floatingTicketStatus">Ticket Status</label>
                                </div>

                                {{-- <div class="col-6 form-floating mb-3 px-1">
                                    <input class="form-control" type="date" name="ticketStartDate"
                                        id="floatingTicketStartDate">
                                    <label for="floatingTicketStartDate">From</label>
                                </div>

                                <div class="col-6 form-floating mb-3 px-1">
                                    <input class="form-control" type="date" name="ticketEndDate"
                                        id="floatingTicketEndDate">
                                    <label for="floatingTicketEndDate">To</label>
                                </div> --}}
                            </div>

                            {{-- Staff --}}
                            <div class="row">
                                <strong class="mb-1">Staff Status</strong>
                                <div class="col-6 form-floating rounded-pill mb-3">
                                    <select class="form-select" name="staffStatus" id="floatingStaffStatus"
                                        aria-label="StaffStatus">
                                        <option value="" selected>All Staff Status</option>
                                        <option value="On Break">On Break</option>
                                        <option value="Logged In">Logged In</option>
                                        <option value="Logged Out">Logged Out</option>
                                    </select>
                                    <label for="floatingStaffStatus">Staff Status</label>
                                </div>

                                <div class="col-6 form-floating mb-3">
                                    <select class="form-select" name="department" id="floatingDepartment"
                                        aria-label="Department">
                                        <option value="" selected>All Department</option>
                                        @foreach ($allDepartments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingDepartment">Department</label>
                                </div>
                            </div>


                            {{-- Queue Counts --}}
                            {{-- <div class="row">
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
                            </div> --}}


                            {{-- Occupied Departments --}}
                            <strong>Occupied Departments</strong>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="occupiedDepartment" id="floatingOccupiedDepartment"
                                    aria-label="OccupiedDepartment">
                                    <option value="" selected>All Department</option>
                                    @foreach ($allDepartments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingOccupiedDepartment">Department</label>
                            </div>


                            {{-- Feedback --}}
                            <div class="row">
                                <strong>Feedback</strong>
                                <div class="col-4 form-floating mb-3">
                                    <input type="radio" name="anonymity" id="all" value="all" checked>
                                    All
                                </div>

                                <div class="col-4 form-floating mb-3">
                                    <input type="radio" name="anonymity" id="anonymous" value="anonymous">
                                    Anonymous
                                </div>

                                <div class="col-4 form-floating mb-3">
                                    <input type="radio" name="anonymity" id="named" value="named"> Named
                                </div>
                            </div>

                            {{-- General Date --}}
                            <div class="row">
                                <strong>Date</strong>
                                <div class="col-6 form-floating mb-3">
                                    <input class="form-control" type="date" name="startDate"
                                        id="floatingStartDate">
                                    <label for="floatingStartDate">From</label>
                                </div>

                                <div class="col-6 form-floating mb-3">
                                    <input class="form-control" type="date" name="endDate" id="floatingEndDate">
                                    <label for="floatingEndDate">To</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="reset" class="btn btn-kyoored">
                                    Clear Filter
                                    <i class="fa-regular fa-trash-can ms-2"></i>
                                </button>

                                <button class="btn btn-primary ms-2" type="submit" id="btn-submit-filter">
                                    Export
                                    <i class="fa-solid fa-file-arrow-down ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-xxl-8 col-lg-7 col-md-12">
                    <div class="row d-flex justify-content-center align-items-stretch">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">Pending <span
                                                    class="text-muted d-block d-xxl-inline-block">
                                                    | Today</span>
                                            </h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-stopwatch text-pastel-yellow"></i>
                                            </div>
                                        </div>
                                        <hr class="border-1 border-pastel-yellow my-0 border">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end align-items-center py-3">
                                        <div class="h1 mb-0">{{ $pending_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white"> Serving <span
                                                    class="text-muted d-block d-xxl-inline-block">
                                                    | Today</span></h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="far fa-clock text-pastel-blue"></i>
                                            </div>
                                        </div>

                                        <hr class="border-1 border-pastel-blue my-0 border">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end align-items-center py-3">
                                        <div class="h1 mb-0">{{ $serving_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">Served <span
                                                    class="text-muted d-block d-xxl-inline-block">
                                                    | Today</span></h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-clipboard-check text-pastel-mint"></i>
                                            </div>
                                        </div>
                                        <hr class="border-1 border-pastel-mint my-0 border">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end align-items-center py-3">
                                        <div class="h1 mb-0">{{ $served_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">On Break Staff</h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-coffee text-warning"></i>
                                            </div>
                                        </div>
                                        <hr class="border-1 border-warning my-0 border">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end align-items-center py-3">
                                        <div class="h1 mb-0">{{ $onBreakStaff }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">staff(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-4 mb-4">
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
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end align-items-center py-3">
                                        <div class="h1 mb-0">{{ $activeStaff }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">staff(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">Inactive Staff</h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-user-times text-danger"></i>
                                            </div>
                                        </div>
                                        <hr class="border-1 border-danger my-0 border">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end align-items-center py-3">
                                        <div class="h1 mb-0">{{ $inactiveStaff }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">staff(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div class="containter-fluid">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <h5 class="fw-bold mb-0 text-white">Queue Counts Chart</h5>
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
                                                            <option value="" class="bg-transparent text-white"
                                                                disabled>No
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

                        <div class="col-12 h-100 mb-4">
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div
                                    class="card-header border-bottom border-gold border-5 bg-transparent py-2 text-white">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0 text-white">Staff Leaderboard</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-ranking-star text-gold"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div
                                        class="card-body d-flex justify-content-center align-items-stretch gap-5 py-3">
                                        @php
                                            $topStaff = array_slice($topStaff, 0, 3);
                                            $starColors = [
                                                'gold' => '#ffd700',
                                                'silver' => '#808080',
                                                'bronze' => '#CD7F32',
                                            ];
                                        @endphp

                                        @for ($i = 0; $i < 3; $i++)
                                            @php
                                                $staff = $topStaff[$i] ?? null;
                                            @endphp
                                            <div
                                                class="col-{{ count($topStaff) == 3 ? ($i == 0 ? '4' : '3') : '3' }}">
                                                <div class="card text-kyoodark rounded-5 h-100 mb-0 bg-white py-3 text-center"
                                                    style="box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);">
                                                    @if ($staff)
                                                        <img src="{{ asset('storage/profile_images/' . ($staff['profile_image'] ?? 'avatar.png')) }}"
                                                            class="img-responsive rounded-circle"
                                                            alt="{{ $staff['name'] }}"
                                                            style="width: {{ count($topStaff) == 3 ? ($i == 0 ? '150px' : '130px') : '130px' }}; height: {{ count($topStaff) == 3 ? ($i == 0 ? '150px' : '130px') : '130px' }}; margin: 0 auto; box-shadow: 0 0 10px rgba(0,0,0,.2);">
                                                        <div
                                                            class="card-body d-flex flex-column justify-content-center align-items-center px-2 pb-0">
                                                            <div class="my-2">
                                                                <i class="fa-solid fa-star {{ array_keys($starColors)[$i] }} fa-xl"
                                                                    style="color: {{ $starColors[array_keys($starColors)[$i]] }};"></i>
                                                            </div>
                                                            <h6
                                                                class="card-title text-kyoodark {{ count($topStaff) == 3 ? ($i == 0 ? 'fs-4 fw-bold' : 'fs-6') : 'fs-6' }} my-1 py-0">
                                                                {{ $staff['name'] }}</h6>
                                                            <p class="card-text mb-0">{{ $staff['department'] }}</p>
                                                            <p class="card-text">{{ $staff['served_count'] }}
                                                                ticket(s)</p>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="card-body d-flex flex-column justify-content-center align-items-center px-2 pb-0">
                                                            <div class="my-2">
                                                                <i class="fa-solid fa-star {{ array_keys($starColors)[$i] }} fa-xl"
                                                                    style="color: {{ $starColors[array_keys($starColors)[$i]] }};"></i>
                                                            </div>
                                                            <h6
                                                                class="card-title text-kyoodark {{ count($topStaff) == 3 ? ($i == 0 ? 'fs-4 fw-bold' : 'fs-6') : 'fs-6' }} my-1 py-0">
                                                                Not Available</h6>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5 col-md-12 rounded-5 px-2">
                    <div class="d-flex flex-column justify-content-stretch align-items-center">
                        <div class="col-12 mb-4">
                            {{-- Occupied Departments --}}
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg"
                                style="max-height:97vh; overflow-y:auto;">
                                <div
                                    class="card-header border-bottom border-warning border-5 bg-transparent py-2 text-white">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0">Occupied Departments</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-building text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-4 pt-3" style="max-height:97vh; overflow-y:auto;">
                                    <div class="container-fluid">
                                        @foreach ($all_data['departments'] as $department)
                                            <div class="card mb-3 border py-3 shadow-sm"
                                                style="margin-bottom: 1.5rem;">
                                                <div
                                                    class="card-body justify-content-center d-flex flex-column justify-content-center">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="fw-bold text-kyoodark mb-0">
                                                            {{ $department->name }}
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
                                                                                <h6 class="mb-0">
                                                                                    {{ $staff }}
                                                                                </h6>
                                                                            </div>
                                                                            <span
                                                                                class="badge rounded-pill d-flex justify-content-center align-items-center {{ $staffAccount && $staffAccount->account_login && $staffAccount->account_login->status == 'On Break' ? 'bg-kyooyellow' : 'bg-kyoodarkblue' }}">
                                                                                @if ($staffAccount && $staffAccount->account_login)
                                                                                    {{ $staffAccount->account_login->updated_at->diffForHumans() }}
                                                                                    @if ($staffAccount->account_login->status == 'On Break')
                                                                                        (On Break)
                                                                                    @endif
                                                                                @else
                                                                                    <i class="fa-solid fa-clock"></i>
                                                                                    Not
                                                                                    logged in
                                                                                @endif
                                                                            </span>

                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @else
                                                            <div class="d-flex justify-content-center mt-3">
                                                                <p class="text-secondary mb-0 text-center">All
                                                                    accounts
                                                                    in
                                                                    this
                                                                    department are idle</p>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <p class="text-danger mb-0 text-center">No accounts in
                                                                this
                                                                department</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach


                                        <p class="text-secondary mt-3">
                                            Total occupied departments:
                                            <span class="text-primary fw-semibold">{{ $occupiedDepartment }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 h-100">
                            {{-- Feedback --}}
                            <div class="card bg-kyoodark rounded-5 text-white shadow-lg">
                                <div
                                    class="card-header border-bottom border-pastel-teal border-5 bg-transparent py-2 text-white">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0">Feedbacks</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-comment-dots text-pastel-teal"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body px-4 pt-3">
                                    <div class="container-fluid">
                                        @if (count($feedbacks) > 0)
                                            @foreach ($feedbacks as $feedback)
                                                <div class="card mb-2 py-2 shadow-sm">
                                                    <div
                                                        class="card-body justify-content-center d-flex flex-column justify-content-center pb-0">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="fw-semibold text-kyoodark mb-0">
                                                                @if ($feedback->name)
                                                                    {{ $feedback->name }}
                                                                @else
                                                                    Anonymous
                                                                @endif
                                                            </p>
                                                            <small
                                                                class="text-muted">{{ $feedback->created_at->format('m-d-Y') }}
                                                            </small>
                                                        </div>
                                                        <p class="card-text text-kyoodark">
                                                            {{ $feedback->feedback }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="d-flex justify-content-center my-3">
                                                <p class="text-secondary mb-0 text-center">No feedback yet.</p>
                                            </div>
                                        @endif
                                    </div>
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
    <script src="{{ asset('assets/js/Chart.js') }}"></script>

    {{-- Refresh Page JS --}}
    {{-- <script src="{{ asset('assets/js/refreshPage.js') }}"></script> --}}
</x-layout>
