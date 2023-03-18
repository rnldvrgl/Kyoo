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
    <div class="px-3">
        <div class="d-grid gap-3">
            <button class="btn btn-kyoodarkblue text-white rounded-pill px-3 py-2 btn-lg" type="button"
                onclick="callNext('{{ $ticketId }}', '{{ $queueNumber }}')">
                <i class="fas fa-bullhorn me-2"></i> Call Queue Number
            </button>
            <button class="btn btn-outline-kyoodarkblue rounded-pill px-3 py-2 btn-sm" type="button">
                <i class="fas fa-file-signature me-2"></i> Ask for Clearance
            </button>
            {{-- If Clearance Status is Cleared --}}
            {{-- <button class="btn btn-success rounded-pill px-3 py-2 btn-sm" type="button" disabled>
                <i class="fas fa-check me-2"></i> Clearance Cleared
            </button> --}}
        </div>
    </div>
</div>

<script>
    function callNext(ticketId, queueNumber) {
        $('#current-ticket').text(queueNumber);
    }
</script>
