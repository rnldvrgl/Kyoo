const liveQueueChannel = window.Echo.channel("public.live-queue");

liveQueueChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".live-queue", (e) => {
        let ticket = e.queueTicket;

        let ticketDisplay = $("#display-ticket-" + ticket.department_id);

        if (ticket) {
            let ticketHasSomething = `
            <div class="d-flex flex-column align-items-center serving-ticket">
                <h1 class="card-subtitle mb-2" style="font-size: clamp(2rem, 5vw, 3rem);">
                ${ticket.ticket_number}
                </h1>
                <span class="text-primary fw-semibold"
                    style="font-size: clamp(0.8rem, 2vw, 1.2rem);">Currently
                    Serving</span>
            </div>
        `;

            ticketDisplay.html(ticketHasSomething);
        }

        // console.log(ticket.ticket_number);

        console.log(ticket);
    });
