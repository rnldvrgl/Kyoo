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
    <x-dashboard-sidebar name="{{ $role->name }}" />

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
                            <div class="card warning-card shadow">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Pending <span>| Today</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-stopwatch"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ps-3">
                                            <h6 class="emphasize">{{ $pending_tickets }}</h6>
                                            <span>ticket(s)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card primary-card shadow">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Current Serving <span>| Today</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-comment-dots"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ps-3">
                                            <h6 class="emphasize">{{ $serving_tickets }}</h6>
                                            <span>ticket(s)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card success-card shadow">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Total Served <span>| Today</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user-group"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center ps-3">
                                            <h6 class="emphasize">{{ $served_tickets }}</h6>
                                            <span>ticket(s)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-lg-8">
                                                <h5 class="card-title fw-bold">Queue Counts Report
                                                </h5>
                                            </div>
                                            <div class="col-lg-4">
                                                <select name="year" id="year-dropdown" class="form-select">
                                                    @foreach ($years['years'] as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card overflow-auto shadow">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Sample
                                    </h5>
                                    <table class="table-borderless datatable table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">
                                                    1
                                                </th>
                                                <th scope="col">Col</th>
                                                <th scope="col">Col</th>
                                                <th scope="col">Col</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    0
                                                </th>
                                                <td>
                                                    1

                                                </td>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    3

                                                </td>
                                                <td>
                                                    4
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card overflow-auto shadow">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">
                                        Sample
                                    </h5>
                                    <table class="table-borderless table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Col</th>
                                                <th scope="col">Col</th>
                                                <th scope="col">Col</th>
                                                <th scope="col">Col</th>
                                                <th scope="col">Col</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    0
                                                </th>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    4
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card secondary-card shadow">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                Active Staff
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="d-flex flex-column justify-content-center ps-3">
                                    <h6 class="emphasize">4 out of 4</h6>
                                    <span>staff are currently serving</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="label-1 fw-bold">
                                    Occupied Department
                                </h6>
                                <p>
                                    4 Occupied
                                </p>
                            </div>
                            <div class="card mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="ms-2 px-4 py-3">
                                        <h5 class="text-secondary lh-base mb-2">
                                            Registrar
                                        </h5>
                                        <div class="d-flex flex-column align-items-left">
                                            <p class="text-secondary lh-base mb-0">
                                                <b>Ronald Vergel Dela Cruz</b> is idle
                                            </p>
                                            <p class="text-secondary lh-1">
                                                2 hours 53 minues ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="ms-2 px-4 py-3">
                                        <h5 class="text-secondary lh-base mb-2">
                                            Cashier
                                        </h5>
                                        <div class="d-flex flex-column align-items-left">
                                            <p class="text-secondary lh-base mb-0">
                                                <b>Mark Lewence Endrano</b> is idle
                                            </p>
                                            <p class="text-secondary lh-1">
                                                2 hours 53 minues ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body pb-0">
                            <h5 class="card-title fw-bold">
                                Departments
                            </h5>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <h5 class="card-title fw-norml">
                                            Registrar
                                        </h5>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="row">
                                            <div class="vstack text-center">
                                                <p>Ongoing</p>
                                                <h6 class="fw-bold">1</h6>
                                            </div>
                                            <div class="vstack text-center">
                                                <p>Serving</p>
                                                <h6 class="fw-bold">1</h6>
                                            </div>
                                            <div class="vstack text-center">
                                                <p>Served</p>
                                                <h6 class="fw-bold">1</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow">
                        <div class="card-body pb-0">
                            <h5 class="card-title">
                                Sample
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- /Main Content -->
</x-layout>
