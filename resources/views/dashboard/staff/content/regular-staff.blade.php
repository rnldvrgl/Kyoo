<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active">Regular</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Current Serving</h5>
                            <div class="mb-2">
                                <h3 class="fw-bold text-center mb-0">R004</h3>
                                <small class="text-center text-muted d-block">Mar-14-23 11:05:39 PM</small>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-0">Student Name</h6>
                                <p class="text-muted mb-0">Maria Santos</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-0">Department</h6>
                                <p class="text-muted mb-0">SHS</p>
                            </div>
                            <div class="">
                                <h6 class="fw-bold mb-0">Course</h6>
                                <p class="text-muted mb-0">GAS</p>
                            </div>
                            <div class="px-3 mt-3">
                                <button class="btn btn-primary rounded-sm px-2 py-1" type="button">
                                    <i class="fas fa-check-circle me-1"></i> Complete
                                </button>

                                <button class="btn btn-outline-secondary rounded-sm px-2 py-1" type="button">
                                    <i class="fas fa-times-circle me-1"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending Tickets</h5>
                            {{-- {{ dd($pendingTickets) }} --}}
                            @foreach ($pendingTickets as $ticket)
                                <x-queue-card id="queue-card-{{ $ticket->id }}" ticketId="{{ $ticket->id }}"
                                    queueNumber="{{ $ticket->ticket_number }}" queueTime="{{ $ticket->created_at }}"
                                    studentName="{{ $ticket->student_name }}"
                                    department="{{ $ticket->student_department }}"
                                    course="{{ $ticket->student_course }}" :services="$ticket->services->pluck('name')->toArray()" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
