$(document).ready(function () {
    // Define courses for each department
    var courses = {
        "Graduate School": [
            {
                value: "Master Baiting",
                text: "Master Baiting",
            },
        ],
        College: [
            // BSIT
            {
                value: "Bachelor of Science in Information Technology",
                text: "Bachelor of Science in Information Technology",
            },
            // BSCE
            {
                value: "Bachelor of Science in Civil Engineering",
                text: "Bachelor of Science in Civil Engineering",
            },
            // BSA
            {
                value: "Bachelor of Science in Accountancy",
                text: "Bachelor of Science in Accountancy",
            },
            // BSMA
            {
                value: "Bachelor of Science in Management Accounting",
                text: "Bachelor of Science in Management Accounting",
            },
            // BSTM
            {
                value: "Bachelor of Science in Tourism Management",
                text: "Bachelor of Science in Tourism Management",
            },
            // BSHM
            {
                value: "Bachelor of Science in Hospitality Management",
                text: "Bachelor of Science in Hospitality Management",
            },
            // BSBA
            {
                value: "Bachelor of Science in Businesss Administration",
                text: "Bachelor of Science in Businesss Administration",
            },
            // BEEd
            {
                value: "Bachelor of Science in Elementary Education",
                text: "Bachelor of Science in Elementary Education",
            },
            // AB English
            {
                value: "Bachelor of Arts in English",
                text: "Bachelor of Arts in English",
            },
            // BSEd English
            {
                value: "Bachelor of Secondary Education, Major in English",
                text: "Bachelor of Secondary Education, Major in English",
            },
            // BSEd Filipino
            {
                value: "Bachelor of Secondary Education, Major in Filipino",
                text: "Bachelor of Secondary Education, Major in Filipino",
            },
            // BSEd Math
            {
                value: "Bachelor of Secondary Education, Major in Mathematics",
                text: "Bachelor of Secondary Education, Major in Mathematics",
            },
        ],
        "Senior High School": [
            // ABM
            {
                value: "Accountancy, Business, and Management Strand",
                text: "Accountancy, Business, and Management Strand",
            },
            // GAS
            {
                value: "General Academic Strand",
                text: "General Academic Strand",
            },
            // STEM
            {
                value: "Science, Technology, Engineering, and Mathematics Strand",
                text: "Science, Technology, Engineering, and Mathematics Strand",
            },
            // HUMSS
            {
                value: "Humanities and Social Sciences Strand",
                text: "Humanities and Social Sciences Strand",
            },
        ],
        "Junior High School": [
            // JHS
            { value: "Junior High School", text: "Junior High School" },
        ],
    };

    // Handle "Back" button click
    $("#go-back").on("click", function () {
        // Go back to previous page in browser history
        window.history.back();
    });

    // Handle form submit
    $("#input-information-frm").on("submit", function (event) {
        // Check if department and course are selected
        var department = $("#floatingDepartment").val();
        var course = $("#floatingCourse").val();
        if (!department || !course) {
            // Prevent form submission
            event.preventDefault();
            // Display error message
            $("#error-message").text("Please select a department and course.");
            return false;
        }
    });

    // Handle department change
    $("#floatingDepartment").on("change", function () {
        var department = $(this).val();
        var courseDropdown = $("#floatingCourse");
        courseDropdown.empty();
        courses[department].forEach(function (course) {
            courseDropdown.append(
                $("<option></option>")
                    .attr("value", course.value)
                    .text(course.text)
            );
        });
        courseDropdown.prop("disabled", false);
    });

    // hide error-message alert when document loads
    $("#error-message").hide();

    // show error-message alert and set text when form is submitted
    $("#input-information-frm").on("submit", function (event) {
        event.preventDefault(); // prevent form submission

        var errors = []; // create an empty array for validation errors

        // check if fullname, department, and course are filled
        if ($("#floatingName").val() == "") {
            errors.push("Please provide your full name.");
        }

        // check if department and course are selected
        var selectedDepartment = $("#floatingDepartment").val();
        var selectedCourse = $("#floatingCourse").val();
        if (
            selectedDepartment == "" ||
            selectedCourse == "" ||
            selectedDepartment == null ||
            selectedDepartment == null
        ) {
            errors.push("Please select a department and course.");
        }

        if (errors.length > 0) {
            // join error messages into a string separated by <br> tags
            var errorMessage = errors.join("<br>");
            // set error message text and show error-message alert
            $("#error-message").html(errorMessage).show();
        } else {
            $("#error-message").text(""); // clear error message text
            $("#error-message").hide(); // hide error-message alert
            // do something else, like submit the form data to the server
            this.submit();
        }

        console.log(selectedDepartment);
        // console.log(selectedCourse);
        // console.log(errors);
    });

    // hide error-message alert when text is empty or whitespace
    $("#error-message").on("DOMSubtreeModified", function () {
        if ($(this).text().trim() == "") {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});
