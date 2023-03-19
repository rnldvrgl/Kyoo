import "./bootstrap";

import "../sass/app.scss";

const test = Echo.channel("public.test.1");

test.subscribed(() => {
    console.log("Subscribed");
}).listen(".test", (event) => {
    console.log(event);
});
