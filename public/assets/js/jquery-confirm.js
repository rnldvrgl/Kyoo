$(document).ready(function () {
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

    // JQuery Delete Confirmation
    $("button#deleteData").confirm({
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
                    location.href = this.$target.attr("href");
                },
            },
            close: function () {},
        },
    });

    // Update Department Modal
    $("#update-dept-modal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id"); // Extract info from data-* attributes
        var modal = $(this);

        // Function to Fetch the data from departments table
        fetchDeptData(id, modal);
    });

    // Update Dept Button is clicked
    $("#update-dept").click(function () {
        var form = $("#update-dept-form");
        var formData = form.serialize();

        updateDeptData(formData);
    });

    // View Department
    $(".view-dept").on("click", function () {
        // Get the id from the data-id attribute
        var id = $(this).data("id");

        viewDeptData(id);
    });

    // Update Account Modal
    $("#update-account-modal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id"); // Extract info from data-* attributes
        var modal = $(this);

        // Function to Fetch the data from user-related table
        fetchAccountData(id, modal);
    });

    // Update Account Button is clicked
    $("#update-account").click(function () {
        var form = $("#update-account-form");
        var formData = form.serialize();

        updateAccountData(formData);
    });

    // View Account
    $(".view-account").on("click", function () {
        var id = $(this).data("id");

        viewAccountData(id);
    });
});

// Fetch Data from departments table
function fetchDeptData(id, modal) {
    $.ajax({
        url: "/fetch-dept",
        type: "POST",
        data: { id: id },
        success: function (response) {
            // Convert response from JSON string to Object
            var data = JSON.parse(response);

            // Loop to get all department information
            for (var i = 0; i < data.length; i++) {
                var id = data[i].department_id;
                var dept_name = data[i].dept_name;
                var dept_desc = data[i].dept_desc;
                var status = data[i].status;
            }

            // Find the input fields on the modal
            modal.find("#id").val(id);
            modal.find("#dept-name").val(dept_name);
            modal.find("#dept-desc").val(dept_desc);
            modal.find("#status").val(status);
        },
    });
}

// Update Data of departments table
function updateDeptData(formData) {
    $.ajax({
        url: "/update-dept",
        method: "PATCH",
        data: {
            formData,
        },
        success: function (response) {
            // Auto Refresh Page after Update Successful
            // window.location.reload();

            console.log("Working?");

            // Close the modal
            $("#update-dept-modal").modal("hide");
        },
    });
}

// Fetch Data from departments table
function viewDeptData(id) {
    $.ajax({
        url: "/fetch-dept",
        type: "POST",
        data: { id: id },
        success: function (response) {
            // Convert response from JSON string to Object
            var data = JSON.parse(response);

            console.log(data); // nafefetch nya

            // Loop to get all department information
            for (var i = 0; i < data.length; i++) {
                var id = data[i].department_id;
                var dept_name = data[i].dept_name;
                var dept_desc = data[i].dept_desc;
                var status = data[i].status;
            }

            // Fetched Data to Display
            let displayData = `
            <p>${id}</p>
            <p>${dept_name}</p>
            <p>${dept_desc}</p>
            <p>${status}</p>
        `;

            // Jquery-Confirm Design
            $.confirm({
                type: "dark",
                columnClass: "large",
                title: "Department Details",
                content: displayData,
                draggable: false,
                typeAnimated: true,
                theme: "Modern",
                buttons: {
                    close: function () {},
                },
            });
        },
    });
}

// Fetch Data from user-related tables
function fetchAccountData(id, modal) {
    $.ajax({
        url: "../../../controllers/UserProfileController.php",
        type: "POST",
        data: { id: id },
        success: function (response) {
            // Convert response from JSON string to Object
            var data = JSON.parse(response);

            // console.log(data); // nafefetch nya

            // Loop to get all department information
            for (var i = 0; i < data.length; i++) {
                var id = data[i].account_id;
                var name = data[i].name;
                var email = data[i].email;
                var department_id = data[i].department_id;
                var role_id = data[i].role_id;
            }

            // Find the input fields on the modal
            modal.find("#id").val(id);
            modal.find("#full_name").val(name);
            modal.find("#email").val(email);
            modal.find("#department").val(department_id);
            modal.find("#role").val(role_id);
        },
    });
}

// Update Data from user-related tables
function updateAccountData(formData) {
    $.ajax({
        url: "../../../controllers/UserProfileController.php",
        type: "POST",
        data: {
            formData,
        },
        success: function (response) {
            // Auto Refresh Page after Update Successful
            window.location.reload();

            // Close the modal
            $("#update-account-modal").modal("hide");
        },
    });
}

// Fetch Data from departments table
function viewAccountData(id) {
    $.ajax({
        url: "../../../controllers/UserProfileController.php",
        type: "POST",
        data: { id: id },
        success: function (response) {
            // Convert response from JSON string to Object
            var data = JSON.parse(response);

            // console.log(data); // nafefetch nya

            // Loop to get all user information
            for (var i = 0; i < data.length; i++) {
                var id = data[i].account_id;
                var name = data[i].name;
                var address = data[i].address;
                var phone = data[i].phone;
                var about = data[i].about;
                var email = data[i].email;
                var role = data[i].role_name;
                var dept_name = data[i].dept_name;
                var dept_desc = data[i].dept_desc;
                var status = data[i].status;
            }

            // TODO: Design the displayData

            // Fetched Data to Display
            let displayData = `
          <p>${id}</p>
          <p>${name}</p>
          <p>${address}</p>
          <p>${phone}</p>
          <p>${about}</p>
          <p>${email}</p>
          <p>${role}</p>
          <p>${dept_name}</p>
          <p>${dept_desc}</p>
          <p>${status}</p>
      `;

            // Jquery-Confirm Design
            $.confirm({
                type: "dark",
                columnClass: "large",
                title: "Account Details",
                content: displayData,
                draggable: false,
                typeAnimated: true,
                theme: "Modern",
                buttons: {
                    close: function () {},
                },
            });
        },
    });
}
