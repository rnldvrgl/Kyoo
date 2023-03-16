<main id="main" class="main px-2">
    <section class="section dashboard">
        <div class="d-flex " style="height: calc(100vh - 10vh);">

            {{-- 1st Column --}}
            <div class="col-auto col-lg-4 px-2">
                {{-- Pending Tickets --}}
                <div class="card border h-100 rounded-lg">
                    <div class="card-header sticky-top bg-kyoodark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold mb-0">Pending Tickets <span class="fw-light">| 4 Ticket(s)</span></h4>
                            <span class="badge bg-warning text-warning rounded-circle p-1">
                                <i class="fa-regular fa-circle"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4" style="overflow-y: scroll; height: calc(100% - 55px);">
                        @foreach ($pendingTickets as $ticket)
                            <x-queue-card id="queue-card-{{ $ticket->id }}" ticketId="{{ $ticket->id }}"
                                queueNumber="{{ $ticket->ticket_number }}"
                                queueTime="{{ $ticket->created_at->format('Y-m-d h:i:s A') }}"
                                studentName="{{ $ticket->student_name }}" department="{{ $ticket->student_department }}"
                                course="{{ $ticket->student_course }}" :services="$ticket->services->pluck('name')->toArray()" />
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 2nd Column --}}
            <div class="col-auto col-lg-5 px-2 d-flex flex-column" style="height: calc(100% - 55px);">
                {{-- Current Serving Ticket --}}
                <div class="card rounded-lg" style="flex: 1;">
                    <div class="col">
                        <div class="card-header bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Current Serving Ticket</h4>
                                <span class="badge bg-info text-info rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body  p-4">
                            <x-current-serving-ticket id="current-ticket-{{ $servingTicket->id }}"
                                ticketId="{{ $servingTicket->id }}" queueNumber="{{ $servingTicket->ticket_number }}"
                                queueTime="{{ $servingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                studentName="{{ $servingTicket->student_name }}"
                                department="{{ $servingTicket->student_department }}"
                                course="{{ $servingTicket->student_course }}" :services="$servingTicket->services->pluck('name')->toArray()" />
                        </div>
                    </div>
                </div>

                {{-- Transferred Tickets --}}
                <div class="card rounded-lg" style="flex: 1;">
                    <div class="col">
                        <div class="card-header bg-kyoodark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0">Transferred Ticket(s)</h4>
                                <span class="badge bg-info text-info rounded-circle p-1">
                                    <i class="fa-regular fa-circle"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4" style="max-height: 300px; overflow-y: auto; ">
                            <div class="col">
                                <div class="d-flex flex-column gap-2">
                                    @foreach ($holdingTickets as $holdingTicket)
                                        <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                            ticketId="{{ $holdingTicket->id }}"
                                            queueNumber="{{ $holdingTicket->ticket_number }}"
                                            queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $holdingTicket->student_name }}"
                                            department="{{ $holdingTicket->student_department }}"
                                            course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                    @endforeach
                                    @foreach ($holdingTickets as $holdingTicket)
                                        <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                            ticketId="{{ $holdingTicket->id }}"
                                            queueNumber="{{ $holdingTicket->ticket_number }}"
                                            queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $holdingTicket->student_name }}"
                                            department="{{ $holdingTicket->student_department }}"
                                            course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                    @endforeach
                                    @foreach ($holdingTickets as $holdingTicket)
                                        <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                            ticketId="{{ $holdingTicket->id }}"
                                            queueNumber="{{ $holdingTicket->ticket_number }}"
                                            queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $holdingTicket->student_name }}"
                                            department="{{ $holdingTicket->student_department }}"
                                            course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                    @endforeach
                                    @foreach ($holdingTickets as $holdingTicket)
                                        <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                            ticketId="{{ $holdingTicket->id }}"
                                            queueNumber="{{ $holdingTicket->ticket_number }}"
                                            queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $holdingTicket->student_name }}"
                                            department="{{ $holdingTicket->student_department }}"
                                            course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                    @endforeach
                                    @foreach ($holdingTickets as $holdingTicket)
                                        <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                            ticketId="{{ $holdingTicket->id }}"
                                            queueNumber="{{ $holdingTicket->ticket_number }}"
                                            queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $holdingTicket->student_name }}"
                                            department="{{ $holdingTicket->student_department }}"
                                            course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                    @endforeach
                                    @foreach ($holdingTickets as $holdingTicket)
                                        <x-hold-ticket id="hold-ticket-{{ $holdingTicket->id }}"
                                            ticketId="{{ $holdingTicket->id }}"
                                            queueNumber="{{ $holdingTicket->ticket_number }}"
                                            queueTime="{{ $holdingTicket->created_at->format('Y-m-d h:i:s A') }}"
                                            studentName="{{ $holdingTicket->student_name }}"
                                            department="{{ $holdingTicket->student_department }}"
                                            course="{{ $holdingTicket->student_course }}" :services="$holdingTicket->services->pluck('name')->toArray()" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            {{-- 3rd Column --}}
            <div class="col-auto col-lg-3 px-2">
                {{-- Staff Actions --}}
                <div class="card rounded-lg">
                    <div class="card-header bg-kyoodark text-white">
                        <h4 class="fw-bold fw-bold mb-0">Staff Actions</h4>
                    </div>
                    <div class="card-body py-3">
                        <div class="row g-3  text-center">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-danger">End Shift <i
                                        class="fa-solid fa-door-closed ms-2"></i></button>
                                <button class="btn btn-outline-primary pause-work-btn">Pause Work <i
                                        class="fa-solid fa-circle-pause ms-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Staff Serving Stats --}}
                <div class="card rounded-lg">
                    <div class="card-header bg-kyoodark text-white">
                        <h4 class="fw-bold fw-bold mb-0">Serving Stats</h4>
                    </div>
                    <div class="card-body py-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-lg">
                                    <h5 class="card-subtitle mb-3">Average Service Time</h5>
                                    <p class="card-text display-6 fw-bold mb-0">25<span class="fs-5"> min</span></p>
                                    <p class="card-text text-muted mt-1">Based on last 30 served
                                        tickets</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border  rounded-lg">
                                    <h5 class="card-subtitle mb-3">Total Served Tickets</h5>
                                    <p class="card-text display-6 fw-bold mb-0">342</p>
                                    <p class="card-text text-muted mt-1">Including all services</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-lg">
                                    <h5 class="card-subtitle mb-3">Average Wait Time</h5>
                                    <p class="card-text display-6 fw-bold mb-0">10<span class="fs-5"> min</span></p>
                                    <p class="card-text text-muted mt-1">Based on last 30 served
                                        tickets</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center h-100 p-4 bg-light border rounded-lg">
                                    <h5 class="card-subtitle mb-3">Total Rejected Tickets</h5>
                                    <p class="card-text display-6 fw-bold mb-0">4</p>
                                    <p class="card-text text-muted mt-1">Including all services</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
