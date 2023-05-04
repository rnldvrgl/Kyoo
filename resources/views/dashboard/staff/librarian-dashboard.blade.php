@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
    $canTakeBreak = true;
    
    if (count($p_c_clearance_tickets) > 0 || count($p_hs_clearance_tickets) > 0) {
        $canTakeBreak = false;
    }
@endphp


{{-- Page Title --}}
@section('mytitle', $department->name . ' Dashboard')

{{-- {{ dd($department); }} --}}

<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" :department="$department" />


    <main id="main" class="main px-2">
        <section class="section dashboard">
            <div class="d-flex justify-content-center" style="max-height: 90vh;">
                <div class="col col-lg-10 d-flex flex-column px-2" style="min-height: 100%;">
                    {{-- Pending Clearance --}}
                    <div class="card rounded-5 flex-grow-1 mb-3 shadow-lg" style="max-height: 50vh; overflow-y: auto;">
                        <div class="card-header text-kyoodark border-bottom border-success border-5 bg-transparent">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between align-items-center">
                                    @switch($department->id)
                                        @case(3)
                                            @if (count($p_c_clearance_tickets) == 0 || count($p_c_clearance_tickets) == 1)
                                                <h4 class="fw-bold mb-0">Pending Clearance
                                                    <span class="fw-light">|
                                                        {{ count($p_c_clearance_tickets) }} Pending
                                                    </span>
                                                </h4>
                                            @else
                                                <h4 class="fw-bold mb-0">Pending Clearances
                                                    <span class="fw-light">|
                                                        {{ count($p_c_clearance_tickets) }} Pendings
                                                    </span>
                                                </h4>
                                            @endif
                                        @break

                                        @case(4)
                                            @if (count($p_hs_clearance_tickets) == 0 || count($p_hs_clearance_tickets) == 1)
                                                <h4 class="fw-bold mb-0">Pending Clearance
                                                    <span class="fw-light">|
                                                        {{ count($p_hs_clearance_tickets) }} Pending
                                                    </span>
                                                </h4>
                                            @else
                                                <h4 class="fw-bold mb-0">Pending Clearances
                                                    <span class="fw-light">|
                                                        {{ count($p_hs_clearance_tickets) }} Pendings
                                                    </span>
                                                </h4>
                                            @endif
                                        @break

                                    @endswitch
                                    <span class="badge bg-success text-success rounded-circle p-1">
                                        <i class="fa-regular fa-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-start pending-clearance p-4"
                            style="max-height: 50vh; overflow-y: auto;">
                            <div id="notifications"></div>
                            @switch($department->id)
                                @case(3)
                                    <div class="c-pending-clearance">
                                        {{-- Append Cards here --}}
                                    </div>
                                    @if ($p_c_clearance_tickets !== null && count($p_c_clearance_tickets) > 0)
                                        @foreach ($p_c_clearance_tickets as $key => $p_c_clearance_ticket)
                                            <div class="my-1">
                                                <x-pending-clearance-card id="queue-card-{{ $p_c_clearance_ticket->id }}"
                                                    ticketId="{{ $p_c_clearance_ticket->id }}"
                                                    queueNumber="{{ $p_c_clearance_ticket->ticket_number }}"
                                                    queueTime="{{ $p_c_clearance_ticket->created_at->format('Y-m-d h:i:s A') }}"
                                                    studentName="{{ $p_c_clearance_ticket->student_name }}"
                                                    department="{{ $p_c_clearance_ticket->student_department }}"
                                                    course="{{ $p_c_clearance_ticket->student_course }}" :services="$p_c_clearance_ticket->services
                                                        ->pluck('name')
                                                        ->toArray()"
                                                    serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                                    clearancestatus="{{ $p_c_clearance_ticket->clearance_status }}" />
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="no-pending-clearance my-auto text-center">
                                            <p class="fw-bold fs-4 text-muted mb-0">No Pending Clearance(s)</p>
                                        </div>
                                    @endif
                                @break

                                @case(4)
                                    <div class="hs-pending-clearance">
                                        {{-- Append Cards here --}}
                                    </div>
                                    @if ($p_hs_clearance_tickets !== null && count($p_hs_clearance_tickets) > 0)
                                        @foreach ($p_hs_clearance_tickets as $key => $p_hs_clearance_ticket)
                                            <div class="my-1">
                                                <x-pending-clearance-card id="queue-card-{{ $p_hs_clearance_ticket->id }}"
                                                    ticketId="{{ $p_hs_clearance_ticket->id }}"
                                                    queueNumber="{{ $p_hs_clearance_ticket->ticket_number }}"
                                                    queueTime="{{ $p_hs_clearance_ticket->created_at->format('Y-m-d h:i:s A') }}"
                                                    studentName="{{ $p_hs_clearance_ticket->student_name }}"
                                                    department="{{ $p_hs_clearance_ticket->student_department }}"
                                                    course="{{ $p_hs_clearance_ticket->student_course }}" :services="$p_hs_clearance_ticket->services
                                                        ->pluck('name')
                                                        ->toArray()"
                                                    serviceDepartment="{{ $department->id }}" :position="$loop->index + 1"
                                                    clearancestatus="{{ $p_hs_clearance_ticket->clearance_status }}" />
                                            </div>
                                </div>
                                @endforeach
                            @else
                                <div class="no-pending-clearance my-auto text-center">
                                    <p class="fw-bold fs-4 text-muted mb-0">No Pending Clearance(s)</p>
                                </div>
                                @endif
                            @break

                            @default
                                <div class="no-pending-clearance my-auto text-center">
                                    <p class="fw-bold fs-4 text-muted mb-0">No Pending Clearance(s)</p>
                                </div>
                            @break

                        @endswitch
                    </div>
                </div>

                {{-- Signed Clearance --}}
                <div class="card rounded-5 flex-grow-1 mb-0 shadow-lg" style="max-height: 40vh; overflow-y: auto;">
                    <div class="card-header text-kyoodark border-bottom border-kyooblue border-5 bg-transparent">
                        <div class="container-fluid">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Signed Clearances</h4>

                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="badge bg-kyooblue text-kyooblue rounded-circle p-1">
                                        <i class="fa-regular fa-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body d-flex justify-content-start flex-column gap-2 p-4"
                        style="max-height: 40vh; overflow-y: auto;">
                        @switch($department->id)
                            @case(3)
                                @if ($c_signed_clearances !== null && count($c_signed_clearances) > 0)
                                    @foreach ($c_signed_clearances as $key => $c_signed_clearance)
                                        <div class="my-1">
                                            <x-signed-clearance id="queue-card-{{ $c_signed_clearance->id }}"
                                                ticketId="{{ $c_signed_clearance->id }}"
                                                queueNumber="{{ $c_signed_clearance->ticket_number }}"
                                                queueTime="{{ $c_signed_clearance->created_at->format('Y-m-d h:i:s A') }}"
                                                studentName="{{ $c_signed_clearance->student_name }}"
                                                department="{{ $c_signed_clearance->student_department }}"
                                                course="{{ $c_signed_clearance->student_course }}"
                                                serviceDepartment="{{ $department->name }}" :services="$c_signed_clearance->services->pluck('name')->toArray()"
                                                serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                                clearancestatus="{{ $c_signed_clearance->clearance_status }}" />
                                        </div>
                                    @endforeach
                                @else
                                    <div class="my-auto text-center">
                                        <p class="fw-bold fs-4 text-muted mb-0">No Signed Clearance Yet</p>
                                    </div>
                                @endif
                            @break

                            @case(4)
                                @if ($hs_signed_clearances !== null && count($hs_signed_clearances) > 0)
                                    @foreach ($hs_signed_clearances as $key => $hs_signed_clearance)
                                        <div class="my-1">
                                            <x-signed-clearance id="queue-card-{{ $hs_signed_clearance->id }}"
                                                ticketId="{{ $hs_signed_clearance->id }}"
                                                queueNumber="{{ $hs_signed_clearance->ticket_number }}"
                                                queueTime="{{ $hs_signed_clearance->created_at->format('Y-m-d h:i:s A') }}"
                                                studentName="{{ $hs_signed_clearance->student_name }}"
                                                department="{{ $hs_signed_clearance->student_department }}"
                                                course="{{ $hs_signed_clearance->student_course }}" :services="$hs_signed_clearance->services->pluck('name')->toArray()"
                                                serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                                clearancestatus="{{ $hs_signed_clearance->clearance_status }}" />
                                        </div>
                                    @endforeach
                                @else
                                    <div class="my-auto text-center">
                                        <p class="fw-bold fs-4 text-muted mb-0">No Pending Clearance Yet</p>
                                    </div>
                                @endif
                            @break

                            @default
                                <div class="my-auto text-center">
                                    <p class="fw-bold fs-4 text-muted mb-0">No Pending Clearance(s)</p>
                                </div>
                            @break

                        @endswitch
                    </div>
                </div>
            </div>

            {{-- Filters Modal --}}
            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exportModalLabel">Export Ticket</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div id="res">
                                {{-- Insert Message here --}}
                            </div>

                            <form id="export-librarian-ticket" action="{{ route('export-librarian-ticket') }}"
                                method="POST" autocomplete="off">

                                @csrf

                                <input type="hidden" name="library_type" value="{{ $department->name }}">

                                <div class="form-floating rounded-pill mb-3">
                                    <select class="form-select" name="department" id="floatingDepartment"
                                        aria-label="Department">
                                        <option value="" selected>Select Department</option>
                                        @if ($department->name == 'College Library')
                                            <option value="Graduate School">Graduate School</option>
                                            <option value="College">College</option>
                                        @elseif($department->name == 'High School Library')
                                            <option value="Senior High School">Senior High School</option>
                                            <option value="Junior High School">Junior High School</option>
                                        @endif
                                    </select>
                                    <label for="floatingDepartment">Department</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" name="course" id="floatingCourse"
                                        aria-label="Course">
                                        <option value="" selected disabled>Select Course</option>
                                    </select>
                                    <label for="floatingCourse">Course</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" name="clearance_status" id="floatingClearanceStatus"
                                        aria-label="Clearance Status">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Not Cleared">Not Cleared</option>
                                        <option value="Cleared">Cleared</option>
                                    </select>
                                    <label for="floatingClearanceStatus">Clearance Status</label>
                                </div>

                                <div class="row">
                                    <div class="col-6 form-floating mb-3">
                                        <input class="form-control" type="date" name="start_date"
                                            id="floatingStartDate">
                                        <label for="floatingStartDate">From</label>
                                    </div>

                                    <div class="col-6 form-floating mb-3">
                                        <input class="form-control" type="date" name="end_date"
                                            id="floatingEndDate">
                                        <label for="floatingEndDate">To</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary flex" type="submit" id="btn-submit-filter">
                                    Filter
                                    <i class="fa-solid fa-filter"></i>
                                </button>

                                <button type="reset" class="btn btn-kyoored">
                                    Clear Filter
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2nd Column --}}
            <div class="col col-lg-2 d-flex flex-column px-2" style="min-height: 100%;">

                {{-- Staff Actions --}}
                <x-staff-actions status="{{ $login->status }}" canTakeBreak="{{ $canTakeBreak }}"
                    role="{{ $role->name }}" department="{{ $department->name }}" login="{{ $login->id }}" />

                {{-- Librarian Stats --}}
                <x-librarian-stats :countSignedClearances="$count_signed_clearances" :countClearedClearances="$count_completed_clearances" :countUnclearedClearances="$count_uncleared_clearances"
                    departmentId="{{ $department->id }}" />
            </div>
        </section>
    </main>

    {{-- Staff JS --}}
    <script src="{{ asset('assets/js/staff.js') }}"></script>

    {{-- Refresh Page JS --}}
    {{-- <script src="{{ asset('assets/js/refreshPage.js') }}"></script> --}}
</x-layout>
