import "./bootstrap";

import "../sass/app.scss";

window.Echo.channel("test-channel")
    .subscribed((e) => {
        console.log("Subscribed");
    })
    // Trigger for Live Queue
    .listen(".test-event", (e) => {
        console.log(e.test);
    });
