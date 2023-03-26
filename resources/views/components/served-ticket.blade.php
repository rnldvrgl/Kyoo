<div class="card bg-white-50 rounded-lg shadow w-100 px-4 py-3 mb-2"
    style="border-left: 5px solid {{ $status === 'Complete' ? '#a7d2ad' : '#8C3D3D' }}; background-color:
    #f7f7f7;">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-kyoodark" type="button" id="queueInfoToggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <h5 class="fw-bold mb-0 d-inline-block me-3">{{ $queueNumber }}</h5>
                <i class="fa-solid fa-caret-down "></i>
            </button>
            <ul class="dropdown-menu p-3 rounded-3" aria-labelledby="queueInfoToggle">
                <div class="container">
                    <li><span class="fw-bold">Student Name:</span> {{ $studentName }}</li>
                    <li><span class="fw-bold">Department:</span> {{ $department }}</li>
                    <li><span class="fw-bold">Course:</span> {{ $course }}</li>
                </div>
            </ul>
        </div>

        <div>
            @switch($status)
                @case('Complete')
                    <span class="text-success">
                        <i class="fas fa-check-circle me-2" aria-hidden="true"></i> Completed
                    </span>
                @break

                @case('Cancelled')
                    <span class="text-kyoored">
                        <i class="fas fa-times-circle me-2" aria-hidden="true"></i> Cancelled
                    </span>
                @break

                @default
                    <span class="text-kyoored">
                        Error Getting Clearance Status
                    </span>
            @endswitch
        </div>
    </div>
</div>
