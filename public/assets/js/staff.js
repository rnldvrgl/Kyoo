$(document).ready(function () {
    // Get all the buttons with the `call-ticket-btn` class
    const callTicketButtons = $(".call-ticket-btn");
    const serveTicketButtons = $(".serve-ticket-btn");
    const cancelTicketButtons = $(".cancel-ticket-btn");
    const completeTicketButtons = $(".complete-ticket-btn");
    const transferTicketButtons = $(".transfer-ticket-btn");
    const requestClearanceButtons = $(".request-clearance-btn");
    const clearButton = $(".cleared-btn");
    const notClearButton = $(".not-cleared-btn");
    const resumeWorkButton = $(".resume-work-btn");
    const pauseWorkButton = $(".pause-work-btn");

    let callCount = 0;

    // Variables Declaration for TTS, Sound and Video
    const tts = new SpeechSynthesisUtterance();
    tts.lang = "en-US";
    tts.rate = 1;
    const notifAudio = new Audio("/assets/sounds/ascend.mp3");
    notifAudio.muted = true;

    // Text to Speech
    function speak(text, callback) {
        if (!text) return;
        tts.text = text;
        notifAudio.muted = false;
        notifAudio.play();
        tts.onend = function () {
            if (typeof callback === "function") {
                callback();
            }
        };
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
        const callCountSpan = $("#call-count");
        const firstButton = callTicketButtons.first();
        const account_id = $(this).data("account-id");

        firstButton.attr("disabled", true);
        firstButton.html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Calling ..."
        );

        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        axios
            .put("/tickets/update-status/" + status, {
                ticketId: ticketId,
                account_id: account_id,
            })
            .then(function (response) {
                // console.log(response);
                speak(
                    "Queue Number" +
                        queueNumber +
                        ", Please proceed to " +
                        serviceDepartment +
                        ".",
                    function () {
                        firstButton.attr("disabled", false);
                        firstButton.html(
                            '<i class="fas fa-bullhorn me-2"></i> Call Queue Number'
                        );
                    },
                    callCount++,
                    callCountSpan.html(callCount)
                );
            })
            .catch(function (error) {
                console.log(error);
                firstButton.attr("disabled", false);
                firstButton.html(
                    '<i class="fas fa-bullhorn me-2"></i> Call Queue Number'
                );
            });
    });

    // Serve Ticket
    serveTicketButtons.click(function () {
        // Get the ticket ID from the data attribute
        const status = $(this).data("status");
        const ticketId = $(this).data("ticket-id");
        const account_id = $(this).data("account-id");

        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        axios
            .put("/tickets/update-status/" + status, {
                ticketId: ticketId,
                account_id: account_id,
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
        // Get the ticket ID and status from the data attributes
        const status = $(this).data("status");
        const ticketId = $(this).data("ticket-id");
        const account_id = $(this).data("account-id");

        // Show confirmation dialog with input field for notes
        $.confirm({
            type: "red",
            title: "Cancel Confirmation",
            icon: "fa-solid fa-exclamation-triangle",
            closeIcon: true,
            content:
                '<div class="form-floating mb-3">' +
                '<select id="cancel-reason" class="form-select">' +
                '<option value="Changed plans or priorities">Changed plans or priorities</option>' +
                '<option value="Technical issues">Technical issues</option>' +
                '<option value="Lack of requirements">Lack of requirements</option>' +
                '<option value="Client not present">Client not present</option>' +
                '<option value="Other">Other</option>' +
                "</select>" +
                '<label for="cancel-reason">Reason for Cancelling</label>' +
                "</div>" +
                '<div id="cancel-notes-div" class="form-floating mb-3 d-none">' +
                '<input type="text" id="cancel-notes" class="form-control" placeholder="Reason for Cancelling">' +
                '<label for="cancel-notes">Reason for Cancelling</label>' +
                "</div>" +
                "<p>Are you sure you want to cancel this ticket?</p>",
            theme: "Modern",
            draggable: false,
            typeAnimated: true,
            buttons: {
                confirm: {
                    btnClass: "btn-success",
                    action: function () {
                        // Get the notes from the input field if "Other" is selected
                        const reason = $("#cancel-reason").val();
                        let notes = "";

                        if (reason === "Other") {
                            notes = $("#cancel-notes").val();
                        } else {
                            notes = reason;
                        }

                        // Send PUT request to update ticket status with notes
                        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
                            'meta[name="csrf-token"]'
                        ).attr("content");

                        axios
                            .put("/tickets/update-status/" + status, {
                                ticketId: ticketId,
                                account_id: account_id,
                                notes: notes,
                            })
                            .then(function (response) {
                                console.log(response);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                },
            },
            onContentReady: function () {
                // Show/hide the notes input field based on the selected reason
                $("#cancel-reason").change(function () {
                    if ($(this).val() === "Other") {
                        $("#cancel-notes-div").removeClass("d-none");
                    } else {
                        $("#cancel-notes-div").addClass("d-none");
                    }
                });
            },
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
        const student_name = $(this).data("student-name");
        const student_course = $(this).data("student-course");
        const student_department = $(this).data("student-department");
        const transfer_notes = "Transferred from Registrar";

        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        axios
            .put("/tickets/update-status/" + status, {
                ticketId: ticketId,
                student_name: student_name,
                student_course: student_course,
                student_department: student_department,
                transfer_notes: transfer_notes,
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
        // Get the ticket ID and other data attributes
        const status = $(this).data("status");
        const ticketId = $(this).data("ticket-id");
        const serviceDepartment = $(this).data("servicedepartment");
        const queueNumber = $(this).data("queue-number");

        // Set the CSRF token for AJAX request
        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        // Send an AJAX request to update ticket status
        axios
            .put("/tickets/request-clearance/", {
                ticketId: ticketId,
                clearance_status: "Pending",
                servicedepartment: serviceDepartment,
            })
            .then(function (response) {
                console.log(response);

                // Show a notification that the request is successful
                const notification = `
            <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 start-0 mb-2 ml-2" role="alert" style="z-index: 9999;">
                Clearance request for Queue #${queueNumber} has been sent!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
                $("#notifications").append(notification);

                // Fade out and remove the notification element after 3 seconds
                const notificationElement = $("#notifications .alert").last();
                setTimeout(function () {
                    notificationElement.addClass("fade");
                    setTimeout(function () {
                        notificationElement.remove();
                    }, 300); // Wait for the duration of the fade-out animation (0.3 seconds)
                }, 3000); // 3 seconds
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // * Librarian

    // Clear Clearance
    clearButton.click(function () {
        // Get the ticket ID from the data attribute
        const clearance_status = $(this).data("clearance_status");
        const ticketId = $(this).data("ticket-id");

        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        axios
            .put("/tickets/clearance/update-status/" + clearance_status, {
                ticketId: ticketId,
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // Clear Clearance
    notClearButton.click(function () {
        // Get the ticket ID from the data attribute
        const clearance_status = $(this).data("clearance_status");
        const ticketId = $(this).data("ticket-id");

        $.confirm({
            type: "red",
            title: "Clearance Confirmation",
            content: "Are you sure this student is not cleared?",
            theme: "Modern",
            closeIcon: true,
            draggable: false,
            typeAnimated: true,
            buttons: {
                confirm: {
                    btnClass: "btn-success",
                    text: "Yes",
                    action: function () {
                        // Send PUT request to update ticket status with notes
                        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
                            'meta[name="csrf-token"]'
                        ).attr("content");

                        axios
                            .put(
                                "/tickets/clearance/update-status/" +
                                    clearance_status,
                                {
                                    ticketId: ticketId,
                                }
                            )
                            .then(function (response) {
                                console.log(response);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                },
            },
        });
    });

    // Pause Work
    $(".pause-work-btn").click(function () {
        var btn = $(this);
        var startTime = new Date();

        // Set the CSRF token for AJAX request
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Send a PUT request to the server to update the work status
        $.ajax({
            type: "PUT",
            url: "/account/pause_work/",
            data: { status: "On Break" },
            success: function (response) {
                console.log(response);

                // Update the UI to show the user is on break
                if (btn.hasClass("pause-work-btn")) {
                    btn.removeClass("btn-outline-kyoodarkblue pause-work-btn");
                    btn.addClass("btn-success resume-work-btn paused");
                    btn.html(
                        'Resume Work <i class="fa-solid fa-play ms-2"></i>'
                    );

                    // Show the end shift button
                    $("#end-shift-btn").show();

                    // Hide the pause work button
                    btn.hide();

                    // Calculate the duration of the break and update the UI
                    var duration = new Date() - startTime;
                    var breakDurationLabel = $(
                        '<span class="badge rounded-pill bg-warning"></span>'
                    ).text("On Break for " + formatDuration(duration));
                    breakDurationLabel.insertAfter(btn);

                    // Remove the break duration label after 5 seconds
                    setTimeout(function () {
                        breakDurationLabel.remove();
                    }, 5000);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    // Resume Work
    $(".resume-work-btn").click(function () {
        var btn = $(this);
        var startTime = new Date();

        // Set the CSRF token for AJAX request
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Send a PUT request to the server to update the work status
        $.ajax({
            type: "PUT",
            url: "/account/resume_work/",
            data: { status: "Working" },
            success: function (response) {
                console.log(response);

                // Update the UI to show the user is working
                if (btn.hasClass("resume-work-btn")) {
                    btn.removeClass("btn-success resume-work-btn paused");
                    btn.addClass("btn-outline-kyoodarkblue pause-work-btn");
                    btn.html(
                        'Pause Work <i class="fa-solid fa-circle-pause ms-2"></i>'
                    );

                    // Hide the end shift button
                    $("#end-shift-btn").hide();

                    // Show the pause work button
                    btn.show();

                    // Calculate the duration of the break and update the UI
                    var duration = new Date() - startTime;
                    var breakDurationLabel = $(
                        '<span class="badge rounded-pill bg-warning"></span>'
                    ).text("On Break for " + formatDuration(duration));
                    breakDurationLabel.insertAfter(btn);

                    // Remove the break duration label after 5 seconds
                    setTimeout(function () {
                        breakDurationLabel.remove();
                    }, 5000);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    // Helper function to format the duration in hh:mm:ss format
    function formatDuration(duration) {
        var hours = Math.floor(duration / 3600000);
        var minutes = Math.floor((duration - hours * 3600000) / 60000);
        var seconds = Math.floor(
            (duration - hours * 3600000 - minutes * 60000) / 1000
        );

        return (
            hours.toString().padStart(2, "0") +
            ":" +
            minutes.toString().padStart(2, "0") +
            ":" +
            seconds.toString().padStart(2, "0")
        );
    }
});
