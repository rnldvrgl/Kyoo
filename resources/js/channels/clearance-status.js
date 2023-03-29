const clearanceStatusChannel = window.Echo.channel("public.clearance-status");

clearanceStatusChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".clearance-status", (e) => {
        let ticket = e.queueTicket;

        let clearanceStatusDisplay = $("#clearance-status-" + ticket.id);

        if (ticket.clearance_status == "Cleared") {
            clearanceStatusDisplay.html(`
            <span class="badge bg-success rounded-pill py-3">
                <i class="fas fa-check-circle me-2"></i>
                Clearance Cleared
            </span>
            `);
        } else if (ticket.clearance_status == "Not Cleared") {
            clearanceStatusDisplay.html(`
            <span class="badge bg-kyoored rounded-pill py-3">
                <i class="fas fa-exclamation-circle me-2"></i>
                Clearance Not Cleared
            </span>
            `);
        }

        console.log(ticket);
    });
