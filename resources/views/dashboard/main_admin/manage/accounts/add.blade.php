{{-- Page Title --}}
@section('mytitle', 'Add Account')

<x-layout>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :$details :$role />

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
                    <li class="breadcrumb-item active">Add Account</li>
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
                            <h5 class="card-title">Add Account</h5>
                            <form class="row g-3">
                                {{-- Full Name --}}
                                <div class="col-md-12">
                                    <div class="form-floating"> <input type="text" class="form-control"
                                            id="floatingName" placeholder="Full Name"> <label for="floatingName">Full
                                            Name</label></div>
                                </div>

                                {{-- Email Address --}}
                                <div class="col-md-12">
                                    <div class="form-floating"> <input type="email" class="form-control"
                                            id="floatingEmail" placeholder="Email Address"> <label for="floatingEmail">
                                            Email Address</label></div>
                                </div>

                                {{-- Department --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingDepartment" aria-label="Department">
                                            <option selected disabled>Select Department</option>
                                            <option value="Registrar">Registrar</option>
                                            <option value="Cashier">Cashier</option>
                                            <option value="Library">Library</option>
                                        </select>
                                        <label for="floatingDepartment">Department</label>
                                    </div>
                                </div>

                                {{-- Account Role --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingRole" aria-label="State">
                                            <option selected disabled>Select Account Role</option>
                                            <option value="1">Main Admin</option>
                                            <option value="2">Department Admin</option>
                                            <option value="3">Staff</option>
                                        </select>
                                        <label for="floatingRole">Role</label>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-user-plus"></i>
                                        Add Account
                                    </button>
                                    <button type="reset" class="btn btn-kyoored">
                                        <i class="fa-regular fa-trash-can"></i>
                                        Clear Input Fields
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->
    </main>
    <!-- /Main Content -->
</x-layout>
