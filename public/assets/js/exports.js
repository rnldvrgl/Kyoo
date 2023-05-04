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
                if (response.code === 400) {
                    let error =
                        '<div class="alert alert-danger">' +
                        response.msg +
                        "</div>";
                    $("#res").html(error);
                } else if (response.code === 200) {
                    // * Start Download
                    downloadURL(response);

                    // If successful download
                    let success = `<div class="alert alert-success">${response.msg}</div>`;
                    $("#res").html(success);

                    setTimeout(() => {
                        $("#res").html("");
                    }, 1500);
                }

                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html(
                    'Filter <i class="fa-solid fa-filter"></i>'
                );

                // Clear input fields
                $("#export-librarian-ticket")[0].reset();
                // Reset the "Course" select element
                let courseSelect = $("#floatingCourse");
                courseSelect.html(
                    "<option value='' selected disabled>Select Course</option>"
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

    // Export Main Admin Report
    $("#export-main-admin-report").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-submit-filter").attr("disabled", true);
        $("#btn-submit-filter").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Exporting ..."
        );
        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: (response) => {
                if (response.code === 400) {
                    let error =
                        '<div class="alert alert-danger">' +
                        response.msg +
                        "</div>";
                    $("#res").html(error);
                } else if (response.code === 200) {
                    // * Start Download
                    downloadURL(response);

                    // If successful download
                    let success = `<div class="alert alert-success">${response.msg}</div>`;
                    $("#res").html(success);

                    setTimeout(() => {
                        $("#res").html("");
                    }, 1500);
                }

                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html(
                    'Export <i class="fa-solid fa-filter"></i>'
                );

                // Clear input fields
                $("#export-main-admin-report")[0].reset();
            },
            error: (xhr, status, error) => {
                // handle error response
                $("#res").html(
                    '<div class="row alert alert-danger">' +
                        "An error occurred performing the filter. Please try again later." +
                        "</div>"
                );
                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html(`
                    Export
                    <i class="fa-solid fa-clipboard"></i>
                `);
            },
        });
    });

    // Export Department Admin Report
    $("#export-department-admin-report").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-submit-filter").attr("disabled", true);
        $("#btn-submit-filter").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Exporting ..."
        );
        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: (response) => {
                if (response.code === 400) {
                    let error =
                        '<div class="alert alert-danger">' +
                        response.msg +
                        "</div>";
                    $("#res").html(error);
                } else if (response.code === 200) {
                    // * Start Download
                    downloadURL(response);

                    // If successful download
                    let success = `<div class="alert alert-success">${response.msg}</div>`;
                    $("#res").html(success);

                    setTimeout(() => {
                        $("#res").html("");
                    }, 1500);
                }

                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html(
                    'Export <i class="fa-solid fa-clipboard"></i>'
                );

                // Clear input fields
                $("#export-department-admin-report")[0].reset();
            },
            error: (xhr, status, error) => {
                // handle error response
                $("#res").html(
                    '<div class="row alert alert-danger">' +
                        "An error occurred performing the filter. Please try again later." +
                        "</div>"
                );
                $("#btn-submit-filter").attr("disabled", false);
                $("#btn-submit-filter").html(`
                    Export
                    <i class="fa-solid fa-clipboard"></i>
                `);
            },
        });
    });

    // Export Staff Report
    $("#export-staff-data").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $("#btn-submit").attr("disabled", true);
        $("#btn-submit").html(
            "<i class='fa-solid fa-circle-notch fa-spin'></i> Exporting ..."
        );
        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: (response) => {
                if (response.code === 400) {
                    let error =
                        '<div class="d-flex justify-content-center"><div class="alert alert-danger">' +
                        response.msg +
                        "</div></div>";
                    $("#res").html(error);
                } else if (response.code === 200) {
                    // * Start Download
                    downloadURL(response);

                    // If successful download
                    let success = `<div class="d-flex justify-content-center"><div class="alert alert-success">${response.msg}</div></div>`;
                    $("#res").html(success);

                    setTimeout(() => {
                        $("#res").html("");
                    }, 1500);
                }

                $("#btn-submit").attr("disabled", false);
                $("#btn-submit").html(
                    'Export Report <i class="fa-solid fa-clipboard"></i>'
                );

                // Clear input fields
                $("#export-main-admin-report")[0].reset();
            },
            error: (xhr, status, error) => {
                // handle error response
                $("#res").html(
                    '<div class="d-flex justify-content-center"><div class="row alert alert-danger">' +
                        "An error occurred while exporting the report. Please try again later." +
                        "</div></div>"
                );
                $("#btn-submit").attr("disabled", false);
                $("#btn-submit").html(`
                    Export Report
                    <i class="fa-solid fa-clipboard"></i>
                `);
            },
        });
    });
});

// Download function
function downloadURL(response) {
    // Assuming your file URL is stored in a variable called "fileUrl"
    let fileUrl = response.url;

    // Create the anchor tag
    let downloadLink = document.createElement("a");

    // Set the href attribute to the file URL
    downloadLink.href = fileUrl;

    // Set the download attribute to the file name
    downloadLink.download = response.fileName;

    // Simulate a click on the anchor tag to initiate the download
    downloadLink.click();
}
