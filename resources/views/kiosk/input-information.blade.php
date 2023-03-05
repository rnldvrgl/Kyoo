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
            <x-progress-bar :progress="25" />
        </div>

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
