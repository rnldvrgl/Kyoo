<div class="card rounded-5 w-100 mb-0 px-4 pt-3 pb-4 shadow"
    style="border-left: 8px solid #a7d2ad; background-color: #f7f7f7; height: fit-content;">
    <div class="actions">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li>
                <button class="complete-ticket-btn dropdown-item complete" type="button"
                    data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}" data-status="Complete">
                    <i class="fas fa-check-circle me-2"></i> Complete
                </button>
            </li>
            @if ($serviceDepartmentId == 1)
                <li>
                    <button class="transfer-ticket-btn dropdown-item transfer" type="button"
                        data-queue-number="{{ $queueNumber }}" data-student-name="{{ $studentName }}"
                        data-student-department="{{ $department }}" data-student-course="{{ $course }}"
                        data-ticket-id="{{ $ticketId }}" data-status="On Hold">
                        <i class="fa-solid fa-credit-card"></i> For Payment
                    </button>
                </li>
            @endif
            <li>
                <button class="cancel-ticket-btn dropdown-item cancel" type="button"
                    data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                    data-status="Cancelled">
                    <i class="fas fa-times-circle me-2"></i> Cancel
                </button>
            </li>
        </ul>
    </div>
    <h3 class="fw-bold mb-0 text-center">{{ $queueNumber }}</h3>
    <small class="d-block text-center">{{ $queueTime }}</small>
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

    <h6 class="fw-bold mb-3">Selected Services</h6>
    <ul class="list-group mb-3">
        @foreach ($services as $service)
            <li class="list-group-item border bg-white">
                {{ $service }}
            </li>
        @endforeach
    </ul>

    {{-- Notes --}}
    @if ($notes)
        <div class="alert alert-primary d-flex justify-content-center align-items-center mx-auto p-2" role="alert">
            <i class="fa-solid fa-circle-info me-2"></i>
            <small class="text-center">
                {{ $notes }}
            </small>
        </div>
    @endif


    {{-- Transfer Notes --}}
    {{-- @if ($transfer_notes)
        <div class="alert alert-kyooblue d-flex justify-content-center align-items-center p-2 mx-auto" role="alert">
            <i class="fa-solid fa-circle-info me-2"></i>
            <small class="text-center">
                {{ $transfer_notes }}
            </small>
        </div>
    @endif --}}

    @if ($serviceDepartmentId == 1)
        @switch($clearancestatus)
            @case('Pending')
                {{-- <div id="clearance-status-{{ $ticketId }}"> --}}
                <span id="clearance-status-{{ $ticketId }}" class="badge bg-kyooorange rounded-pill py-3">
                    <i class="fas fa-circle-notch fa-spin me-2"></i>
                    Requesting Clearance ...
                </span>
                {{-- </div> --}}
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
                <button class="request-clearance-btn btn btn-outline-kyooorange rounded-pill btn-sm py-3" type="button"
                    data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                    data-servicedepartment="{{ $serviceDepartment }}">
                    <i class="fas fa-question-circle me-2"></i>
                    Request Clearance
                </button>
        @endswitch
    @endif


</div>
