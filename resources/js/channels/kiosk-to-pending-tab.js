const pendingTicketsTab = window.Echo.channel("public.new-pending-ticket");

pendingTicketsTab
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".new-pending-ticket", (e) => {
        let ticket = e.queueTicket;

        console.log(ticket);

        // Div where I will append ticketHasSomething
        let registrarPendingTab = $(
            ".registrar-pending-tab-" + ticket.department_id
        );
        let regularStaffPendingTab = $(
            ".regular-staff-pending-tab-" + ticket.department_id
        );

        // Content of each card
        let rowID = ticket.id;
        let department_id = ticket.department_id;
        let ticketID = ticket.ticket_number;
        let createdAt = moment(ticket.created_at).format("Y-m-d h:i:s A");
        let studentName = ticket.student_name;
        let department = ticket.student_department;
        let course = ticket.student_course;

        // let servicedepartment = ;
        let clearanceStatus = ticket.clearance_status;

        if (ticket) {
            let ticketHasSomething = `
            <div class="my-1">
                <div class="card rounded-3 shadow-sm w-100 px-4 py-4" id="queue-card-${rowID}" style="border-left: 8px solid #E67E22; background-color: #f7f7f7;">
                    <div class="row d-flex justify-content-evenly">
                        <div class="col-lg-6 mb-4 text-left">
                            <div class="mb-2">
                                <h3 class="fw-bold text-center mb-0">${ticketID}</h3>
                                <small class="text-center d-block">${createdAt}</small>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-0">Student Name:</h6>
                                <p class="mb-0">${studentName}</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-0">Department:</h6>
                                <p class="mb-0">${department}</p>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Course:</h6>
                                <p class="mb-0">${course}</p>
                            </div>
                            <div class="mb-2">
                                <p class="fw-bold text-center mb-0 text-kyoored">Refresh to see function buttons</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;

            // <button class="btn btn-outline-kyoored rounded-pill py-2 btn-sm refresh-btn">Refresh</button>

            if (ticket.department_id == 1) {
                registrarPendingTab.append(ticketHasSomething);
                $(".pending-tickets").html("");
            } else {
                regularStaffPendingTab.append(ticketHasSomething);
                $(".pending-tickets").html("");
            }
        }
    });
