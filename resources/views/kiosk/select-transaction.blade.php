{{-- Page Title --}}
@section('mytitle', 'Select Transaction')
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
                <p>Select the transaction you need</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 align-items-center justify-content-center">
            @foreach ($services->where('department_id', $department->id)->where('status', 'active')->sortBy('name') as $service)
                @if (!in_array($service->id, session('added_transactions', [])))
                    <div class="col" data-aos="fade-right" data-aos-delay="50">
                        <form method="POST" action="{{ route('add-to-queue') }}">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            @if (session('selected_transaction_' . $service->id))
                                <button type="button" class="card h-100 w-100 text-kyoodark link-card disabled">
                                @else
                                    <button type="submit" class="card h-100 w-100 text-kyoodark link-card">
                            @endif
                            <div class="card-body p-5">
                                <h3 class="fw-bold mb-3">{{ $service->name }}</h3>
                                <p class="card-text my-3">{{ $service->description }}</p>
                            </div>
                            </button>
                        </form>
                    </div>
                @endif
            @endforeach
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

        <x-back-button />
    </div>
</x-layout>
