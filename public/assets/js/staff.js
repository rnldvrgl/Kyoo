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
    const resumeWorkButton = $("#resume-work-btn");
    const pauseWorkButton = $("#pause-work-btn");
    const endShiftButton = $("#end-shift-btn");

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
    $(document).on("click", ".call-ticket-btn", function () {
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
    $(document).on("click", ".serve-ticket-btn", function () {
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

                // Auto Refresh Page
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // Cancel Ticket
    $(document).on("click", ".cancel-ticket-btn", function () {
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

                                // Auto Refresh Page
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
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

                // Auto Refresh Page
                location.reload();
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
        const notes = "Transferred from Registrar";

        $.confirm({
            type: "green",
            title: "Transfer Confirmation",
            icon: "fa-solid fa-credit-card",
            closeIcon: true,
            content:
                '<div class="form-floating mb-3">' +
                '<div id="transfer-notes-div" class="form-floating mb-3">' +
                '<input type="text" id="transfer-notes" class="form-control" placeholder="Note for Transferring">' +
                '<label for="transfer-notes">Note for Transferring</label>' +
                "</div>" +
                "<p>Are you sure you want to transfer this ticket?</p>",
            theme: "Modern",
            draggable: false,
            typeAnimated: true,
            buttons: {
                confirm: {
                    btnClass: "btn-success",
                    action: function () {
                        // Get the notes from the input field if "Other" is selected
                        const transfer_notes = $("#transfer-notes").val();

                        // Send PUT request to update ticket status with notes
                        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
                            'meta[name="csrf-token"]'
                        ).attr("content");

                        axios
                            .put("/tickets/update-status/" + status, {
                                ticketId: ticketId,
                                notes: notes,
                                ticketId: ticketId,
                                student_name: student_name,
                                student_course: student_course,
                                student_department: student_department,
                                transfer_notes: transfer_notes,
                                notes: notes,
                            })
                            .then(function (response) {
                                console.log(response);

                                // Auto Refresh Page
                                location.reload();
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                },
            },
        });
    });

    // Request Clearance Ticket
    $(document).on("click", ".request-clearance-btn", function () {
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

                // Auto Refresh Page
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // * Librarian

    // Clear Clearance
    $(document).on("click", ".cleared-btn", function () {
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

                // Auto Refresh Page
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
            });
    });

    // Clear Clearance
    $(document).on("click", ".not-cleared-btn", function () {
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

                                // Auto Refresh Page
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
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
    pauseWorkButton.click(function () {
        // Set the CSRF token for AJAX request
        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        // Send a POST request to the server to update the work status
        axios
            .post("/update-work-session", {
                status: "On Break",
            })
            .then(function (response) {
                pauseTimer();
                pauseWorkButton.addClass("d-none");
                resumeWorkButton.removeClass("d-none");
                $("#action-header").removeClass("bg-success");
                $("#action-header").addClass("bg-secondary");
            })
            .catch(function (error) {
                console.error(error);
            });
    });

    // Resume Work
    resumeWorkButton.click(function () {
        // Set the CSRF token for AJAX request
        axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
            'meta[name="csrf-token"]'
        ).attr("content");

        // Send a POST request to the server to update the work status
        axios
            .post("/update-work-session", {
                status: "Logged In",
            })
            .then(function (response) {
                resumeTimer();
                pauseWorkButton.removeClass("d-none");
                resumeWorkButton.addClass("d-none");
                $("#action-header").addClass("bg-success");
                $("#action-header").removeClass("bg-secondary");
            })
            .catch(function (error) {
                console.error(error);
            });
    });

    // ! TO DO
    // End Shift
    endShiftButton.confirm({
        title: "End Shift Confirmation",
        content: "Are you sure you want to end your shift?",
        theme: "Modern",
        draggable: false,
        typeAnimated: true,
        buttons: {
            confirm: {
                text: "Yes",
                btnClass: "btn-success rounded-pill",
                action: function () {
                    logout();
                    location.href = this.$target.attr("href");
                },
            },
            cancel: {
                text: "No",
                btnClass: "btn-outline-kyoored rounded-pill",
            },
        },
    });

    var startTime;
    var elapsed = localStorage.getItem("work_elapsed")
        ? parseInt(localStorage.getItem("work_elapsed"))
        : 0;
    var status = localStorage.getItem("work_status")
        ? localStorage.getItem("work_status")
        : "Logged In";
    var intervalId;

    console.log("elapsed: " + elapsed, "status: " + status);

    function startTimer() {
        startTime = Date.now() - elapsed;
        intervalId = setInterval(updateTimer, 1000);
    }

    function updateTimer() {
        elapsed = Date.now() - startTime;
        var formattedTime = new Date(elapsed).toISOString().substr(11, 8);
        document.getElementById("work-timer").textContent = formattedTime;

        // Store the elapsed time in localStorage
        localStorage.setItem("work_elapsed", elapsed);
    }

    function pauseTimer() {
        clearInterval(intervalId);
        status = "On Break";
        localStorage.setItem("work_status", status);
        console.log("elapsed: " + elapsed, "status: " + status);
    }

    function resumeTimer() {
        startTimer();
        status = "Logged In";
        localStorage.setItem("work_status", status);
        console.log("elapsed: " + elapsed, "status: " + status);
    }

    if (status == "Logged In") {
        startTimer();
    } else if (status == "On Break") {
        var formattedTime = new Date(elapsed).toISOString().substr(11, 8);
        document.getElementById("work-timer").textContent = formattedTime;
    }

    // Logout Confirmation
    $("#logout_account").confirm({
        title: "Logout Confirmation",
        content: "Are you sure you want to log out?",
        theme: "Modern",
        draggable: false,
        typeAnimated: true,
        buttons: {
            confirm: {
                text: "Yes",
                btnClass: "btn-success rounded-pill",
                action: function () {
                    logout();
                    location.href = this.$target.attr("href");
                },
            },
            cancel: {
                text: "No",
                btnClass: "btn-outline-kyoored rounded-pill",
            },
        },
    });

    function logout() {
        clearInterval(intervalId);
        status = null;
        elapsed = null;
        localStorage.clear();
    }

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
