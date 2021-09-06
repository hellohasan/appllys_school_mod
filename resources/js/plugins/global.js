/* Sweet alert2 is loaded here*/
import Swal from "sweetalert2";
window.Swal = Swal;
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  didOpen: toast => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  }
});
window.Toast = Toast;

require("summernote/dist/summernote-bs4.min.js")
require("select2/dist/js/select2.min")
require("bootstrap-toggle")

