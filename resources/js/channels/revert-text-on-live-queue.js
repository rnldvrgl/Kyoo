const removeFromLiveQueueChannel = window.Echo.channel(
    "public.remove-from-live-queue"
);

removeFromLiveQueueChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".remove-ticket-number-from-live-queue", (e) => {
        let ticket = e.queueTicket;

        let ticketDisplay = $("#display-ticket-" + ticket.department_id);

        let revertToNoTicket = `
        <div class="d-flex flex-column align-items-center">
            <h1 class="card-subtitle mb-2" style="font-size: clamp(2rem, 5vw, 3rem);">No ticket</h1>
            <span class="text-warning fw-semibold" style="font-size: clamp(0.8rem, 2vw, 1.2rem);">Currently Being Served</span>
        </div>
        `;

        ticketDisplay.html(revertToNoTicket);

        console.log(ticket);
    });
