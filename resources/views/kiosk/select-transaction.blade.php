{{-- Page Title --}}
@section('mytitle', 'Select Department')

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
                <x-progress-bar :progress="50" />
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col">
                <h1>Select Transaction</h1>
                <p>Select the transaction you needed</p>
            </div>
        </div>

        <div class="row align-items-center justify-content-center row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-1">
            @php
                $activeCount = 0;
            @endphp

            @foreach ($kiosk_data['services']->where('dept_id', $department_id)->where('status', 'active')->sortBy('name') as $service)
                <x-service-card :service="$service" />
                @php
                    $activeCount++;
                @endphp
            @endforeach


            @if ($activeCount === 0)
                <div class="card h-100 w-100">
                    <div class="card-body p-5 text-center">
                        <span class="display-6 fw-bold mb-3 text-kyoored">
                            <i>No service is available.</i>
                        </span>
                    </div>
                </div>
            @endif
        </div>

        <x-back-button />
    </div>

</x-layout>
