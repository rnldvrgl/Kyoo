<div class="card rounded-5 shadow w-100 px-4 py-4" style="border-left: 8px solid #E67E22; background-color: #f7f7f7;">
    <div class="card-body">
        <h5 class="card-title pb-2 fw-bold">Student Information</h5>
        <table class="table table-hover align-middle mb-4">
            <tr>
                <th scope="row">Student Name:</th>
                <td>{{ $studentName }}</td>
            </tr>
            <tr>
                <th scope="row">Department:</th>
                <td>{{ $department }}</td>
            </tr>
            <tr>
                <th scope="row">Course:</th>
                <td>{{ $course }}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success cleared-btn me-2" type="button" data-queue-number="{{ $queueNumber }}"
                data-ticket-id="{{ $ticketId }}" data-clearance_status="Cleared">
                <i class="fas fa-check-circle me-2" aria-hidden="true"></i> Cleared
            </button>
            <button class="btn btn-outline-danger not-cleared-btn" type="button"
                data-queue-number="{{ $queueNumber }}" data-ticket-id="{{ $ticketId }}"
                data-clearance_status="Not Cleared">
                <i class="fas fa-times-circle me-2" aria-hidden="true"></i> Not Cleared
            </button>
        </div>
    </div>
</div>
