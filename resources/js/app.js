import "./bootstrap";

import "../sass/app.scss";

window.Echo.channel("test-channel")
    .subscribed((e) => {
        console.log("Subscribed");
    })
    // Trigger for Live Queue
    .listen(".test-event", (e) => {
        let ticket_number = e.test["ticket_number"];

        // Append in an element
        $("#ticket_number").html(ticket_number);

        console.log(ticket_number);
    });
