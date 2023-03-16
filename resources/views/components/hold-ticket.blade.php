<div class="card bg-white-50 border rounded-lg shadow w-100 px-4 py-3 mb-0">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="d-flex align-items-center ">
            <h3 class="fw-bold mb-0">{{ $queueNumber }}</h3>
            <button class="btn btn-link" type="button" id="queueInfoToggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-caret-down text-kyoodark"></i>
            </button>
            <ul class="dropdown-menu p-3 rounded-lg mb-2" aria-labelledby="queueInfoToggle">
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
            <button class="btn btn-success me-2"><i class="fas fa-check-circle me-2"></i> Complete</button>
            <button class="btn btn-danger"><i class="fas fa-times-circle me-2"></i> Cancel</button>
        </div>
    </div>

</div>
