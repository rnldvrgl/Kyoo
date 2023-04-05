<div class="card shadow-none mb-2 py-3 rounded-5 {{ $ticketStatus == 'Calling' ? 'flicker bg-pastel-blue' : '' }} {{ $ticketStatus == 'Serving' ? 'bg-pastel-green' : '' }}  border"
    data-aos="slide-right">
    <div class="card-body pb-0">
        <div class="row">
            <div class="col col-lg-5 d-flex justify-content-start align-items-center">
                <h5 class="mb-0 fw-semibold ">{{ $departmentName }}</h5>
            </div>
            <div class="col col-lg-5  d-flex justify-content-start align-items-center">
                <h5 class="text-kyoodark fw-bold mb-0 {{ $ticketStatus == 'Calling' ? 'flicker' : '' }}">
                    {{ $ticketNumber }}</h5>
            </div>
            <div class="col col-lg-2 d-flex justify-content-start align-items-center">
                <span
                    class="badge rounded-pill
            @if ($ticketStatus == 'Pending') bg-warning
            @elseif($ticketStatus == 'Calling') bg-primary
            @elseif($ticketStatus == 'Serving') bg-success
            @elseif($ticketStatus == 'On Hold') bg-info
            @elseif($ticketStatus == 'Complete') bg-danger
            @elseif($ticketStatus == 'Cancelled') bg-danger @endif">
                    {{ $ticketStatus }}
                </span>
            </div>
        </div>
    </div>
</div>
