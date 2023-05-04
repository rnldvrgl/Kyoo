const pendingTicketsTab = window.Echo.channel("public.new-pending-ticket");

pendingTicketsTab.subscribed((e) => {
    console.log("Subscribed");
});

pendingTicketsTab.listen(".new-pending-ticket", (e) => {
    const ticket = e.queueTicket;
    // console.log(ticket);

    const ticketHasSomething = `
                <div class="my-1">
                    <div class="card rounded-3 shadow-sm w-100 px-4 py-4" id="queue-card-${
                        ticket.id
                    }"
                         style="border-left: 8px solid #E67E22; background-color: #f7f7f7;">
                        <div class="row d-flex justify-content-start">
                            <div class="col-lg-6 mb-4 text-left">
                                <div class="mb-2">
                                    <h3 class="fw-bold text-center mb-0">${
                                        ticket.ticket_number
                                    }</h3>
                                    <small class="text-center d-block">${moment(
                                        ticket.created_at
                                    ).format("YYYY-MM-DD hh:mm:ss A")}</small>
                                </div>
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-0">Student Name:</h6>
                                    <p class="mb-0">${ticket.student_name}</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-0">Department:</h6>
                                    <p class="mb-0">${
                                        ticket.student_department
                                    }</p>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Course:</h6>
                                    <p class="mb-0">${ticket.student_course}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 h-100">
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">Refresh to Access Buttons</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

    const pendingTab =
        ticket.department_id == 1
            ? $(".registrar-pending-tab-1")
            : $(`.regular-staff-pending-tab-${ticket.department_id}`);

    pendingTab.append(ticketHasSomething);
    $(".pending-tickets").html("");
});
