$(document).ready(function () {
    // Export Ticket Form
    $("#export-librarian-ticket").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-submit-filter").attr("disabled", true);
        $("#btn-submit-filter").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Filtering ..."
        );
        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: (response) => {
                if (response != null) {
                    let success =
                        '<div class="alert alert-success">Excel has been downloaded!</div>';

                    $("#res").html(success);
                } else {
                    let error =
                        '<div class="alert alert-danger">' +
                        response.msg +
                        "</div>";

                    $("#res").html(error);
                }

                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html(
                    'Filter <i class="fa-solid fa-filter"></i>'
                );
            },
            error: (xhr, status, error) => {
                // handle error response
                $("#res").html(
                    '<div class="row alert alert-danger">' +
                        "An error occurred performing the filter. Please try again later." +
                        "</div>"
                );
                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html("Filter");
            },
        });
    });
});
