const liveQueueChannel = window.Echo.channel("public.live-queue");

liveQueueChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".live-queue", (e) => {
        let tickets = e.queueTickets;

        let ticketDisplay = $("#tickets-table");

        let ticketHTML = "";

        tickets.forEach((ticket) => {
            let ticketHasSomething = `
                <div class="card shadow-none mb-2 py-3 rounded-5 ${
                    ticket.ticket_status === "Calling"
                        ? "flicker bg-pastel-blue"
                        : ""
                } border"
                    data-aos="slide-right">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-5 d-flex justify-content-start align-items-center">
                                <h5 class="mb-0 fw-semibold ">${
                                    ticket.department_name
                                }</h5>
                            </div>
                            <div class="col-5 d-flex justify-content-start align-items-center">
                                <h5 class="text-kyoodark fw-bold mb-0 ${
                                    ticket.ticket_status === "Calling"
                                        ? "flicker"
                                        : ""
                                }">
                                    ${ticket.ticket_number}</h5>
                            </div>
                            <div class="col-2 d-flex justify-content-start align-items-center">
                                <span
                                    class="badge rounded-pill
                                    ${
                                        ticket.ticket_status === "Pending"
                                            ? "bg-warning"
                                            : ticket.ticket_status === "Calling"
                                            ? "bg-primary"
                                            : ticket.ticket_status === "Serving"
                                            ? "bg-info"
                                            : ticket.ticket_status === "On Hold"
                                            ? "bg-success"
                                            : ticket.ticket_status ===
                                              "Complete"
                                            ? "bg-danger"
                                            : ticket.ticket_status ===
                                              "Cancelled"
                                            ? "bg-danger"
                                            : ""
                                    }">
                                    ${ticket.ticket_status}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            ticketHTML += ticketHasSomething;
        });

        ticketDisplay.html(ticketHTML);

        // console.log(tickets);
    });
