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
                <div class="col-xxl-9 col-lg-8">
                    <div class="row d-flex justify-content-stretch">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg ">
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
                                        <hr class="border border-1 border-pastel-yellow my-0">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end my-auto">
                                        <div class="h1 mb-0">{{ $pending_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
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

                                        <hr class="border border-1 border-pastel-blue my-0">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end my-auto">
                                        <div class="h1 mb-0">{{ $serving_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white ">Served <span
                                                    class="text-muted d-block d-xxl-inline-block">
                                                    | Today</span></h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-clipboard-check text-pastel-mint"></i>
                                            </div>
                                        </div>
                                        <hr class="border border-1 border-pastel-mint my-0">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end my-auto">
                                        <div class="h1 mb-0">{{ $served_tickets }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">ticket(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
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
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end  align-items-center my-auto">
                                        <div class="h1 mb-0">{{ $activeStaff }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">staff(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="div">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0 text-white">Inactive Staff</h5>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-user-times text-danger"></i>
                                            </div>
                                        </div>
                                        <hr class="border border-1 border-danger my-0">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-xxl-end  align-items-center my-auto">
                                        <div class="h1 mb-0">{{ $inactiveStaff }}</div>
                                        <div class="text-end">
                                            <p class="card-text mb-0">staff(s)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
                                <div class="containter-fluid">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <h5 class="card-title mb-0 text-white">Queue Counts Report</h5>
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
                                            <hr class="border border-1 border-pastel-green my-0">
                                        </div>
                                        <div class="chart-container mt-3">
                                            <div id="line-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4 h-100">
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
                                <div
                                    class="card-header bg-transparent text-white border-bottom border-gold border-5 py-2">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="card-title mb-0 text-white">Staff Leaderboard</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-ranking-star text-gold"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-3">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-around  align-items-stretch py-3">
                                            @php
                                                $topStaff = array_slice($topStaff, 0, 3);
                                                $starColors = [
                                                    'gold' => '#ffd700',
                                                    'silver' => '#808080',
                                                    'bronze' => '#CD7F32',
                                                ];
                                            @endphp

                                            @foreach ($topStaff as $index => $staff)
                                                <div
                                                    class="col-{{ count($topStaff) == 3 ? ($index == 0 ? '4' : '3') : '3' }}">
                                                    <div class="card bg-white text-kyoodark text-center rounded-5 py-3 mb-0 {{ count($topStaff) == 3 ? ($index == 0 ? 'h-100' : 'h-75') : 'h-75' }}"
                                                        style="box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);">
                                                        <img src="{{ asset('storage/profile_images/' . ($staff['profile_image'] ?? 'avatar.png')) }}"
                                                            class="img-responsive rounded-circle"
                                                            alt="{{ $staff['name'] }}"
                                                            style="width: 50%; height: 50%; margin: 0 auto; box-shadow: 0 0 10px rgba(0,0,0,.2);">
                                                        <div
                                                            class="card-body pb-0 px-2 d-flex flex-column justify-content-center align-items-center">
                                                            <div class="my-2">
                                                                <i class="fa-solid fa-star {{ array_keys($starColors)[$index] }} fa-xl"
                                                                    style="color: {{ $starColors[array_keys($starColors)[$index]] }};"></i>
                                                            </div>
                                                            <h6
                                                                class="card-title text-kyoodark my-1 py-0  {{ count($topStaff) == 3 ? ($index == 0 ? 'fs-4 fw-bold' : 'fs-6') : 'fs-6' }}">
                                                                {{ $staff['name'] }}</h6>
                                                            <p class="card-text mb-0">{{ $staff['department'] }}
                                                            </p>
                                                            <p class="card-text">{{ $staff['served_count'] }}
                                                                ticket(s)
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 rounded-5 bg-white p-3 border"
                    style="overflow-y: auto; max-height: 168vh;">
                    <div class="d-flex flex-column justify-content-stretch align-items-center">
                        <div class="col-12">
                            {{-- Occupied Departments --}}
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg">
                                <div
                                    class="card-header bg-transparent text-white border-bottom border-warning border-5 py-2">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0">Occupied Departments</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fas fa-building text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-4 pt-3">
                                    <div class="container-fluid">
                                        @foreach ($all_data['departments'] as $department)
                                            <div class="card mb-3 border py-3 shadow-sm"
                                                style="margin-bottom: 1.5rem;">
                                                <div
                                                    class="card-body justify-content-center d-flex flex-column justify-content-center ">
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
                                                                                class="badge rounded-pill {{ $staffAccount && $staffAccount->account_login && $staffAccount->account_login->status == 'On Break' ? 'bg-kyooyellow' : 'bg-kyoodarkblue' }}">
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
                                                                <p class="text-secondary text-center mb-0">All
                                                                    accounts
                                                                    in
                                                                    this
                                                                    department are idle</p>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <p class="text-danger text-center mb-0">No accounts in
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
                            {{-- Occupied Departments --}}
                            <div class="card bg-kyoodark text-white rounded-5 shadow-lg"
                                style="max-height: 100vh; overflow-y: auto;">
                                <div
                                    class="card-header bg-transparent text-white border-bottom border-pastel-teal border-5 py-2">
                                    <div class="container-fluid">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold mb-0">Feedbacks</h4>
                                            <div class="card-icon d-flex justify-content-center align-items-center">
                                                <i class="fa-solid fa-comment-dots text-pastel-teal"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-4 pt-3" style="max-height: 100vh; overflow-y: auto;">
                                    <div class="container-fluid">
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
                                                        <p class="card-text text-kyoodark">{{ $feedback->feedback }}
                                                        </p>
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
            </div>
        </section>
    </main>
    <!-- /Main Content -->

    {{-- Chart JS --}}
    <script src="{{ asset('assets/js/Chart.js') }}"></script>

    {{-- Refresh Page JS --}}
    {{-- <script src="{{ asset('assets/js/refreshPage.js') }}"></script> --}}
</x-layout>
