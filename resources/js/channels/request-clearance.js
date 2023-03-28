const requestClearanceChannel = window.Echo.channel("public.request-clearance");

requestClearanceChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".request-clearance", (e) => {
        const ticket = e.queueTicket;

        let c_clearance = $(".c-pending-clearance");
        let hs_clearance = $(".hs-pending-clearance");

        if (ticket) {
            let ticketHasSomething = `
                    <div class="my-1">
                        <div class="card rounded-5 shadow w-100 px-4 py-4" style="border-left: 8px solid #E67E22; background-color: #f7f7f7;">
                            <div class="card-body">
                                <h5 class="card-title pb-2 fw-bold">Student Information</h5>
                                <table class="table table-hover align-middle mb-4">
                                    <tr>
                                        <th scope="row">Student Name:</th>
                                        <td>${ticket.student_name}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Department:</th>
                                        <td>${ticket.student_department}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Course:</th>
                                        <td>${ticket.student_course}</td>
                                    </tr>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success cleared-btn me-2" type="button" data-queue-number="${ticket.ticket_number}"
                                        data-ticket-id="${ticket.id}" data-clearance_status="Cleared">
                                        <i class="fas fa-check-circle me-2" aria-hidden="true"></i> Cleared
                                    </button>
                                    <button class="btn btn-outline-danger not-cleared-btn" type="button"
                                        data-queue-number="${ticket.ticket_number}" data-ticket-id="${ticket.id}"
                                        data-clearance_status="Not Cleared">
                                        <i class="fas fa-times-circle me-2" aria-hidden="true"></i> Not Cleared
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

            if (
                ticket.student_department == "College" ||
                ticket.student_department == "Graduate School"
            ) {
                c_clearance.append(ticketHasSomething);
            } else if (
                ticket.student_department == "Senior High School" ||
                ticket.student_department == "Junior High School"
            ) {
                hs_clearance.append(ticketHasSomething);
            }
        }

        console.log(e);
    });
