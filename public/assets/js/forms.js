$(document).ready(function () {
    // Send Feedback Form
    $("#send-feedback-frm").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-send-feedback").attr("disabled", true);
        $("#btn-send-feedback").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Sending ..."
        );

        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
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

                    $("#btn-send-feedback").attr("disabled", false);
                    $("#btn-send-feedback").html(
                        'Send Feedback <i class="fa-solid fa-paper-plane ms-3"></i>'
                    );
                }
                // If walang error
                else if (response.code == 200) {
                    $("#fullname").attr("disabled", true);
                    $("#feedback-message").attr("disabled", true);
                    $("#btn-send-feedback").html(
                        'Feedback Sent <i class="fa-regular fa-circle-check fa-xl fa-beat" style="--fa-animation-duration: 2s;"></i>'
                    );

                    // Clear input fields
                    $("#send-feedback-frm")[0].reset();
                }
            },
            error: (xhr, status, error) => {
                // handle error response
                $("#res").html(
                    '<div class="row alert alert-danger">' +
                        "An error occurred while sending feedback. Please try again later." +
                        "</div>"
                );
                $("#btn-send-feedback").attr("disabled", false);
                $("#btn-send-feedback").html("Send Feedback");
            },
        });
    });

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
        $("#btn-save-account").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Saving..."
        );

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
        $("#btn-save").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Updating..."
        );
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
        $("#btn-save-department").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Saving..."
        );

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
        $("#btn-update-department").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Updating..."
        );
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

    // Add FAQs Form
    $("#add-faqs-frm").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-faq").attr("disabled", true);
        $("#btn-save-faq").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Saving..."
        );

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

                    $("#btn-save-faq").attr("disabled", false);
                    $("#btn-save-faq").html("Add FAQ");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save-faq").attr("disabled", false);
                    $("#btn-save-faq").html("Add FAQ");

                    // Auto refresh the current page
                    setTimeout(function () {
                        window.location.href = "edit-frequent-question";
                    }, 1000);
                }
            },
        });
    });

    // Update FAQs Form
    $("#edit-faqs-frm").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-update-faq").attr("disabled", true);
        $("#btn-update-faq").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Updating..."
        );
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

                    $("#btn-update-faq").attr("disabled", false);
                    $("#btn-update-faq").html("Update");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-update-faq").attr("disabled", false);
                    $("#btn-update-faq").html("Update");

                    // Auto refresh the current page
                    setTimeout(function () {
                        window.location.href = "edit-frequent-question";
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
        $("#btn-save-service").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Saving..."
        );

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
                    $("#btn-save-service").html("Add Service");
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

    // Add Service Modal Form (Mobile View)
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
        $("#btn-save-service-modal").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Saving..."
        );

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
                    $("#btn-save-service-modal").html("Add Service");
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

    // Add Service Form from Service List
    $("#add-services-from-list-frm").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-service-from-list").attr("disabled", true);
        $("#btn-save-service-from-list").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Saving..."
        );

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

                    $("#btn-save-service-from-list").attr("disabled", false);
                    $("#btn-save-service-from-list").html("Add Service");
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res").html(success);
                    $("#btn-save-service-from-list").attr("disabled", false);
                    $("#btn-save-service-from-list").html("Add Service");

                    // Clear input fields
                    $("#add-services-from-list-frm")[0].reset();

                    // Auto refresh the current page
                    // Reload the page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
        });
    });

    // Add Video Form
    $("#add-video-frm").submit(function (e) {
        e.preventDefault();

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#btn-save-video").attr("disabled", true);
        $("#btn-save-video").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Uploading ..."
        );

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

                    $("#btn-save-video").attr("disabled", false);
                    $("#btn-save-video").html(
                        'Upload <i class="fa-solid fa-upload ms-2"></i>'
                    );
                }
                // If walang error
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res-modal").html(success);
                    $("#btn-save-video").attr("disabled", false);
                    $("#btn-save-video").html(
                        'Upload <i class="fa-solid fa-upload ms-2"></i>'
                    );

                    // Auto refresh the current page
                    // Reload the page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
        });
    });

    // Update Message Form
    $("#update-message-frm").submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize the formData
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Get the CSRF token from the meta tag
            },
        });

        $("#btn-save-message").attr("disabled", true); // Disable the submit button
        $("#btn-save-message").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Updating ..."
        ); // Change the text of the submit button

        // Send an AJAX request to the server
        $.ajax({
            type: "POST",
            url: this.action, // Get the form action attribute as the URL
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                // If there are errors
                if (response.code == 400) {
                    // List of errors
                    let errorsHtml = "<ul class='list-unstyled'>";
                    $.each(response.errors, function (key, value) {
                        errorsHtml += "<li>" + value + "</li>";
                    });
                    errorsHtml += "</ul>";

                    // Encase error messages here
                    $("#res-message").html(
                        '<div class="alert alert-danger pb-0">' +
                            errorsHtml +
                            "</div>"
                    );

                    $("#btn-save-message").attr("disabled", false); // Enable the submit button
                    $("#btn-save-message").html(
                        'Save Promotional Message <i class="fa-solid fa-floppy-disk ms-2"></i>'
                    ); // Change the text of the submit button
                }
                // If there are no errors
                else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";

                    $("#res-message").html(success); // Encase success message here
                    $("#btn-save-message").attr("disabled", false); // Enable the submit button
                    $("#btn-save-message").html(
                        'Save Promotional Message <i class="fa-solid fa-floppy-disk ms-2"></i>'
                    ); // Change the text of the submit button

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
