<div class="col-sm-12 col-md-6">
    <div class="card border shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-bold" style="font-size: clamp(1rem, 2vw, 1.5rem);">
                {{ $department->name }}</h5>
            @if ($department->status == 'active')
                <div class="d-flex justify-content-center align-items-center">
                    @if ($department->ticket_number)
                        <div class="d-flex flex-column align-items-center serving-ticket">
                            <h1 class="card-subtitle mb-2" style="font-size: clamp(2rem, 5vw, 3rem);" id="ticket_number">
                            </h1>
                            <span class="text-primary fw-semibold"
                                style="font-size: clamp(0.8rem, 2vw, 1.2rem);">Currently
                                Serving</span>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center">
                            <h1 class="card-subtitle mb-2" style="font-size: clamp(2rem, 5vw, 3rem);">No ticket</h1>
                            <span class="text-warning fw-semibold"
                                style="font-size: clamp(0.8rem, 2vw, 1.2rem);">Currently Being
                                Served</span>
                        </div>
                    @endif
                </div>
            @else
                <div class="d-flex flex-column align-items-center">
                    <h1 class="card-subtitle mb-2" style="font-size: clamp(2rem, 5vw, 3rem);">
                        Department</h1>
                    <span class="text-kyoored fw-semibold" style="font-size: clamp(0.8rem, 2vw, 1.2rem);">Currently
                        Not
                        Available</span>
                </div>
            @endif
        </div>
    </div>
</div>
