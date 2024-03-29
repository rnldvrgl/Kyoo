@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
    $hasCurrentServingTicket = false;
    $canTakeBreak = true;
    
    if (count($pendingTickets) > 0 || $servingTicket == true) {
        $canTakeBreak = false;
    }
@endphp


@if ($servingTicket)
    @php
        $hasCurrentServingTicket = '{{ $servingTicket ? true : false }}';
    @endphp
@endif


{{-- Page Title --}}
@section('mytitle', $department->name . ' Dashboard')



<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" :department="$department" />

    {{-- Text To Speech JS --}}
    <script  type="module" src="{{ asset('assets/js/textToSpeech.js') }}"></script>

    <main id="main" class="main px-2">
        <section class="section dashboard">
            <div id="res">
                {{-- Append message here --}}
            </div>
            <div class="d-flex justify-content-center" style="max-height: 90vh;">
                {{-- 1st Column --}}
                <div class="col col-lg-4 flex-grow-1 px-2" style="min-height: 100%;">
                    {{-- Pending Tickets --}}
                    <div class="card h-100 rounded-5 shadow-lg">
                        <div class="card-header text-kyoodark border-bottom border-kyooorange border-5 bg-transparent">
                            <div class="container-fluid">
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
                        </div>
                        <div class="card-body d-flex flex-column justify-content-start px-4 pt-4 pb-2"
                            style="overflow-y: scroll; height: calc(100% - 55px);">

                            <div id="notifications"></div>

                            @if (count($pendingTickets) > 0)
                                <div class="container-fluid">
                                    @foreach ($pendingTickets as $key => $ticket)
                                        <div class="my-1">
                                            <x-queue-card id="queue-card-{{ $ticket->id }}"
                                                ticketId="{{ $ticket->id }}"
                                                queueNumber="{{ $ticket->ticket_number }}"
                                                queueTime="{{ $ticket->created_at->format('Y-m-d h:i:s A') }}"
                                                studentName="{{ $ticket->student_name }}"
                                                department="{{ $ticket->student_department }}"
                                                course="{{ $ticket->student_course }}" :services="$ticket->services->pluck('name')->toArray()"
                                                serviceDepartmentId="{{ $department->id }}"
                                                serviceDepartment="{{ $department->name }}" :position="$loop->index + 1"
                                                clearancestatus="{{ $ticket->clearance_status }}"
                                                hasCurrentServingTicket="{{ $hasCurrentServingTicket }}"
                                                transferNotes="{{ $ticket->transfer_notes }}"
                                                notes="{{ $ticket->notes }}" />
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="my-auto text-center">
                                    <p class="fw-bold fs-4 text-muted mb-0">No Pending Ticket(s)</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 2nd Column --}}
                <div class="col col-lg-6 d-flex flex-column px-2" style="min-height: 100%;">
                    {{-- Current Serving Ticket --}}
                    <div class="card rounded-5 mb-3 shadow-lg" style="flex: 1;">
                        <div class="card-header text-kyoodark border-bottom border-success border-5 bg-transparent">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="fw-bold mb-0">Current Serving Ticket</h4>
                                    <span class="badge bg-success text-success rounded-circle p-1">
                                        <i class="fa-regular fa-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                            <div class="container-fluid">
                                @if ($servingTicket)
                                    <x-current-serving-ticket id="current-ticket-{{ $servingTicket->id }}"
                                        ticketId="{{ $servingTicket->id }}"
                                        queueNumber="{{ $servingTicket->ticket_number }}"
                                        queueTime="{{ $servingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                        studentName="{{ $servingTicket->student_name }}"
                                        department="{{ $servingTicket->student_department }}"
                                        course="{{ $servingTicket->student_course }}" :services="$servingTicket->services->pluck('name')->toArray()"
                                        clearancestatus="{{ $servingTicket->clearance_status }}"
                                        serviceDepartmentId="{{ $department->id }}"
                                        serviceDepartment="{{ $department->name }}"
                                        transferNotes="{{ $servingTicket->transfer_notes }}"
                                        notes="{{ $servingTicket->notes }}" />
                                @else
                                    <div class="text-center">
                                        <p class="fw-bold fs-4 text-muted mb-0" style="overflow-wrap: break-word;">No
                                            Ticket
                                            is
                                            Currently Serving</p>
                                        <p class="fs-6 text-muted mb-0" style="overflow-wrap: break-word;">Please call a
                                            pending
                                            ticket to be served.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    {{-- Served Tickets --}}
                    <div class="card rounded-5 mb-0 shadow-lg" style="flex: 1;max-height: 40vh; overflow-y: auto;">
                        <div class="card-header text-kyoodark border-bottom border-kyooblue border-5 bg-transparent">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between align-items-center">
                                    @if (count($servedTickets) == 0 || count($holdingTickets) == 1)
                                        <h4 class="fw-bold mb-0">Served Ticket
                                            <span class="fw-light">|
                                                {{ count($servedTickets) }} Ticket
                                            </span>
                                        </h4>
                                    @else
                                        <h4 class="fw-bold mb-0">Served Tickets
                                            <span class="fw-light">|
                                                {{ count($servedTickets) }} Tickets
                                            </span>
                                        </h4>
                                    @endif
                                    <span class="badge bg-kyooblue text-kyooblue rounded-circle p-1">
                                        <i class="fa-regular fa-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body d-flex justify-content-start align-items-center flex-column gap-2 p-4"
                            style="max-height: 40vh; overflow-y: auto;">
                            @if (count($servedTickets) > 0)
                                <div class="container-fluid">
                                    @foreach ($servedTickets as $servedTicket)
                                        <x-served-ticket id="served-ticket-{{ $servedTicket->id }}"
                                            ticketId="{{ $servedTicket->id }}"
                                            queueNumber="{{ $servedTicket->ticket_number }}"
                                            queueTime="{{ $servedTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $servedTicket->student_name }}"
                                            department="{{ $servedTicket->student_department }}"
                                            course="{{ $servedTicket->student_course }}" :services="$servedTicket->services->pluck('name')->toArray()"
                                            status="{{ $servedTicket->status }}" />
                                    @endforeach
                                </div>
                            @else
                                <div class="my-auto text-center">
                                    <p class="fw-bold fs-4 text-muted mb-0 text-center">No Tickets Served Today</p>
                                    <p class="fs-6 text-muted text-center">There are currently no tickets that have been
                                        served.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- 3rd Column --}}
                <div class="col col-lg-2 d-flex flex-column px-2" style="min-height: 100%;">

                    {{-- Staff Actions --}}
                    <x-staff-actions status="{{ $login->status }}" canTakeBreak="{{ $canTakeBreak }}"
                        role="{{ $role->name }}" department="{{ $department->name }}"
                        login="{{ $login->id }}" />

                    {{-- Serving Stats --}}
                    <x-serving-stats avgServingTime="{{ $avg_serving_time }}"
                        countCompletedTickets="{{ $c_completed_tickets }}"
                        countCancelledTickets="{{ $c_cancelled_tickets }}" avgWaitTime="{{ $avg_wait_time }}" />
                </div>
            </div>
        </section>
    </main>

    {{-- Staff JS --}}
    <script src="{{ asset('assets/js/staff.js') }}"></script>
</x-layout>
