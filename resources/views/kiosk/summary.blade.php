{{-- Page Title --}}
@section('mytitle', 'Transaction Summary')
<x-layout>
    {{-- Background Image --}}
    <div id="background-image" style="opacity: 5%;"></div>
    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column p-3 ">
        {{-- Cancel Queue Button --}}
        <div class="row mb-3">
            <div class="col-6">
                <x-cancel-queue-button /> {{-- Include the Cancel Queue button component --}}
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="row mb-3">
            <div class="col-12">
                <x-progress-bar :progress="75" /> {{-- Include the Progress Bar component and pass the progress value as 75 --}}
            </div>
        </div>

        {{-- Transaction Summary --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-10">
                <h1>Transaction Summary</h1>
                <p>Please review your selected transaction(s) below:</p>
            </div>
            <div class="col col-lg-2 text-end">
                <form method="POST" action="{{ route('select-transaction') }}">
                    @csrf
                    <input type="hidden" name="department_id" value="{{ Session::get('department_id') }}">
                    <button type="submit" class="btn btn-success btn-lg w-100">
                        <i class="fa-regular fa-square-plus"></i>
                        Add Transaction
                    </button>
                </form>
            </div>
        </div>

        {{-- Service Details --}}
        <div class="row row-cols-1 align-items-center justify-content-center">
            <div class="col">
                <div class="card h-100 w-100">
                    <div class="card-body p-5 ">
                        {{-- Department --}}
                        <div class="row">
                            {{-- Department header --}}
                            <div class="col-12 col-lg-3 fw-bold">
                                <h2>Department:</h2>
                            </div>
                            {{-- Display the department name --}}
                            <div class="col-12 col-lg-9">
                                <h2 class="fw-normal">{{ $department_name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 w-100">
                    <div class="card-body p-5 ">
                        {{-- Transaction --}}
                        <div class="row mt-2">
                            {{-- Transaction header --}}
                            <div class="col-12 col-lg-3 fw-bold">
                                <h2>Transaction(s):</h2>
                            </div>
                            {{-- Display each selected service name --}}
                            <div class="col-12 col-lg-9">
                                @foreach ($selected_services as $service)
                                    <h2 class="fw-normal">
                                        {{ $service['service_name'] }}
                                    </h2>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
