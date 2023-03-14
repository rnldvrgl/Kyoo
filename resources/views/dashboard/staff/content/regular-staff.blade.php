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
                            {{-- @foreach ($pendingTickets as $ticket)
                                <x-queue-card queueNumber="{{ $ticket->queueNumber }}"
                                    queueTime="{{ $ticket->queueTime }}" studentName="{{ $ticket->studentName }}"
                                    department="{{ $ticket->department }}" course="{{ $ticket->course }}"
                                    :services="{{ $ticket->services }}" />
                            @endforeach --}}
                            <x-queue-card queueNumber="R001" queueTime="Mar-14-23 09:59:01 PM"
                                studentName="Ronald Vergel Dela Cruz" department="College" course="BSIT"
                                :services="['Request Document', 'Add Subject']" />

                            <x-queue-card queueNumber="R002" queueTime="Mar-14-23 10:32:57 PM"
                                studentName="Mark Lewence Endrano" department="College" course="BSA"
                                :services="['Add Subject']" />

                            <x-queue-card queueNumber="R003" queueTime="Mar-14-23 10:45:21 PM"
                                studentName="Juan Dela Cruz" department="SHS" course="ABM" :services="['Request Document']" />


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
