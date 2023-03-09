{{-- Page Title --}}
@section('mytitle', 'Select Department')


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
            <x-progress-bar :progress="25" />
        </div>


        {{-- Select Department Heading --}}
        <div class="row align-items-center">
            <div class="col">
                <h1>Select Department</h1>
                <p>Select Department Transaction</p>
            </div>
        </div>
        <div class="row align-items-center justify-content-center row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-1">
            {{-- Initialize active count --}}
            @php
                $activeCount = 0;
            @endphp
            {{-- Loop through all departments, display department card and increment active count if it's active --}}
            @foreach ($departments as $department)
                @if ($department->id != 1 && $department->id != 2 && $department->status == 'active')
                    <x-department-card :department="$department" /> {{-- Render department card component --}}
                    {{-- Increment active count --}}
                    @php
                        $activeCount++;
                    @endphp
                @endif
            @endforeach

            {{-- If no other department is available, display message --}}
            @if ($activeCount === 0)
                <div class="card h-100 w-100">
                    <div class="card-body p-5 text-center">
                        <span class="display-6 fw-bold mb-3 text-kyoored">
                            <i>No other department is available.</i>
                        </span>
                    </div>
                </div>
            @endif
        </div>

        {{-- Back Button --}}
        <x-back-button />
    </div>
</x-layout>
