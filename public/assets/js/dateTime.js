$(document).ready(function () {
    // Set Interval to Function Time Loop
    setInterval(function () {
        time_loop();
    }, 1000);

    // Date and Time Loop
    function time_loop() {
        var weekday, hour, mins, meridiem, month, day, year, secs;

        var months = [
            "January",
            "Febuary",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];

        var weekdays = [
            " ",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday",
        ];

        var datetime = new Date(Date.now());
        hour = datetime.getHours();
        mins = datetime.getMinutes();
        secs = datetime.getSeconds();
        meridiem = hour >= 12 ? "PM" : "AM";
        month = months[datetime.getMonth()];
        weekday = weekdays[datetime.getDay()];
        day = datetime.getDate();
        year = datetime.getFullYear();
        hour = hour >= 12 ? hour - 12 : hour;
        hour = hour == 0 ? 12 : hour;
        hour = String(hour).padStart(2, 0);
        mins = String(mins).padStart(2, 0);
        secs = String(secs).padStart(2, 0);
        $(".time").text(hour + ":" + mins + ":" + secs + " " + meridiem);
        $(".date").text(weekday + ", " + day + " " + month + " " + year);
    }
});
