<div class="col ">
    <div data-aos="fade-right">
        <div class="card border shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold" style="font-size: 1.5rem;">{{ $department->name }}</h5>
                @if ($department->status == 'active')
                    <div class="d-flex justify-content-center align-items-center">
                        @if ($department->ticket_number)
                            <div class="d-flex flex-column align-items-center">
                                <h1 class="card-subtitle mb-2">{{ $department->ticket_number }}</h1>
                                <span class="text-primary fw-semibold">Currently Serving</span>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-center">
                                <h1 class="card-subtitle mb-2">No ticket</h1>
                                <span class="text-warning fw-semibold">Currently Being Served</span>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="d-flex flex-column align-items-center">
                        <h1 class="card-subtitle mb-2">Department</h1>
                        <span class="text-kyoored fw-semibold">Currently Not Available</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
