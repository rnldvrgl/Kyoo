<div {{ $attributes->merge(['class' => 'card rounded-lg shadow-sm w-100 px-4 py-4']) }}
    style="border-left: 8px solid #F2D388; background-color: #f7f7f7;">
    <div class="row d-flex justify-content-evenly">
        <div class="col-lg-6 mb-4 text-left">
            <div class="mb-2">
                <h3 class="fw-bold text-center mb-0">{{ $queueNumber }}</h3>
                <small class="text-center d-block">{{ $queueTime }}</small>
            </div>
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Student Name:</h6>
                <p class="mb-0">{{ $studentName }}</p>
            </div>
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Department:</h6>
                <p class="mb-0">{{ $department }}</p>
            </div>
            <div>
                <h6 class="fw-bold mb-0">Course:</h6>
                <p class="mb-0">{{ $course }}</p>
            </div>
        </div>
        <div class="col-lg-6 h-100">
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Selected Services:</h6>
                <ul class="list-group">
                    @foreach ($services as $service)
                        <li class="bg-transparent border-0">{{ $service }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="px-5">
        <div class="d-grid gap-2">
            <button class="call-ticket-btn btn btn-kyoodarkblue text-white rounded-pill py-2 btn-sm" type="button"
                data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}" data-status="Calling"
                data-servicedepartment="{{ $serviceDepartment }}">
                <i class="fas fa-bullhorn me-2"></i> Call Queue Number
            </button>

            <button class="serve-ticket-btn btn btn-success rounded-pill py-2 btn-sm" type="button"
                data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}" data-status="Serving">
                <i class="fas fa-check-circle
                me-2"></i> Serve Ticket
            </button>

            <button class="ask-clearance-btn btn btn-outline-kyoodarkblue rounded-pill py-2 btn-sm" type="button"
                data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                data-status="For Clearance" data-servicedepartment="{{ $serviceDepartment }}">
                <i class="fas fa-question-circle
                me-2"></i> Ask for Clearance
            </button>
        </div>
    </div>
</div>
