{{-- Page Title --}}
@section('mytitle', 'Input Information')


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
            <x-progress-bar :progress="100" />
        </div>

        {{-- Input Information Heading --}}
        <div class="row align-items-center">
            <div class="col">
                <h1>Select Department</h1>
                <p>Select Department Transaction</p>
            </div>
        </div>
        <div class="row align-items-center justify-content-center row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-1">
        </div>
    </div>
</x-layout>
