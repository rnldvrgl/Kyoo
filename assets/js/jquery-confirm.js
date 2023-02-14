$(document).ready(function () {
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
        $.ajax({
            type: "POST",
            url: "#",
            data: { id: id },
            success: function (data) {
                //Declare Parsed Data Variable
                let parsedData = JSON.parse(data);

                // Loop to Convert JSON Object to JS Object
                for (i = 0; i < parsedData.length; i++) {
                    // var test = parsedData[i].test;
                    // var test = parsedData[i].test;
                    // var test = parsedData[i].test;
                }

                // Fetched Data to Display
                let displayData = `
					<h6>${test}</h6>
					<h6>${test}</h6>
					<h6>${test}</h6>
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
            },
        });
    });
});
