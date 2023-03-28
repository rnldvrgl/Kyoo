$(document).ready(function () {
    //* Kiosk *//
    // Cancel Queue
    $("button#cancel_queue").confirm({
        title: "Cancel Queue Confirmation",
        content: "Are you sure you want to cancel your queue ?",
        theme: "Modern",
        draggable: false,
        typeAnimated: true,
        buttons: {
            confirm: {
                text: "Yes",
                btnClass: "btn-kyoodark",
                action: function () {
                    location.href = this.$target.attr("href");
                },
            },
            cancel: {
                text: "No",
                btnClass: "btn-kyoored",
            },
        },
    });

    // Confirmation to Queue Now
    $("#queue_now").click(function (e) {
        e.preventDefault(); // prevent default form submission behavior

        $.confirm({
            title: "Confirmation",
            content: "Are you sure you want to queue now?",
            type: "green",
            icon: "fa fa-question",
            theme: "modern",
            buttons: {
                confirm: {
                    text: "Yes",
                    btnClass: "btn-success rounded-pill",
                    action: function () {
                        $("#input-information-frm").submit(); // submit the form
                    },
                },
                cancel: {
                    text: "No",
                    btnClass: "btn-outline-kyoored rounded-pill",
                    action: function () {
                        // do nothing
                    },
                },
            },
        });
    });

    //* User Profile *//
    // Preview Profile Image
    $("#profile-picture").click(function () {
        $("#preview-image").attr("src", $(this).attr("src"));
        $("#preview-modal").modal("show");
    });

    // Logout Confirmation
    $("button#logout_account").confirm({
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
                    location.href = this.$target.attr("href");
                },
            },
            cancel: {
                text: "No",
                btnClass: "btn-outline-kyoored rounded-pill",
            },
        },
    });

    // Delete Account
    $("#accounts-table").on("click", ".delete-account", function () {
        var id = $(this).data("account-id");

        $.confirm({
            type: "red",
            title: "Delete record?",
            icon: "fa-solid fa-trash-can",
            content: "Are you sure, you want to delete this record?",
            theme: "Modern",
            draggable: false,
            typeAnimated: true,
            buttons: {
                Delete: {
                    text: "Delete",
                    btnClass: "btn-kyoored rounded-pill",
                    action: function () {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                        });

                        // AJAX
                        $.ajax({
                            url: "delete-account/" + id,
                            type: "DELETE",
                            success: function (response) {
                                // If may error
                                if (response.code == 400) {
                                    // List of errors
                                    let errorsHtml =
                                        "<ul class='list-unstyled'>";
                                    errorsHtml +=
                                        "<li>" + response.message + "</li>";
                                    errorsHtml += "</ul>";

                                    // Encase error messages here
                                    $("#res").html(
                                        '<div class="row alert alert-danger pb-0">' +
                                            errorsHtml +
                                            "</div>"
                                    );
                                }
                                // If walang error
                                else if (response.code == 200) {
                                    console.log(response.message);

                                    let success =
                                        '<div class="alert alert-success">' +
                                        response.message +
                                        "</div>";

                                    $("#res").html(success);

                                    // Auto refresh the current page
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }
                            },
                            error: function (xhr) {
                                console.log("Failed to delete record.");
                            },
                        });
                    },
                },
                close: function () {},
            },
        });
    });

    // Delete Department
    $("#departments-table").on("click", ".delete-department", function () {
        var id = $(this).data("department-id");

        $.confirm({
            type: "red",
            title: "Delete record?",
            icon: "fa-solid fa-trash-can",
            content: "Are you sure, you want to delete this record?",
            theme: "Modern",
            draggable: false,
            typeAnimated: true,
            buttons: {
                Delete: {
                    text: "Delete",
                    btnClass: "btn-kyoored rounded-pill",
                    action: function () {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                        });

                        // AJAX
                        $.ajax({
                            url: "delete-department/" + id,
                            type: "DELETE",
                            success: function (response) {
                                // If may error
                                if (response.code == 400) {
                                    // List of errors
                                    let errorsHtml =
                                        "<ul class='list-unstyled'>";
                                    errorsHtml +=
                                        "<li>" + response.message + "</li>";
                                    errorsHtml += "</ul>";

                                    // Encase error messages here
                                    $("#res").html(
                                        '<div class="row alert alert-danger pb-0">' +
                                            errorsHtml +
                                            "</div>"
                                    );
                                }
                                // If walang error
                                else if (response.code == 200) {
                                    let success =
                                        '<div class="alert alert-success">' +
                                        response.message +
                                        "</div>";

                                    $("#res").html(success);

                                    // Auto refresh the current page
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }
                            },
                            error: function (xhr) {
                                console.log("Failed to delete record.");
                            },
                        });
                    },
                },
                close: function () {},
            },
        });
    });

    // ! Delete FAQ
    $("#faqs-table").on("click", ".delete-faq", function () {
        var id = $(this).data("faq-id");

        $.confirm({
            type: "red",
            title: "Delete record?",
            icon: "fa-solid fa-trash-can",
            content: "Are you sure, you want to delete this record?",
            theme: "Modern",
            draggable: false,
            typeAnimated: true,
            buttons: {
                Delete: {
                    text: "Delete",
                    btnClass: "btn-kyoored rounded-pill",
                    action: function () {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                        });

                        // AJAX
                        $.ajax({
                            url: "delete-frequent-question/" + id,
                            type: "DELETE",
                            success: function (response) {
                                // If may error
                                if (response.code == 400) {
                                    // List of errors
                                    let errorsHtml =
                                        "<ul class='list-unstyled'>";
                                    errorsHtml +=
                                        "<li>" + response.message + "</li>";
                                    errorsHtml += "</ul>";

                                    // Encase error messages here
                                    $("#res").html(
                                        '<div class="row alert alert-danger pb-0">' +
                                            errorsHtml +
                                            "</div>"
                                    );
                                }
                                // If walang error
                                else if (response.code == 200) {
                                    let success =
                                        '<div class="alert alert-success">' +
                                        response.message +
                                        "</div>";

                                    $("#res").html(success);

                                    // Auto refresh the current page
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }
                            },
                            error: function (xhr) {
                                console.log("Failed to delete record.");
                            },
                        });
                    },
                },
                close: function () {},
            },
        });
    });
});
