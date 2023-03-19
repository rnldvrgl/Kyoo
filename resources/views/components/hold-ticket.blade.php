<div class="card bg-white-50 rounded-lg shadow w-100 px-4 py-3 mb-0"
    style="border-left: 8px solid #17A2B8; background-color: #f7f7f7;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-kyoodark" type="button" id="queueInfoToggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <h3 class="fw-bold mb-0 d-inline-block">{{ $queueNumber }}</h3>
                <i class="fa-solid fa-caret-down "></i>
            </button>
            <ul class="dropdown-menu p-3 rounded-lg" aria-labelledby="queueInfoToggle">
                <li><span class="fw-bold">Queue Time:</span> {{ $queueTime }}</li>
                <li><span class="fw-bold">Student Name:</span> {{ $studentName }}</li>
                <li><span class="fw-bold">Department:</span> {{ $department }}</li>
                <li><span class="fw-bold">Course:</span> {{ $course }}</li>
                <li>
                    <span class="fw-bold">Selected Services:</span>
                    <ul class="list-group">
                        @foreach ($services as $service)
                            <li class="list-group-item bg-light border-0">{{ $service }}</li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

        <div>
            <button class="complete-ticket-btn btn btn-success me-2"><i class="fas fa-check-circle me-2"></i>
                Complete</button>
            <button class="cancel-ticket-btn btn btn-outline-kyoored"><i class="fas fa-times-circle me-2"></i>
                Cancel</button>
        </div>
    </div>
</div>
