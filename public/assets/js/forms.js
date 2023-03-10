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
                    setTimeout(function () {
                        window.location.href = "edit-account";
                    }, 1000);
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
                    setTimeout(function () {
                        window.location.href = "edit-account";
                    }, 1000);
                }
            },
        });
    });

    // Add Department Form
    $("#add-departments-frm").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-department").attr("disabled", true);
        $("#btn-save-department").html("Saving...");

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

                    $("#btn-save-department").attr("disabled", false);
                    $("#btn-save-department").html("Add Department");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save-department").attr("disabled", false);
                    $("#btn-save-department").html("Add Department");

                    // Auto refresh the current page
                    setTimeout(function () {
                        window.location.href = "edit-department";
                    }, 1000);
                }
            },
        });
    });

    // Update Department Form
    $("#edit-departments-frm").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-update-department").attr("disabled", true);
        $("#btn-update-department").html("Updating...");
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

                    $("#btn-update-department").attr("disabled", false);
                    $("#btn-update-department").html("Update");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-update-department").attr("disabled", false);
                    $("#btn-update-department").html("Update");

                    // Auto refresh the current page
                    setTimeout(function () {
                        window.location.href = "edit-department";
                    }, 1000);
                }
            },
        });
    });

    // Add Service Form
    $("#add-services-frm").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-service").attr("disabled", true);
        $("#btn-save-service").html("Saving...");

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

                    $("#btn-save-service").attr("disabled", false);
                    $("#btn-save-service").html("Add Department");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save-service").attr("disabled", false);
                    $("#btn-save-service").html("Add Service");

                    // Clear input fields
                    $("#add-services-frm")[0].reset();

                    // Auto refresh the current page
                    // Reload the page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
        });
    });

    // Add Service Modal Form
    $("#add-services-frm-modal").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-service-modal").attr("disabled", true);
        $("#btn-save-service-modal").html("Saving...");

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
                    $("#res-modal").html(
                        '<div class="row alert alert-danger pb-0">' +
                            errorsHtml +
                            "</div>"
                    );

                    $("#btn-save-service-modal").attr("disabled", false);
                    $("#btn-save-service-modal").html("Add Department");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save-service-modal").attr("disabled", false);
                    $("#btn-save-service-modal").html("Add Service");

                    // Clear input fields
                    $("#add-services-frm-modal")[0].reset();

                    // Auto refresh the current page
                    // Reload the page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
        });
    });
});
