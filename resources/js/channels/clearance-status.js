const clearanceStatusChannel = window.Echo.channel("public.clearance-status");

clearanceStatusChannel
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".clearance-status", (e) => {
        let ticket = e.queueTicket;

        let clearanceStatusDisplay = $("#clearance-status-" + ticket.id);

        if (ticket.clearance_status == "Cleared") {
            clearanceStatusDisplay.removeClass("bg-kyooorange");
            clearanceStatusDisplay.addClass("bg-success");
            clearanceStatusDisplay.html(`
                <i class="fas fa-check-circle me-2"></i>
                Clearance Cleared
            `);
        } else if (ticket.clearance_status == "Not Cleared") {
            clearanceStatusDisplay.removeClass("bg-kyooorange");
            clearanceStatusDisplay.addClass("bg-kyoored");
            clearanceStatusDisplay.html(`
                <i class="fas fa-exclamation-circle me-2"></i>
                Clearance Not Cleared
            `);
        }

        console.log(ticket);
    });
