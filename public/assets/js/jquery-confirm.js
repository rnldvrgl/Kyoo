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

    // Delete Account
    $('#accounts-table').on('click', '.delete-account', function (){

        var id = $(this).data('account-id');

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
                    btnClass: "btn-danger",
                    action: function () {

                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                        });
    
                        // AJAX
                        $.ajax({
                            url: 'delete-account/' + id,
                            type: 'DELETE',
                            success: function (response) {

                                // If may error
                                if (response.code == 400) {
                                    // List of errors
                                    let errorsHtml = "<ul class='list-unstyled'>";
                                        errorsHtml += "<li>" + response.message + "</li>";
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
                                    }, 3000);
                                }
                            },
                            error: function (xhr) {
                                console.log('Failed to delete record.');
                            }
                        });
                    },
                },
                close: function () {},
            },
        });
    })
});