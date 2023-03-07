{{-- Page Title --}}
@section('mytitle', 'Select Transaction')
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
                <x-progress-bar :progress="50" />
            </div>
        </div>

        {{-- Transaction Selection Heading --}}
        <div class="row align-items-center">
            <div class="col">
                <h1>Select Transaction</h1>
                <p>Select the transaction you need</p>
            </div>
        </div>

        {{-- List of Available Transactions --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 align-items-center justify-content-center">
            {{-- Loop over services --}}
            @foreach ($services->where('department_id', $department->id)->where('status', 'active')->sortBy('name') as $service)
                @php
                    $selected_services = session('selected_services', []);
                    $service_already_selected = false;
                    
                    // Check if the service is already selected
                    foreach ($selected_services as $selected_service) {
                        if ($selected_service['service_id'] == $service->id) {
                            $service_already_selected = true;
                            break;
                        }
                    }
                @endphp

                <div class="col" data-aos="fade-right" data-aos-delay="50">
                    {{-- If the service is already selected, show it as disabled --}}
                    @if ($service_already_selected)
                        <div class="card h-100 w-100 text-kyoodark disabled">
                            <div class="card-body p-5">
                                <p><span class="badge bg-danger">Already Selected</span></p>
                                <h3 class="fw-bold text-muted">{{ $service->name }}</h3>
                            </div>
                        </div>
                        {{-- If the service is not yet selected, show it as a clickable button --}}
                    @else
                        <form method="POST" action="{{ route('add-to-queue') }}">
                            @csrf
                            <input type="hidden" name="department_id" value="{{ $department->id }}">
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <button type="submit" class="card h-100 w-100 text-kyoodark link-card">
                                <div class="card-body p-5">
                                    <h3 class="fw-bold mb-3">{{ $service->name }}</h3>
                                    <p class="card-text my-3">{{ $service->description }}</p>
                                </div>
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach

            {{-- If no service is available, show a message --}}
            @if ($services->where('department_id', $department->id)->where('status', 'active')->count() === 0)
                <div class="col">
                    <div class="card h-100 w-100">
                        <div class="card-body p-5 text-center">
                            <h3 class="fw-bold mb-3 text-kyoored">
                                <i>No service is available.</i>
                            </h3>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Back Button --}}
        <x-back-button />
    </div>
</x-layout>
