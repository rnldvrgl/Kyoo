$(document).ready(function () {
    var monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
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
            width: "100%",
            height: "100%",
            legend: { position: "none" },
            chartArea: {
                width: "90%",
                height: "70%",
            },
            hAxis: {
                baselineColor: "grey",
            },
            vAxis: {
                baselineColor: "grey",
                viewWindow: {
                    min: 0,
                },
            },
            pointSize: 5,
            series: {
                0: {
                    lineWidth: 3,
                    color: "#A8D1D1",
                    pointShape: "circle",
                },
            },
            curveType: "function",
        };

        var chart = new google.visualization.LineChart($("#line-chart")[0]);
        chart.draw(data, options);
    }

    function fetchQueueData(year, id) {
        $.ajax({
            url: "/fetch-department-queue-data/" + year + "/" + id,
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
        var department_id = $("#department_id").val(); // Hidden in Department Admin DOM
        fetchQueueData(currentYear, department_id);

        $("#year-dropdown").on("change", function () {
            var year = $(this).val();
            fetchQueueData(year, department_id);
        });
    });
});
