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

require('datatables.net-bs4/js/dataTables.bootstrap4.min')
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min')
require('datatables.net-buttons/js/buttons.html5')
require('datatables.net-buttons/js/buttons.colVis')
require('datatables.net-buttons/js/buttons.print')
import jszip from 'jszip/dist/jszip'
import pdfMake from "pdfmake/build/pdfmake"
import pdfFonts from "pdfmake/build/custom_fonts"

pdfMake.vfs = pdfFonts.pdfMake.vfs;
pdfMake.fonts = {
  SolaimanLipi: {
    normal: 'SolaimanLipi.ttf',
    bold: 'SolaimanLipi.ttf'
  }
};
window.JSZip = jszip


