$(document).ready(function () {
    // image preview
    $("#profile_image").change(function () {
        let reader = new FileReader();

        reader.onload = (e) => {
            $("#image_preview_container").attr("src", e.target.result);
            $("#preview_image").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    $("#profile_setup_frm").submit(function (e) {
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
                if (response.code == 400) {
                    let errorsHtml = "<ul class='list-unstyled'>";
                    $.each(response.errors, function (key, value) {
                        errorsHtml += "<li>" + value + "</li>";
                    });
                    errorsHtml += "</ul>";
                    $("#res").html(
                        '<div class="row alert alert-danger pb-0">' +
                            errorsHtml +
                            "</div>"
                    );
                    $("#btn-save").attr("disabled", false);
                    $("#btn-save").html("Save Profile");
                } else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";
                    $("#res").html(success);
                    $("#btn-save").attr("disabled", false);
                    $("#btn-save").html("Save Profile");

                    // Reload the page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                    // Remove the success message after 3 seconds
                    setTimeout(() => {
                        $("#res").empty();
                    }, 5000);
                }
            },
        });
    });

    $("#password_setup_frm").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-btn-change-pass").attr("disabled", true);
        $("#btn-btn-change-pass").html("Updating...");
        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.code == 400) {
                    let errorsHtml = "<ul class='list-unstyled'>";
                    $.each(response.errors, function (key, value) {
                        errorsHtml += "<li>" + value + "</li>";
                    });
                    errorsHtml += "</ul>";
                    $("#res").html(
                        '<div class="row alert alert-danger pb-0">' +
                            errorsHtml +
                            "</div>"
                    );
                    $("#btn-btn-change-pass").attr("disabled", false);
                    $("#btn-btn-change-pass").html("Change Password");
                } else if (response.code == 200) {
                    let success =
                        '<div class="alert alert-success">' +
                        response.msg +
                        "</div>";
                    $("#res").html(success);
                    $("#btn-btn-change-pass").attr("disabled", false);
                    $("#btn-btn-change-pass").html("Change Password");

                    // Reload the page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                    // Remove the success message after 3 seconds
                    setTimeout(() => {
                        $("#res").empty();
                    }, 5000);
                }
            },
        });
    });
});
