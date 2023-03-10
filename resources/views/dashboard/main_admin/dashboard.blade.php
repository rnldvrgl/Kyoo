{{-- Page Title --}}
@section('mytitle', 'Main Admin Dashboard')

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
                            <div class="card info-card warning-card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Pending <span>| Today</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-stopwatch"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $pending_tickets }} ticket/s</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card primary-card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Current Serving <span>| Today</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-comment-dots"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $serving_tickets }} ticket/s</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card success-card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        Total Served <span>| Today</span>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user-group"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $served_tickets }} ticket/s</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        <div id="queue-chart">
                                            {{-- Insert Chart here --}}
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card overflow-auto">
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
                            <div class="card overflow-auto">
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
                    <div class="card info-card secondary-card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                Active Staff
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="ps-3 vstack justify-content-center">
                                    <h6>4 out of 4</h6>
                                    <p>staff are currently serving</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
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

                            <div class="card mb-3">
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

                    <div class="card">
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


                    <div class="card">
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
