import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import intersect from "@alpinejs/intersect";

Alpine.plugin(intersect);

import Swal from "sweetalert2";
window.Swal = Swal.mixin({
    allowOutsideClick: false,
    reverseButtons: true,
    heightAuto: false,
    confirmButtonColor: "#0054a6",
    cancelButtonColor: "#d63939",
    confirmButtonText: "Yakin",
    cancelButtonText: "Batal",
});
