import "./bootstrap";

import "../sass/app.scss";

// Staff Dashboard to Live Queue Preview
import "./channels/live-queue.js";

// Kiosk to Registrar Staff Dashboard (Papunta sa Pending Tab)
import "./channels/kiosk-to-pending-tab.js";

// Registrar to Librarians (College and High School)
import "./channels/request-clearance.js";

// Librarians to Registrar
import "./channels/clearance-status.js";

// New Promotional Video
import "./channels/new-promotional-video.js";

// New Promotional Text
import "./channels/new-promotional-text.js";
