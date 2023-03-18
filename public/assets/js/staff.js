$(document).ready(function () {
    // Get all the buttons with the `call-ticket-btn` class
    const callTicketButtons = $(".call-ticket-btn");

    // Add a click event listener to each button
    callTicketButtons.click(function () {
        // Get the ticket ID from the data attribute
        const status = $(this).data("status");
        const ticketId = $(this).data("ticket-id");

        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        axios
            .put("/tickets/update-status/" + status, {
                ticketId: ticketId,
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // Pause Work
    $(".pause-work-btn").on("click", function () {
        var btn = $(this);
        if (btn.hasClass("paused")) {
            btn.removeClass("btn-success");
            btn.removeClass("paused");
            btn.addClass("btn-primary");
            btn.html(
                'Pause Work <i class="fa-solid fa-circle-pause ms-2"></i>'
            );
            // Resume work functionality here
        } else {
            btn.removeClass("btn-primary");
            btn.addClass("btn-success paused");
            btn.html('Resume Work <i class="fa-solid fa-play ms-2"></i>');
            // Pause work functionality here
        }
    });
});
