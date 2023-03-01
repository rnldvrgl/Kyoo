// Date and Time Loop
function updateTime() {
    const now = new Date();

    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    const date = now.toLocaleDateString(undefined, options);
    const time = now.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    });

    $(".time").text(time);
    $(".date").text(date);
}

$(function () {
    updateTime();
    setInterval(updateTime, 1000);
});
