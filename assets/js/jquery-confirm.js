$(document).ready(function () {
  // AJAX TEMPLATE
  // $.ajax({
  //   type: "POST",
  //   url: "#",
  //   data: { id: id },
  //   success: function (data) {
  //   },
  // });

  $(".alert").delay(3000).fadeOut("slow");

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

  // JQuery View Data
  $("button#viewData").click(function () {
    // Fetched Data to Display
    let displayData = `
    <h6>Sample</h6>
`;

    // Jquery-Confirm Design
    $.confirm({
      type: "dark",
      columnClass: "large",
      title: "View Account Details",
      content: displayData,
      draggable: false,
      typeAnimated: true,
      theme: "Modern",
      buttons: {
        close: function () {},
      },
    });
  });

  // Update Modal
  $("#update-dept-modal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data("id"); // Extract info from data-* attributes
    var action = "Fetch";
    var modal = $(this);

    // Function to Fetch the data from departments table
    fetchDeptData(id, action, modal);
  });

  // Update Dept Button is clicked
  $("#update-dept").click(function () {
    var form = $("#update-dept-form");
    var formData = form.serialize();
    var action = "Update";

    updateDeptData(formData, action);
  });
});

// Fetch Data from departments table
function fetchDeptData(id, action, modal) {
  $.ajax({
    url: "../../../controllers/DepartmentsController.php",
    type: "POST",
    data: { id: id, action: action },
    success: function (response) {
      // Convert response from JSON string to Object
      var data = JSON.parse(response);

      // console.log(data); // nafefetch nya

      // Loop to get all department information
      for (var i = 0; i < data.length; i++) {
        var id = data[i].dept_id;
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
function updateDeptData(formData, action) {
  $.ajax({
    url: "../../../controllers/DepartmentsController.php",
    type: "POST",
    data: {
      formData,
      action: action,
    },
    success: function (response) {
      // Auto Refresh Page after Update Successful
      window.location.reload();

      // Close the modal
      $("#update-dept-modal").modal("hide");
    },
  });
}
