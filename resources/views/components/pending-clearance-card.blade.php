<div class="card rounded-5 shadow w-100 px-4 pt-3 pb-4 mb-0"
    style="border-left: 8px solid #a7d2ad; background-color: #f7f7f7; height: fit-content;">
    <div class="actions">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li>
                <button class="complete-ticket-btn dropdown-item complete" type="button"
                    data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}" data-status="Cleared">
                    <i class="fas fa-check-circle me-2"></i> Cleared
                </button>
            </li>
            <li>
                <button class="cancel-ticket-btn dropdown-item cancel" type="button"
                    data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                    data-status="Not Cleared">
                    <i class="fas fa-times-circle me-2"></i> Not Cleared
                </button>
            </li>
        </ul>
    </div>
    <h3 class="fw-bold text-center mb-0">{{ $queueNumber }}</h3>
    <small class="text-center d-block">{{ $queueTime }}</small>
    <div class="mb-3">
        <h6 class="fw-bold mb-0">Student Name</h6>
        <p class="mb-0">{{ $studentName }}</p>
    </div>
    <div class="mb-3">
        <h6 class="fw-bold mb-0">Department</h6>
        <p class="mb-0">{{ $department }}</p>
    </div>
    <div class="mb-3">
        <h6 class="fw-bold mb-0">Course</h6>
        <p class="mb-0">{{ $course }}</p>
    </div>

    @switch($clearancestatus)
        @case('Pending')
            <span class="badge bg-kyooorange rounded-pill py-3">
                <i class="fas fa-circle-notch fa-spin me-2"></i>
                Requesting Clearance ...
            </span>
        @break

        @case('Cleared')
            <span class="badge bg-success rounded-pill py-3">
                <i class="fas fa-check-circle me-2"></i>
                Clearance Cleared
            </span>
        @break

        @case('Not Cleared')
            <span class="badge bg-kyoored rounded-pill py-3">
                <i class="fas fa-exclamation-circle me-2"></i>
                Clearance Not Cleared
            </span>
        @break

        @default
            <button class="request-clearance-btn btn btn-outline-kyooorange rounded-pill py-3 btn-sm" type="button"
                data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                data-servicedepartment="{{ $serviceDepartment }}">
                <i class="fas fa-question-circle me-2"></i>
                Request Clearance
            </button>
    @endswitch
</div>
