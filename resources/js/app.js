import "./bootstrap";
import $ from "jquery";
window.$ = $;
window.jQuery = $;

import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/dataTables.dataTables.css";
import "./toast.js";

import "./barangs/renderButton.js";

$(document).ready(function () {
    $("#barangTable").DataTable();
});

// var Turbolinks = require("turbolinks");
// Turbolinks.start();
