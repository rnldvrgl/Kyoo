$(document).ready(function () {
    // Handle "Queue Now" button click
    $("#queue-now").on("click", function () {
        // Send AJAX request to server to queue the user
        $.ajax({
            url: "/queue",
            method: "POST",
            data: {
                /* Insert form data here */
            },
            success: function (response) {
                // Redirect to next page after successful queue
                window.location.href = "/select-department";
            },
            error: function () {
                // Handle error case
            },
        });
    });

    // Handle "Back" button click
    $("#go-back").on("click", function () {
        // Go back to previous page in browser history
        window.history.back();
    });
});
