{{-- Page Title --}}
@section('mytitle', 'Select Department')
@php
    $registrar = $kiosk_data['departments']->find(1);
    $cashier = $kiosk_data['departments']->find(2);
@endphp

<x-layout>
    <div id="background-image" style="opacity: 5%;"></div>
    <div class="container-fluid d-flex flex-column p-3 gap-3">
        <div class="row mb-3">
            <div class="col-6">
                <x-cancel-queue-button />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <x-progress-bar :progress="25" />
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col">
                <h1>Select Department</h1>
                <p>Select Department Transaction</p>
            </div>
            <div class="col-9 text-end">
                <a href="{{ route('other-department') }}" class="btn btn-kyoored btn-lg">
                    Other Department
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="row align-items-center justify-content-center row-cols-2">

            @if ($registrar->status === 'inactive')
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
                <x-department-card :department="$registrar" />
            @endif

            @if ($cashier->status === 'inactive')
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
                <x-department-card :department="$cashier" />
            @endif


        </div>
    </div>

</x-layout>
