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


    <main id="main" class="main px-2 mb-0">
        <section class="section dashboard">
            <div class="d-flex justify-content-center" style="max-height: 90vh;">

                {{-- 1st Column --}}
                <div class="col col-lg-10 px-2 d-flex flex-column" style="min-height: 100%;">
                    {{-- Pending Clearances --}}
                    <div class="card rounded-3 mb-3 border" style="flex: 1;max-height: 60vh; overflow-y: auto;">
                        <div class="card-header rounded-bottom rounded-3 bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
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
                                <span class="badge bg-kyooorange text-kyooorange rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2 d-flex flex-column justify-content-start"
                            style="max-height: 60vh; overflow-y: auto;">
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
                                            <p class="fw-bold fs-4 mb-0 text-muted">No Pending Clearance(s)</p>
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
                                            <p class="fw-bold fs-4 mb-0 text-muted">No Pending Clearance(s)</p>
                                        </div>
                                    @endif
                                @break

                                @default
                                    <div class="text-center my-auto">
                                        <p class="fw-bold fs-4 mb-0 text-muted">No Pending Clearance(s)</p>
                                    </div>
                                @break

                            @endswitch
                        </div>
                    </div>

                    {{-- Signed Clearances --}}
                    <div class="card rounded-3 mb-0 border" style="max-height: 30vh; overflow-y: auto;">
                        <div class="card-header rounded-bottom rounded-3 bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Signed Clearances</h4>
                                <span class="badge bg-success text-success rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2 d-flex flex-column justify-content-start"
                            style="max-height: 30vh; overflow-y: auto;">
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
                                                    course="{{ $c_signed_clearance->student_course }}" :services="$c_signed_clearance->services->pluck('name')->toArray()"
                                                    serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                                    clearancestatus="{{ $c_signed_clearance->clearance_status }}" />
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center my-auto">
                                            <p class="fw-bold fs-4 mb-0 text-muted">No Signed Clearance Yet</p>
                                        </div>
                                    @endif
                                @break

                                @case(4)
                                    @if ($hs_signed_clearances !== null && count($hs_signed_clearances) > 0)
                                        @foreach ($hs_signed_clearances as $key => $hs_signed_clearance)
                                            <div class="my-1">
                                                <x-pending-clearance-card id="queue-card-{{ $hs_signed_clearance->id }}"
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
                                        <div class="text-center my-auto">
                                            <p class="fw-bold fs-4 mb-0 text-muted">No Pending Clearance Yet</p>
                                        </div>
                                    @endif
                                @break

                                @default
                                    <div class="text-center my-auto">
                                        <p class="fw-bold fs-4 mb-0 text-muted">No Pending Clearance(s)</p>
                                    </div>
                                @break

                            @endswitch
                        </div>
                    </div>
                </div>

                {{-- 2nd Column --}}
                <div class="col col-lg-2 px-2 d-flex flex-column" style="min-height: 100%;">
                    {{-- Staff Actions --}}
                    <div class="card rounded-3 mb-3">
                        <div class="card-header rounded-bottom rounded-3 bg-kyoodark text-white">
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
                    <div class="card rounded-3 mb-0" style="flex: 2;max-height: 80vh; overflow-y: auto;">
                        <div class="card-header bg-kyoodark text-white">
                            <h4 class="fw-bold mb-0 text-center">Serving Stats</h4>
                        </div>
                        <div class="card-body py-3" style="max-height: 80vh; overflow-y: auto;">
                            <div class="d-flex flex-column justify-content-center gap-1 gap-md-2 gap-lg-3">
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-3">
                                        <h5 class="card-subtitle mb-3">Total Served Tickets</h5>
                                        <p class="card-text display-6 fw-bold mb-0">342</p>
                                        <p class="card-text text-muted mt-1">All services</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-3">
                                        <h5 class="card-subtitle mb-3">Cancelled Tickets</h5>
                                        <p class="card-text display-6 fw-bold mb-0">4</p>
                                        <p class="card-text text-muted mt-1">All services</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center p-4 bg-light border rounded-3">
                                        <h5 class="card-subtitle mb-3">Avg. Service Time</h5>
                                        <p class="card-text display-6 fw-bold mb-0">25<span class="fs-5"> min</span>
                                        </p>
                                        <p class="card-text text-muted mt-1">Last 30 tickets</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-3">
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
