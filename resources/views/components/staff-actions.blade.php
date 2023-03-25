<div class="card rounded-5 mb-3">
    <div class="card-header bg-transparent text-kyoodark border-bottom border-5">
        <h4 class="fw-bold mb-0 text-center">Staff Actions</h4>
    </div>
    <div class="card-body d-flex justify-content-center align-items-center py-sm-1 py-md-2 py-lg-3">
        <div class="d-grid w-100 gap-1">
            <button class="btn btn-outline-kyoored rounded-pill" id="end-shift-btn" href="{{ route('end_shift') }}">
                End Shift
                <i class="fa-solid fa-door-closed ms-2"></i>
            </button>
            <button class="btn btn-outline-kyoodarkblue pause-work-btn rounded-pill">
                Pause Work
                <i class="fa-solid fa-circle-pause ms-2"></i>
            </button>
        </div>
    </div>
</div>
