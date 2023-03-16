$(document).ready(function () {
    // Pause Work
    $(".pause-work-btn").on("click", function () {
        var btn = $(this);
        if (btn.hasClass("paused")) {
            btn.removeClass("btn-success");
            btn.removeClass("paused");
            btn.addClass("btn-outline-primary");
            btn.html(
                'Pause Work <i class="fa-solid fa-circle-pause ms-2"></i>'
            );
            // Resume work functionality here
        } else {
            btn.removeClass("btn-outline-primary");
            btn.addClass("btn-success paused");
            btn.html('Resume Work <i class="fa-solid fa-play ms-2"></i>');
            // Pause work functionality here
        }
    });
});
