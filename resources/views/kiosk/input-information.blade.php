{{-- Page Title --}}
@section('mytitle', 'Input Information')


<x-layout>
    {{-- Background Image --}}
    <div id="background-image" style="opacity: 5%;"></div>
    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column p-3 gap-3">
        {{-- Cancel Queue Button --}}
        <div class="row mb-3">
            <div class="col-6">
                <x-cancel-queue-button />
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="row mb-3">
            <x-progress-bar :progress="100" />
        </div>

        {{-- Input Information Heading --}}
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1>Enter your Information : </h1>
                <p>Input informations needed</p>
            </div>
        </div>
        <div class="row justify-content-center align-items-center row-cols-1">
            <div class="col-5">
                <div class="card h-100 w-100">
                    <div class="card-body p-5 d-flex">
                        <form id="input-information-frm" class="col-12" action="{{ route('print-queue-ticket') }}"
                            method="POST">
                            @csrf
                            <div class="alert alert-danger" role="alert" id="error-message"></div>
                            {{-- Full Name --}}
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="fullname" class="form-control" id="floatingName"
                                            placeholder="Full Name">
                                        <label for="floatingName">
                                            Full Name
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Department and Courses or Strands --}}
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" name="department" id="floatingDepartment"
                                            aria-label="Department">
                                            <option value="" selected disabled>Select Department
                                            </option>
                                            <option value="Graduate School">Graduate School</option>
                                            <option value="College">College</option>
                                            <option value="Senior High School">Senior High School</option>
                                            <option value="Junior High School">Junior High School</option>
                                        </select>
                                        <label for="floatingDepartment">Department</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" name="course" id="floatingCourse"
                                            aria-label="Course">
                                            <option value="" selected disabled>Select Course</option>
                                        </select>
                                        <label for="floatingCourse">Course</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Queue Button --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg" id="queue_now">
                                    Queue Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
