{{-- Page Title --}}
@section('mytitle', 'Select Transaction')
<x-layout>

    {{-- Cancel Queue Button --}}
    <x-cancel-queue-button />

    {{-- Progress Bar --}}
    <div class="container px-3 pt-5">
        <div class="row mb-3">
            <div class="col-12">
                <x-progress-bar :progress="50" />
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column px-5 py-4">

        {{-- Transaction Selection Heading --}}
        <div class="row align-items-center">
            <div class="col">
                <h1>Select Transaction</h1>
                <p>Select the transaction you need.</p>
                <p>If you're unsure which transaction to select, please ask a staff member for assistance.</p>
            </div>
        </div>

        {{-- List of Available Transactions --}}
        <div class="row align-items-center justify-content-start">
            {{-- Loop over services --}}
            @php
                $selected_services = session('selected_services', []);
                $counter = 0;
            @endphp
            @foreach ($services->where('department_id', $department->id)->where('status', 'active')->sortBy('name') as $service)
                @php
                    $service_already_selected = false;
                    
                    // Check if the service is already selected
                    foreach ($selected_services as $selected_service) {
                        if ($selected_service['service_id'] == $service->id) {
                            $service_already_selected = true;
                            break;
                        }
                    }
                @endphp

                <div class="col-md-4 mb-3" data-aos="fade-right" data-aos-delay="50">
                    {{-- If the service is already selected, show it as disabled --}}
                    @if ($service_already_selected)
                        <div class="card disabled shadow">
                            <div class="card-body px-5 py-4">
                                <h3 class="fw-bold text-muted">{{ $service->name }}</h3>
                                <p><span class="badge bg-danger">Already Selected</span></p>
                            </div>
                        </div>

                        {{-- If the service is not yet selected, show it as a clickable button --}}
                    @else
                        <form method="POST" action="{{ route('add-to-queue') }}" class="shadow">
                            @csrf
                            <input type="hidden" name="department_id" value="{{ $department->id }}">
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <button type="submit" class="card h-100 w-100 text-kyoodark link-card">
                                <div class="card-body p-5">
                                    <h3 class="fw-bold">{{ $service->name }}</h3>
                                </div>
                            </button>
                        </form>
                    @endif
                </div>

                @php
                    $counter++;
                    if ($counter == 3) {
                        echo '</div><div class="row align-items-center justify-content-start">';
                        $counter = 0;
                    }
                @endphp
            @endforeach
        </div>

        {{-- If no service is available, show a message --}}
        @if ($services->where('department_id', $department->id)->where('status', 'active')->count() === 0)
            <div class="col-12">
                <div class="card h-100 w-100">
                    <div class="card-body p-5 text-center">
                        <h3 class="fw-bold mb-3 text-kyoored">
                            <i>We're sorry, but there are no services currently being offered.</i>
                        </h3>
                    </div>
                </div>
            </div>
        @endif

        {{-- Back Button --}}
        <x-back-button :selected_services="$selected_services" />
    </div>
</x-layout>
