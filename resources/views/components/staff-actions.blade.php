@php
    $canTakeBreak = $canTakeBreak ? true : false;
@endphp

<div class="card rounded-5 mb-3">
    <div class="card-header {{ $status == 'On Break' ? 'bg-secondary' : 'bg-success' }} text-white border-bottom border-5"
        id="action-header">
        <h4 class="fw-bold text-center">Staff Actions</h4>
        <p class="text-center mb-0" id="work-timer"></p>
    </div>
    <div class="card-body d-flex justify-content-center align-items-center py-sm-1 py-md-2 py-lg-3">
        <div class="d-grid w-100 gap-1">
            @if ($status == 'On Break')
                <button id="pause-work-btn" type="button" class="btn btn-kyoored rounded-pill d-none">
                    Take a Break <i class="fa-solid fa-pause ms-2"></i>
                </button>

                <button id="resume-work-btn" type="button" class="btn btn-success rounded-pill">
                    Resume Work <i class="fa-solid fa-play ms-2"></i>
                </button>
            @else
                <button id="pause-work-btn" type="button" class="btn btn-kyoored rounded-pill"
                    {{ !$canTakeBreak ? 'disabled' : '' }}>
                    {{ !$canTakeBreak ? 'Not Available' : 'Take a Break' }} <i class="fa-solid fa-pause ms-2"></i>
                </button>

                <button id="resume-work-btn" type="button" class="btn btn-success rounded-pill d-none">
                    Resume Work <i class="fa-solid fa-play ms-2"></i>
                </button>
            @endif

            <button id="end-shift-btn" class="btn btn-outline-kyoored rounded-pill logout-link"
                href="{{ route('logout') }}" {{ !$canTakeBreak ? 'disabled' : '' }}>
                {{ !$canTakeBreak ? 'Not Available' : 'End Shift' }}
                <i class="fa-solid fa-door-closed ms-2"></i>
            </button>
        </div>
    </div>
</div>
