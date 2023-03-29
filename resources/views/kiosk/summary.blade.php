{{-- Page Title --}}
@section('mytitle', 'Transaction Summary')

<x-layout>

    {{-- Cancel Queue Button --}}
    <x-cancel-queue-button />

    <div class="container px-3 pt-5">
        {{-- Progress Bar --}}
        <div class="row mb-3">
            <div class="col-12">
                <x-progress-bar :progress="75" /> {{-- Include the Progress Bar component and pass the progress value as 75 --}}
            </div>
        </div>
    </div>
    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column px-5 py-4">
        {{-- Transaction Summary --}}
        <div class="col-12">
            <h1>Transaction Summary</h1>
            <p>Please review your selected transaction(s) below:</p>
        </div>

        {{-- Service Details --}}
        <div class="row row-cols-1 align-items-center justify-content-center">
            <div class="col">
                <div class="card h-100 w-100 rounded-5">
                    <div class="card-body p-5">
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
                <div class="card h-100 w-100 rounded-5">
                    <div class="card-body p-5 ">
                        {{-- Transaction --}}
                        <div class="row">
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
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form method="POST" action="{{ route('select-transaction') }}">
                        @csrf
                        <input type="hidden" name="department_id" value="{{ Session::get('department_id') }}">
                        <button type="submit" class="btn btn-secondary btn-lg w-100 rounded-pill">
                            Add Transaction
                            <i class="fa-regular fa-square-plus ms-2"></i>
                        </button>
                    </form>
                    <p class="mt-2 text-muted text-center">Select additional transactions and click the 'Add
                        Transaction' button above.</p>
                </div>
            </div>


            {{-- Proceed Button --}}
            <div class="col-12 fixed-bottom mb-3 text-end">
                <a href="{{ route('input-information') }}"
                    class="btn btn-success btn-success btn-lg btn-block rounded-pill">
                    Proceed
                    <i class="fa-solid fa-chevron-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</x-layout>
