<div {{ $attributes->merge(['class' => 'card rounded-lg shadow px-4 py-3']) }}>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 mb-4 text-left">
            <div class="mb-2">
                <h3 class="fw-bold text-center mb-0">{{ $queueNumber }}</h3>
                <small class="text-center text-muted d-block">{{ $queueTime }}</small>
            </div>
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Student Name</h6>
                <p class="text-muted mb-0">{{ $studentName }}</p>
            </div>
            <div class="mb-3">
                <h6 class="fw-bold mb-0">Department</h6>
                <p class="text-muted mb-0">{{ $department }}</p>
            </div>
            <div class="">
                <h6 class="fw-bold mb-0">Course</h6>
                <p class="text-muted mb-0">{{ $course }}</p>
            </div>
        </div>
        <div class="col-md-6 h-100">
            <div class="mb-4">
                <h6 class="fw-bold mb-3">Selected Services</h6>
                <ul class="list-group">
                    @foreach ($services as $service)
                        <li class="list-group-item bg-light border-0">{{ $service }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="px-3">
                <div class="d-grid gap-3">
                    <button class="btn btn-primary rounded-sm px-2 py-1" type="button">
                        <i class="fas fa-bullhorn me-1"></i> Call Next
                    </button>
                    <button class="btn btn-outline-secondary rounded-sm px-2 py-1" type="button">
                        <i class="fas fa-file-signature me-1"></i> Clearance
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
