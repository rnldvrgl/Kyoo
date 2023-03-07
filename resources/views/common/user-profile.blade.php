{{-- Page Title --}}
@section('mytitle', 'User Profile')

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

    @if ($role->name === 'Main Admin')
        {{-- Dashboard Sidebar --}}
        <x-dashboard-sidebar name="{{ $role->name }}" />
    @endif


    {{-- Dashboard Sidebar --}}


    {{-- Main Content --}}
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </nav>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img id="image_avatar"
                                src="@if ($profile_image == null || $profile_image == '') {{ asset('storage/profile_images/avatar.png') }}  @else {{ asset("storage/$profile_image") }} @endif"
                                alt="Profile" class="rounded-circle" />
                            <h2>{{ $details->name }}</h2>
                            <h3>{{ $role->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">

                            <div id="res">
                                {{-- Append Success/Error Messages here --}}
                            </div>

                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">
                                        Overview
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                        Edit Profile
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">
                                        Change Password
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <!-- Overview -->
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">
                                        {{ $details->about }}
                                    </p>
                                    <h5 class="card-title">
                                        Profile Details
                                    </h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Full Name
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $details->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Department
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $department->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Position
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $role->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Address
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $details->address }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Phone
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $details->phone }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Email
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $login->email }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Profile -->
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <!-- Form -->
                                    <form id="profile_setup_frm" class="needs-validation"
                                        action="{{ route('user_profile.update', ['id' => session('account_id')]) }}"
                                        method="POST" novalidate>

                                        @csrf
                                        @method('PATCH')

                                        <div class="row mb-3">
                                            <label for="image_preview_container"
                                                class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#verticalycentered">
                                                    <img src="@if ($profile_image == null || $profile_image == '') {{ asset('storage/profile_images/avatar.png') }}  @else {{ asset("storage/$profile_image") }} @endif"
                                                        alt="Profile Picture" class="img-thumbnail"
                                                        id="image_preview_container" style="max-height: 120px;">
                                                </button>
                                                <div class="modal fade" id="verticalycentered" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <img id="preview_image"
                                                                    src="@if ($profile_image == null || $profile_image == '') {{ asset('storage/profile_images/avatar.png') }}  @else {{ asset("storage/$profile_image") }} @endif"
                                                                    alt="Profile Picture"
                                                                    style="height: 100%; width: 100%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-8 offset-md-4 col-lg-9 offset-lg-3">
                                                <input class="form-control mt-3" type="file" name="profile_image"
                                                    id="profile_image">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                    value="{{ $details->name }}" pattern="^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$" required />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about"
                                                class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 75px" required>{{ $details->about }}</textarea>
                                            </div>
                                        </div>

                                        @if ($role->name != 'Main Admin')
                                            <div class="row mb-3">
                                                <label for="department"
                                                    class="col-md-4 col-lg-3 col-form-label">Department</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="department" type="text" class="form-control"
                                                        id="department" value="{{ $department->name }}"
                                                        {{ $role->name == 'Main Admin' ? '' : 'disabled' }} />
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-3">
                                            <label for="position"
                                                class="col-md-4 col-lg-3 col-form-label">Position</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="position" type="text" class="form-control"
                                                    id="position" value="{{ $role->name }}" disabled />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address"
                                                class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control"
                                                    id="Address" value="{{ $details->address }}" required />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Phone"
                                                class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control"
                                                    id="Phone" value="{{ $details->phone }}"
                                                    pattern="^(09|\+639)\d{9}$" required />
                                            </div>
                                        </div>
                                        @if ($role->name == 'Main Admin')
                                            <div class="row mb-3">
                                                <label for="Email"
                                                    class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="email" class="form-control"
                                                        id="Email" value="{{ $login->email }}"
                                                        pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-]+)(\.[a-zA-Z]{2,5}){1,2}$"
                                                        required />
                                                </div>
                                            </div>
                                        @else
                                            <div class="row mb-3">
                                                <label for="Email"
                                                    class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="email" class="form-control"
                                                        id="Email" value="{{ $login->email }}" disabled />
                                                </div>
                                            </div>
                                        @endif



                                        <div class="text-center">
                                            <button id="btn-save" type="submit" class="btn btn-success">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Change Password -->
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form id="password_setup_frm"
                                        action="{{ route('user_profile.change_password', ['id' => Auth::user()->id]) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        {{-- Password --}}
                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword" />
                                            </div>
                                        </div>

                                        {{-- New Password --}}
                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword" />
                                            </div>
                                        </div>

                                        {{-- Confirm New Password --}}
                                        <div class="row mb-3">
                                            <label for="password_confirmation"
                                                class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword_confirmation" type="password"
                                                    class="form-control" id="password_confirmation" />
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button id="btn-change-pass" type="submit" name="change-password"
                                                class="btn btn-success">
                                                Change Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- /Main Content --}}
</x-layout>
