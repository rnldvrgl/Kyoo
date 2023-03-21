import "./bootstrap";

import "../sass/app.scss";

import Echo from "laravel-echo"; // Not used

window.Echo.channel("test-channel")
    .subscribed((e) => {
        console.log("Subscribed");
    })
    .listen(".test-event", (e) => {
        console.log(e.test);
    });
