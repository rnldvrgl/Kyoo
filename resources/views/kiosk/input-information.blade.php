{{-- Page Title --}}
@section('mytitle', 'Input Information')

<x-layout>
    {{-- Background Image --}}
    <div id="background-image" style="opacity: 5%;"></div>

    {{-- Cancel Queue Button --}}
    <x-cancel-queue-button />

    {{-- Progress Bar --}}
    <div class="container px-3 pt-5">
        <div class="row mb-3">
            <x-progress-bar :progress="100" />
        </div>
    </div>


    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column px-5 py-4 gap-5">
        {{-- Input Information Heading --}}
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1>Enter your Information:</h1>
                <p>Input the required information</p>
            </div>
        </div>
        <div class="row justify-content-center align-items-center row-cols-1">
            <div class="col-5">
                <div class="card h-100 w-100">
                    <div class="card-body p-5 d-flex">
                        <form id="input-information-frm" class="col-12" action="{{ route('print-queue-ticket') }}"
                            method="POST" autocomplete="off">
                            <div class="alert alert-danger" role="alert" id="error-message"></div>
                            @csrf
                            <fieldset>
                                <div class="form-floating mb-3">
                                    <input type="text" name="fullname" class="form-control" id="floatingName"
                                        placeholder="Full Name" required>
                                    <label for="floatingName">
                                        Full Name
                                    </label>
                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" name="department" id="floatingDepartment"
                                        aria-label="Department" required>
                                        <option value="" selected disabled>Select Department</option>
                                        <option value="Graduate School">Graduate School</option>
                                        <option value="College">College</option>
                                        <option value="Senior High School">Senior High School</option>
                                        <option value="Junior High School">Junior High School</option>
                                    </select>
                                    <label for="floatingDepartment">Department</label>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-5">
                                    <select class="form-select" name="course" id="floatingCourse" aria-label="Course"
                                        required>
                                        <option value="" selected disabled>Select Course</option>
                                    </select>
                                    <label for="floatingCourse">Course</label>
                                    @error('course')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg" id="queue_now">
                                        Queue Now
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sliding Popup --}}
    <div id="sliding-popup"
        class="d-flex justify-content-between align-items-center popup-content info position-fixed bottom-0 w-100 show">
        <div id="popup-text">
            <h2>test</h2>
            <p>
                text
            </p>
        </div>
        <div id="popup-buttons">
            <button type="button" id="agree-button"
                class="agree-button eu-cookie-compliance-default-button btn btn-secondary">
                OK, I agree
            </button>
        </div>
    </div>


</x-layout>
