import "./bootstrap";
import $ from "jquery";

import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/dataTables.dataTables.css";
import "./utils/toast.js";
import { loadSelectData } from "./utils/fetchData.js";

window.loadSelectData = loadSelectData;
window.$ = $;
window.jQuery = $;

$(document).ready(function () {
    $("#barangTable").DataTable();
});

// var Turbolinks = require("turbolinks");
// Turbolinks.start();
