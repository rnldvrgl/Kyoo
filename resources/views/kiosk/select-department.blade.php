{{-- Page Title --}}
@section('mytitle', 'Select Department')

@php
    // Retrieve the Registrar and Cashier departments from the $departments collection
    $registrar = $departments->find(1);
    $cashier = $departments->find(2);
@endphp
<x-layout>
    {{-- Background Image --}}
    <div id="background-image" style="opacity: 5%;"></div>

    {{-- Cancel Queue Button --}}
    <x-cancel-queue-button />

    {{-- Progress Bar --}}
    <div class="container px-3 pt-5">
        <div class="row mb-3">
            <div class="col-12">
                <x-progress-bar :progress="25" />
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column px-5 py-4">
        {{-- Select Department Heading --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-8">
                <h1>Select Department</h1>
                <p>Select a department where you will be served.</p>
            </div>
        </div>

        {{-- Department Cards --}}
        <div class="row align-items-center justify-content-center row-cols-2">
            {{-- Registrar Department --}}
            @if ($registrar->status === 'inactive')
                {{-- Inactive Registrar Department Card --}}
                <div class="col">
                    <div class="card h-100 ">
                        <div class="card-body p-5 text-muted">
                            <p><span class="badge bg-danger">Inactive</span></p>
                            <span class="display-6 fw-bold mb-3">
                                {{ $registrar->name }}
                            </span>
                        </div>
                    </div>
                </div>
            @else
                {{-- Active Registrar Department Card --}}
                <x-department-card :department="$registrar" />
            @endif

            {{-- Cashier Department --}}
            @if ($cashier->status === 'inactive')
                {{-- Inactive Cashier Department Card --}}
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body p-5 text-muted">
                            <p><span class="badge bg-danger">Inactive</span></p>
                            <span class="display-6 fw-bold mb-3">
                                {{ $cashier->name }}
                            </span>
                        </div>
                    </div>
                </div>
            @else
                {{-- Active Cashier Department Card --}}
                <x-department-card :department="$cashier" />
            @endif
        </div>


        {{-- Other Department Button --}}
        <div class="row mt-3">
            <div class="col-md-4 offset-md-4">
                <a href="{{ route('other-department') }}" class="btn btn-outline-kyoored btn-lg w-100">
                    Other Department
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <p class="mt-2 text-muted text-center">If you don't see your desired department, please click on the
                    button above.</p>
            </div>
        </div>



    </div>
</x-layout>
