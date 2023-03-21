<div class="card bg-white-50 rounded-lg shadow w-100 px-4 py-3 mb-2"
    style="border-left: 8px solid #17A2B8; background-color: #f7f7f7;">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-kyoodark" type="button" id="queueInfoToggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <h5 class="fw-bold mb-0 d-inline-block me-3">{{ $studentName }}</h5>
                <i class="fa-solid fa-caret-down "></i>
            </button>
            <ul class="dropdown-menu p-3 rounded-lg" aria-labelledby="queueInfoToggle">
                <li><span class="fw-bold">Department:</span> {{ $department }}</li>
                <li><span class="fw-bold">Course:</span> {{ $course }}</li>
            </ul>
        </div>

        <div>
            @switch($clearancestatus)
                @case('Cleared')
                    <span class="text-success">
                        <i class="fas fa-check-circle me-2" aria-hidden="true"></i> Cleared
                    </span>
                @break

                @case('Not Cleared')
                    <span class="text-danger">
                        <i class="fas fa-times-circle me-2" aria-hidden="true"></i> Not Cleared
                    </span>
                @break

                @default
                    <span class="text-danger">
                        Error Getting Clearance Status
                    </span>
            @endswitch
        </div>
    </div>
</div>
