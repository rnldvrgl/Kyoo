{{-- Page Title --}}
@section('mytitle', 'User Profile')

<x-layout>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :$details :$role />

    @if ($role->name === 'Main Admin')
        {{-- Dashboard Sidebar --}}
        <x-dashboard-sidebar name="{{ $role->name }}" />
    @endif

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
                            <img src="/assets/images/profile-img.jpg" alt="Profile" class="rounded-circle" />
                            {{ $details->name }}
                            {{ $role->name }}
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    {{-- Input Error Messages --}}
                    @foreach (['name', 'about', 'address', 'phone', 'password', 'newpassword'] as $field)
                        @error($field)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    @endforeach

                    {{-- Update Messages --}}
                    @if (session('updateSuccess'))
                        <div class="alert alert-success">
                            {{ session('updateSuccess') }}
                        </div>
                    @elseif (session('updateFailed'))
                        <div class="alert alert-danger">
                            {{ session('updateFailed') }}
                        </div>
                    @endif

                    @if (session('passwordSuccess'))
                        <div class="alert alert-success">
                            {{ session('passwordSuccess') }}
                        </div>
                    @elseif (session('passwordFailed'))
                        <div class="alert alert-danger">
                            {{ session('passwordFailed') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body pt-3">
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
                                    <form class="needs-validation"
                                        action="{{ route('user_profile.update', ['id' => session('account_id')]) }}"
                                        method="POST" novalidate>

                                        @csrf
                                        @method('PATCH')

                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="/assets/images/profile-img.jpg" alt="Profile" />
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i
                                                            class="fa-solid fa-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        title="Remove my profile image"><i
                                                            class="fa-solid fa-trash-can"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                    pattern="^[A-Za-z ]+$" value="{{ $details->name }}" required />
                                                <div class="invalid-feedback">
                                                    Required (Must only contain letters)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 75px" required>{{ $details->about }}</textarea>
                                                <div class="invalid-feedback">
                                                    Required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="department"
                                                class="col-md-4 col-lg-3 col-form-label">Department</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="department" type="text" class="form-control"
                                                    id="department" value="{{ $department->name }}" disabled />
                                            </div>
                                        </div>
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
                                                <div class="invalid-feedback">
                                                    Required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Phone"
                                                class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control"
                                                    id="Phone" value="{{ $details->phone }}"
                                                    pattern="^(09|\+639)\d{9}$" required />
                                                <div class="invalid-feedback">
                                                    Required (Must be valid phone number)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Email"
                                                class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control"
                                                    id="Email" value="{{ $login->email }}" disabled />
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Change Password -->
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form
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
                                            <button type="submit" name="change-password" class="btn btn-success">
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
