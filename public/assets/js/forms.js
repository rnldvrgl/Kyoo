$(document).ready(function () {
    // Add Account Form
    $("#add-accounts-frm").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-account").attr("disabled", true);
        $("#btn-save-account").html("Saving...");

        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {

                console.log(response);
                
                // If may error
                if (response.code == 400) {
                    
                    // List of errors
                    let errorsHtml = "<ul class='list-unstyled'>";
                    $.each(response.errors, function (key, value) {
                        errorsHtml += "<li>" + value + "</li>";
                    });
                    errorsHtml += "</ul>";

                    // Encase error messages here
                    $("#res").html(
                        '<div class="row alert alert-danger pb-0">' +
                            errorsHtml +
                            "</div>"
                    );

                    $("#btn-save-account").attr("disabled", false);
                    $("#btn-save-account").html("Add Account");
                } 
                // If walang error
                else if (response.code == 200) {

                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save-account").attr("disabled", false);
                    $("#btn-save-account").html("Add Account");

                    // Auto refresh the current page
                    location.reload();
                }
            },
        });
    });

    // Update Account Form
    $("#edit-accounts-frm").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-save").attr("disabled", true);
        $("#btn-save").html("Updating...");
        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                // If may error
                if (response.code == 400) {
                    // List of errors
                    let errorsHtml = "<ul class='list-unstyled'>";
                    $.each(response.errors, function (key, value) {
                        errorsHtml += "<li>" + value + "</li>";
                    });
                    errorsHtml += "</ul>";

                    // Encase error messages here
                    $("#res").html(
                        '<div class="row alert alert-danger pb-0">' +
                            errorsHtml +
                            "</div>"
                    );

                    $("#btn-save").attr("disabled", false);
                    $("#btn-save").html("Update");
                } 
                // If walang error
                else if (response.code == 200) {

                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save").attr("disabled", false);
                    $("#btn-save").html("Update");

                    // Auto refresh the current page
                    location.reload();
                }
            },
        });
    });
});
