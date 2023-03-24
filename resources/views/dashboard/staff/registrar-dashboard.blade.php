{{-- Page Title --}}
@section('mytitle', 'Registrar Dashboard')

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

    {{-- Text To Speech JS --}}
    <script  type="module" src="{{ asset('assets/js/textToSpeech.js') }}"></script>

    @php
        $hasCurrentServingTicket = false;
    @endphp

    @if ($servingTicket)
        @php
            $hasCurrentServingTicket = '{{ $servingTicket ? true : false }}';
        @endphp
    @endif

    <main id="main" class="main px-2">
        <section class="section dashboard">
            <div class="d-flex justify-content-center" style="max-height: 90vh;">
                {{-- 1st Column --}}
                <div class="col col-lg-4 px-2 flex-grow-1" style="min-height: 100%;">
                    {{-- Pending Tickets --}}
                    <div class="card border h-100 rounded-3">
                        <div class="card-header rounded-bottom rounded-3 bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                @if (count($pendingTickets) == 0 || count($pendingTickets) == 1)
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
                                @endif
                                <span class="badge bg-kyooorange text-kyooorange rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2 d-flex flex-column justify-content-start"
                            style="overflow-y: scroll; height: calc(100% - 55px);">
                            <div id="notifications"></div>

                            @if (count($pendingTickets) > 0)
                                @foreach ($pendingTickets as $key => $ticket)
                                    <div class="my-1">
                                        <x-queue-card id="queue-card-{{ $ticket->id }}" ticketId="{{ $ticket->id }}"
                                            queueNumber="{{ $ticket->ticket_number }}"
                                            queueTime="{{ $ticket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $ticket->student_name }}"
                                            department="{{ $ticket->student_department }}"
                                            course="{{ $ticket->student_course }}" :services="$ticket->services->pluck('name')->toArray()"
                                            serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                            clearancestatus="{{ $ticket->clearance_status }}"
                                            hasCurrentServingTicket="{{ $hasCurrentServingTicket }}" />
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center my-auto">
                                    <p class="fw-bold fs-4 mb-0 text-muted">No Pending Ticket(s)</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 2nd Column --}}
                <div class="col col-lg-6 px-2 d-flex flex-column" style="min-height: 100%;">
                    {{-- Current Serving Ticket --}}
                    <div class="card rounded-3 border mb-3" style="flex: 1;">
                        <div class="card-header rounded-bottom rounded-3 bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Current Serving Ticket</h4>
                                <span class="badge bg-success text-success rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center">
                            @if ($servingTicket)
                                <x-current-serving-ticket id="current-ticket-{{ $servingTicket->id }}"
                                    ticketId="{{ $servingTicket->id }}"
                                    queueNumber="{{ $servingTicket->ticket_number }}"
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
                            @endif
                        </div>
                    </div>


                    {{-- On Hold Tickets --}}
                    <div class="card rounded-3 mb-0 border" style="flex: 1;max-height: 40vh; overflow-y: auto;">
                        <div class="card-header bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                @if (count($holdingTickets) == 0 || count($holdingTickets) == 1)
                                    <h4 class="fw-bold mb-0">On Hold Ticket
                                        <span class="fw-light">|
                                            {{ count($holdingTickets) }} Ticket
                                        </span>
                                    </h4>
                                @else
                                    <h4 class="fw-bold mb-0">On Hold Tickets
                                        <span class="fw-light">|
                                            {{ count($holdingTickets) }} Tickets
                                        </span>
                                    </h4>
                                @endif
                                <span class="badge bg-kyooblue text-kyooblue  rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4 d-flex justify-content-start align-items-center flex-column gap-2"
                            style="max-height: 40vh; overflow-y: auto;">
                            @if (count($holdingTickets) > 0)
                                @foreach ($holdingTickets as $holdingTicket)
                                    <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                        ticketId="{{ $holdingTicket->id }}"
                                        queueNumber="{{ $holdingTicket->ticket_number }}"
                                        queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                        studentName="{{ $holdingTicket->student_name }}"
                                        department="{{ $holdingTicket->student_department }}"
                                        course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                @endforeach
                            @else
                                <div class="text-center my-auto">
                                    <p class="fw-bold fs-4 mb-0 text-muted text-center">No Ticket is On Hold</p>
                                    <p class="fs-6 text-muted text-center">There are currently no tickets on hold.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- 3rd Column --}}
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
                            {{-- {{ dd($avg_service_time) }} --}}
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
                                        <p class="card-text display-6 fw-bold mb-0">{{ $c_cancelled_tickets }}</p>
                                        <p class="card-text text-muted mt-1">All services</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="d-flex flex-column justify-content-center align-items-center p-4 bg-light border rounded-3">
                                        <h5 class="card-subtitle mb-3">Avg. Service Time</h5>
                                        <p class="card-text display-6 fw-bold mb-0">
                                            @switch($avg_service_time)
                                                @case(null)
                                                    0
                                                @break

                                                @default
                                                    {{ $avg_service_time }}
                                            @endswitch
                                            <span class="fs-5"> min</span>
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
