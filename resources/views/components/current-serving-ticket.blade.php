<div class="card rounded-lg shadow w-100 px-4 pt-3 pb-4"
    style="border-left: 8px solid #a7d2ad; background-color: #f7f7f7; height: fit-content;">
    <div class="actions">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li>
                <button class="dropdown-item complete" type="button">
                    <i class="fas fa-check-circle me-2"></i> Complete
                </button>
            </li>
            <li>
                <button class="dropdown-item transfer" type="button">
                    <i class="fa-solid fa-right-left"></i> Transfer
                </button>
            </li>
            <li>
                <button class="dropdown-item cancel" type="button">
                    <i class="fas fa-times-circle me-2"></i> Cancel
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

    <h6 class="fw-bold mb-3">Selected Services</h6>
    <ul class="list-group">
        @foreach ($services as $service)
            <li class="list-group-item bg-white border">
                {{ $service }}
            </li>
        @endforeach
    </ul>
</div>
