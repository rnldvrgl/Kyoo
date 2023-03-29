{{-- Page Title --}}
@section('mytitle', 'Input Information')

<x-layout>

    {{-- Cancel Queue Button --}}
    <x-cancel-queue-button />

    {{-- Progress Bar --}}
    <div class="container px-3 pt-5">
        <div class="row mb-3">
            <x-progress-bar :progress="100" />
        </div>
    </div>


    {{-- Main Content --}}
    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column gap-5">
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
                    <div class="card-body p-4 d-flex">
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

                                <div class="form-floating mb-3 rounded-pill ">
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
                                    <p id="consent-instruction" class="text-muted mb-3">
                                        "Before proceeding,
                                        please read and agree to our data privacy policy below."</p>
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill mb-3"
                                        id="queue_now" disabled>
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
    <div id="sliding-popup" class="position-fixed py-4 px-5" data-aos="fade-up">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="d-flex flex-column justify-content-center">
                    <h5 class="fw-bold">Compliance with Data Privacy Laws and Regulations</h5>
                    <p class="mb-0 fw-light">
                        We collect and process your personal information (Name, Department, and Course) for our queueing
                        management system in accordance with relevant data privacy laws and regulations. You may file a
                        complaint if your data privacy rights have been violated. By providing your personal
                        information, you consent to its collection, storage, and processing.
                    </p>
                </div>
            </div>
            <div class="col-lg-2 text-end">
                <button type="button" id="agree-button" class="btn btn-lg btn-success text-white rounded-pill">
                    OK, I agree
                    <i class="fa-solid fa-circle-check fa-beat ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</x-layout>
