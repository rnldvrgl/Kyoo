{{-- Page Title --}}
@section('mytitle', 'Librarian Dashboard')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp

<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" :department="$department" />


    <main id="main" class="main px-2">
        <section class="section dashboard">
            <div class="d-flex justify-content-center" style="max-height: 90vh;">
                {{-- 1st Column --}}
                <div class="col col-lg-4 px-2 flex-grow-1" style="min-height: 100%;">
                    {{-- Pending Tickets --}}
                    <div class="card border h-100 rounded-5">
                        <div class="card-header rounded-bottom rounded-4 bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- @if (count($pendingTickets) == 0 || count($pendingTickets) == 1)
                                <h4 class="fw-bold mb-0">Pending Ticket
                                    <span class="fw-light">|
                                        {{ count($pendingTickets) }} Ticket
                                    </span>
                                </h4>
                            @else
                                <h4 class="fw-bold mb-0">Pending Tickets
                                    <span class="fw-light">|
                                        {{ count($pendingTickets) }} Tickets
                                    </span>
                                </h4>
                            @endif --}}
                                <span class="badge bg-kyooorange text-kyooorange rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2 d-flex flex-column justify-content-start"
                            style="overflow-y: scroll; height: calc(100% - 55px);">
                            <div id="notifications"></div>
                            @switch($department->id)
                                @case(3)
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
                                        <div class="text-center my-auto">
                                            <p class="fw-bold fs-4 mb-0 text-muted">No Pending Ticket(s)</p>
                                        </div>
                                    @endif
                                @break

                                @case(4)
                                    @if ($p_hs_clearance_tickets !== null && count($p_c_clearance_tickets) > 0)
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
                                                    serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                                    clearancestatus="{{ $p_hs_clearance_ticket->clearance_status }}" />
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center my-auto">
                                            <p class="fw-bold fs-4 mb-0 text-muted">No Pending Ticket(s)</p>
                                        </div>
                                    @endif
                                @break

                                @default
                                    <div class="text-center my-auto">
                                        <p class="fw-bold fs-4 mb-0 text-muted">No Pending Ticket(s)</p>
                                    </div>
                                @break

                            @endswitch
                        </div>
                    </div>
                </div>

                {{-- 2nd Column --}}
                <div class="col col-lg-6 px-2 d-flex flex-column" style="min-height: 100%;">
                    {{-- Current Serving Ticket --}}
                    <div class="card rounded-5 border mb-3" style="flex: 1;">
                        <div class="card-header rounded-bottom rounded-4 bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Current Serving Ticket</h4>
                                <span class="badge bg-success text-success rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center">
                            {{-- @if ($servingTicket)
                            <x-pending-clearance-card id="current-ticket-{{ $servingTicket->id }}"
                                ticketId="{{ $servingTicket->id }}" queueNumber="{{ $servingTicket->ticket_number }}"
                                queueTime="{{ $servingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                studentName="{{ $servingTicket->student_name }}"
                                department="{{ $servingTicket->student_department }}"
                                course="{{ $servingTicket->student_course }}" :services="$servingTicket->services->pluck('name')->toArray()"
                                clearancestatus="{{ $servingTicket->clearance_status }}"
                                serviceDepartment="{{ $department->name }}" />
                        @else
                            <div class="text-center">
                                <p class="fw-bold fs-4 mb-0 text-muted" style="overflow-wrap: break-word;">No Ticket
                                    is
                                    Currently Serving</p>
                                <p class="fs-6 text-muted mb-0" style="overflow-wrap: break-word;">Please call a
                                    pending
                                    ticket to be served.</p>
                            </div>
                        @endif --}}
                        </div>
                    </div>
                </div>


                {{-- 3rd Column --}}
                <div class="col col-lg-2 px-2 d-flex flex-column" style="min-height: 100%;">

                    {{-- Staff Actions --}}
                    <div class="card rounded-5 mb-3">
                        <div class="card-header rounded-bottom rounded-4 bg-kyoodark text-white">
                            <h4 class="fw-bold mb-0 text-center">Staff Actions</h4>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center py-sm-1 py-md-2 py-lg-3">
                            <div class="d-grid w-100 gap-1">
                                <button class="btn btn-outline-kyoored rounded-pill" id="end-shift-btn"
                                    href="{{ route('end_shift') }}">
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

                    {{-- Serving Stats --}}
                    <div class="card rounded-5 mb-0" style="flex: 2;max-height: 80vh; overflow-y: auto;">
                        <div class="card-header bg-kyoodark text-white">
                            <h4 class="fw-bold mb-0 text-center">Serving Stats</h4>
                        </div>
                        <div class="card-body py-3" style="max-height: 80vh; overflow-y: auto;">
                            <div class="d-flex flex-column justify-content-center gap-1 gap-md-2 gap-lg-3">
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-5">
                                        <h5 class="card-subtitle mb-3">Total Served Tickets</h5>
                                        <p class="card-text display-6 fw-bold mb-0">342</p>
                                        <p class="card-text text-muted mt-1">All services</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-5">
                                        <h5 class="card-subtitle mb-3">Cancelled Tickets</h5>
                                        <p class="card-text display-6 fw-bold mb-0">4</p>
                                        <p class="card-text text-muted mt-1">All services</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center p-4 bg-light border rounded-5">
                                        <h5 class="card-subtitle mb-3">Avg. Service Time</h5>
                                        <p class="card-text display-6 fw-bold mb-0">25<span class="fs-5"> min</span>
                                        </p>
                                        <p class="card-text text-muted mt-1">Last 30 tickets</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-5">
                                        <h5 class="card-subtitle mb-3">Avg. Wait Time</h5>
                                        <p class="card-text display-6 fw-bold mb-0">10<span class="fs-5"> min</span>
                                        </p>
                                        <p class="card-text text-muted mt-1">Last 30 tickets</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Staff JS --}}
    <script src="{{ asset('assets/js/staff.js') }}"></script>
</x-layout>