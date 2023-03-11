$(document).ready(function () {
    var monthNames = [
        "January",
        "February",
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

    function drawChart(chartData) {
        var data = new google.visualization.DataTable();
        data.addColumn("string", "Month");
        data.addColumn("number", "Queue Count");

        var rows = [];
        for (var i = 0; i < 12; i++) {
            var monthName = monthNames[i];
            var queueCount = 0;

            for (var j = 0; j < chartData.length; j++) {
                if (chartData[j].month === i + 1) {
                    queueCount = chartData[j].queue_count;
                    break;
                }
            }

            rows.push([monthName, queueCount]);
        }

        data.addRows(rows);

        var options = {
            title: "Number of Queues per month",
            width: "100%",
            height: "100%",
            chartArea: {
                width: "80%",
                height: "70%",
            },
            hAxis: {
                title: "Month",
            },
            vAxis: {
                title: "Queue Count",
            },
        };

        var chart = new google.visualization.LineChart($("#line-chart")[0]);
        chart.draw(data, options);
    }

    function fetchQueueData(year) {
        $.ajax({
            url: "/fetch-queue-data/" + year,
            success: function (data) {
                drawChart(data);
            },
            error: function () {
                console.log("Error fetching data for year " + year);
            },
        });
    }

    // Load the Visualization API and the corechart package.
    google.charts.load("current", {
        packages: ["corechart"],
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(function () {
        var currentYear = new Date().getFullYear();
        fetchQueueData(currentYear);

        $("#year-dropdown").on("change", function () {
            var year = $(this).val();
            fetchQueueData(year);
        });
    });
});
