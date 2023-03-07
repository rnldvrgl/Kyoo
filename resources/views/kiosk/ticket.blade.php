{{-- Page Title --}}
@section('mytitle', 'Transaction Summary')
<x-layout>
    {{-- Background Image --}}
    <div id="background-image" style="opacity: 5%;"></div>
    {{-- Main Content --}}
    <div class="container-fluid d-flex flex-column p-3 ">
        {{-- Cancel Queue Button --}}
        <div class="row mb-3">
            <div class="col-6">
                <x-cancel-queue-button /> {{-- Include the Cancel Queue button component --}}
            </div>
        </div>

        {{-- Transaction Summary --}}
        <div class="row align-items-center">
            <div class="col-12 col-lg-10">
                <h1>Transaction Summary</h1>
                <p>Please review your selected transaction(s) below:</p>
            </div>
        </div>

        {{-- Service Details --}}
        <div class="row row-cols-1 align-items-center justify-content-center">
            <div class="col">
                <div class="card h-100 w-100">
                    <div class="card-body p-5 ">
                        {{-- Department --}}
                        <div class="row">
                            {{-- Department header --}}
                            <div class="col-12 col-lg-3 fw-bold">
                                <h2>Ticket :</h2>
                            </div>
                            {{-- Display the department name --}}
                            <div class="col-12 col-lg-9">
                                <h2 class="fw-normal">{{ $ticket_number }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
