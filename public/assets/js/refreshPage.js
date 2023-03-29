var idleTime = 0;
var idleInterval = setInterval(timerIncrement, 1000); // check idle time every second

function timerIncrement() {
    idleTime++;
    if (idleTime >= 10) {
        // set idle time limit to 5 seconds
        location.reload();
    }
}

$(document).on("keypress click mousemove", function () {
    // reset idle time on user activity
    // console.log(idleTime);
    idleTime = 0;
});
