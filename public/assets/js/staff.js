$(document).ready(function () {
    // Get all the buttons with the `call-ticket-btn` class
    const callTicketButtons = $(".call-ticket-btn");
    const serveTicketButtons = $(".serve-ticket-btn");
    const cancelTicketButtons = $(".cancel-ticket-btn");
    const completeTicketButtons = $(".complete-ticket-btn");
    const transferTicketButtons = $(".transfer-ticket-btn");
    const requestClearanceButtons = $(".request-clearance-btn");

    // Variables Declaration for TTS, Sound and Video
    const tts = new SpeechSynthesisUtterance();
    tts.lang = "en-US";
    tts.rate = 1;
    const notifAudio = new Audio("/assets/sounds/ascend.mp3");
    notifAudio.muted = true;

    // Text to Speech
    function speak(text) {
        if (!text) return;
        tts.text = text;
        notifAudio.muted = false;
        notifAudio.play();
        setTimeout(() => {
            window.speechSynthesis.speak(tts);
        }, 1500);
    }

    // Call Queue Number
    callTicketButtons.click(function () {
        // Get the ticket ID from the data attribute
        const queueNumber = $(this).data("queue-number");
        const status = $(this).data("status");
        const ticketId = $(this).data("ticket-id");
        const serviceDepartment = $(this).data("servicedepartment");

        speak(
            "Queue Number" +
                queueNumber +
                ", Please proceed to " +
                serviceDepartment +
                "."
        );

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

    // Serve Ticket
    serveTicketButtons.click(function () {
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

    // Cancel Ticket
    cancelTicketButtons.click(function () {
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

    // Complete Ticket
    completeTicketButtons.click(function () {
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

    // Transfer Ticket
    transferTicketButtons.click(function () {
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

    // Request Clearance Ticket
    requestClearanceButtons.click(function () {
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
