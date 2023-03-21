<div class="card rounded-3 shadow w-100 px-4 pt-3 pb-4 mb-0"
    style="border-left: 8px solid #a7d2ad; background-color: #f7f7f7; height: auto;">
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-grow-1">
            <h6 class="fw-bold mb-0">Student Name:</h6>
            <p class="mb-0">{{ $studentName }}</p>
        </div>
        <div class="flex-grow-1">
            <h6 class="fw-bold mb-0">Department:</h6>
            <p class="mb-0">{{ $department }}</p>
        </div>
        <div class="flex-grow-1">
            <h6 class="fw-bold mb-0">Course:</h6>
            <p class="mb-0">{{ $course }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-success btn-sm cleared-btn" type="button" data-queue-number="{{ $queueNumber }}"
                data-ticket-id="{{ $ticketId }}" data-clearance_status="Cleared">
                <i class="fas fa-check-circle me-2" aria-hidden="true"></i> Cleared
            </button>

            <button class="btn btn-outline-kyoored btn-sm not-cleared-btn" type="button"
                data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                data-clearance_status="Not Cleared">
                <i class="fas fa-times-circle me-2" aria-hidden="true"></i> Not Cleared
            </button>
        </div>
    </div>
</div>
