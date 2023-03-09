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
            <div class="col-12">
                <x-progress-bar :progress="25" />
            </div>
        </div>

        {{-- Select Department Heading --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-10">
                <h1>Select Department</h1>
                <p>Select Department Transaction</p>
            </div>
            {{-- Other Department Button --}}
            <div class="col col-lg-2 text-end">
                <a href="{{ route('other-department') }}" class="btn btn-kyoored btn-lg">
                    Other Department
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>

        {{-- Department Cards --}}
        <div class="row align-items-center justify-content-center row-cols-2">
            {{-- Registrar Department --}}
            @if ($registrar->status === 'inactive')
                {{-- Inactive Registrar Department Card --}}
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body p-5 text-muted">
                            <p><span class="badge bg-danger">Inactive</span></p>
                            <span class="display-6 fw-bold mb-3">
                                {{ $registrar->name }}
                            </span>
                            <p class="card-text my-3 muted">
                                {{ $registrar->description }}
                            </p>
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
                            <p class="card-text my-3 muted">
                                {{ $cashier->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                {{-- Active Cashier Department Card --}}
                <x-department-card :department="$cashier" />
            @endif
        </div>

        {{-- Back Button --}}
        <x-back-button />
    </div>
</x-layout>
