export const myTableDom = {
  dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  pageLength: 10,
  buttons: [
    {
      extend: "print",
      text: "<i class='fas fa-print'></i> Print",
      titleAttr: "Print",
      className: "btn btn-info btn-sm text-white",
      exportOptions: {
        columns: ":not(.not-export-col)"
      }
    },
    {
      extend: "pdfHtml5",
      text: "<i class='fas fa-file-pdf'></i> PDF",
      titleAttr: "Export as PDF",
      className: "btn btn-success btn-sm",
      customize: function (doc, config) {
        doc.defaultStyle.font = 'SolaimanLipi';
        doc.styles.tableHeader.alignment = 'left';
        doc.defaultStyle.alignment = 'left';
        doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5,5,5,5];

        let tableNode;
        for (let i = 0; i < doc.content.length; ++i) {
          if(doc.content[i].table !== undefined){
            tableNode = doc.content[i];
            break;
          }
        }
        const rowIndex = 0;
        const tableColumnCount = tableNode.table.body[rowIndex].length;
        if(tableColumnCount > 5){
          doc.pageOrientation = 'landscape';
        }
      }
    },
    {
      extend: "excelHtml5",
      text: "<i class='fas fa-file-excel'></i> Excel",
      titleAttr: "Export as Excel",
      className: "btn btn-secondary btn-sm",
      exportOptions: {
        columns: ":not(.not-export-col)"
      }
    },
    {
      extend: "copyHtml5",
      text: "<i class='fas fa-copy'></i> Copy",
      titleAttr: "Copy to clipboard",
      className: "btn btn-info btn-sm text-white",
      exportOptions: {
        columns: ":not(.not-export-col)"
      }
    }
  ]
}
