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
});
