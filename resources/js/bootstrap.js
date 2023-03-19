import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

try {
    window.Popper = require("@popper/core");
    window.$ = window.jQuery = require("jquery");
    require("bootstrap");
} catch (e) {}

import axios from "axios";
import { popper } from "@popperjs/core";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.MIX_PUSHER_APP_KEY,
//     cluster: import.meta.env.MIX_PUSHER_APP_CLUSTER,
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     enabledTransports: ["ws", "wss"],
// });

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.VITE_PUSHER_APP_KEY,
    cluster: process.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
    enabledTransports: ["ws", "wss"],
    forceTLS: true,
    authEndpoint: "/broadcasting/auth",
    auth: {
        headers: {
            Authorization: `Bearer ${localStorage.getItem("access_token")}`,
        },
    },
});
