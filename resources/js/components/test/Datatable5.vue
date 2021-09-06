<template>
    <custom-card
        :title="$t('Admission_list')"
        :url="'/admissions/add'"
        :text="$t('New_admission')"
        :icon="'fas fa-plus'">

        <div class="table-responsive">
            <table id="sampleTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Created AT</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </custom-card>
</template>

<script>
require('datatables.net-bs4/js/dataTables.bootstrap4.min')
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min')
require('datatables.net-buttons/js/buttons.html5')
require('datatables.net-buttons/js/buttons.colVis')
require('datatables.net-buttons/js/buttons.print')
import jszip from 'jszip/dist/jszip'
import pdfMake from "pdfmake/build/pdfmake"
import pdfFonts from "pdfmake/build/vfs_fonts"

pdfMake.vfs = pdfFonts.pdfMake.vfs;
window.JSZip = jszip

export default {
    name: "Datatable5",
    mounted(){
        this.myTable();
        this.loadRows();
    },
    data(){
        return{
            rows: [],
        }
    },
    methods: {
        myTable() {
            axios.get('/api/load-test3-student').then((res) => {
                this.$nextTick(()=>{
                    $('#sampleTable').DataTable({
                        data: res.data,
                        columns: [
                            { data: 'name' },
                            { data: 'email' },
                            { data: 'phone' },
                            { data: 'username' },
                            { data: 'created_at' }
                        ],
                        dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                            {
                                "extend": "copyHtml5",
                                "text": "<i class='fas fa-copy'></i> Copy",
                                "titleAttr": "Copy to clipboard",
                                "className": "btn btn-secondary btn-sm",
                                "exportOptions": {
                                    columns: [ 0, 1, 2, 3 ]
                                }
                            },
                            {
                                "extend": "excelHtml5",
                                "text": "<i class='fas fa-file-excel'></i> Excel",
                                "titleAttr": "Export as Excel",
                                "className": "btn btn-success btn-sm",
                                "exportOptions": {
                                    columns: [ 0, 1, 2, 3 ]
                                }
                            },
                            {
                                "extend": "pdfHtml5",
                                "text": "<i class='fas fa-file-pdf'></i> PDF",
                                "titleAttr": "Export as PDF",
                                "className": "btn btn-danger btn-sm",
                                "exportOptions": {
                                    columns: [ 0, 1, 2, 3 ]
                                }
                            },
                            {
                                "extend": "csvHtml5",
                                "text": "<i class='fas fa-file-csv'></i> CSV",
                                "titleAttr": "Export as CSV",
                                "className": "btn btn-info btn-sm text-white",
                                "exportOptions": {
                                    columns: [ 0, 1, 2, 3 ]
                                }

                            },
                            {
                                "extend": "print",
                                "text": "<i class='fas fa-print'></i> Print",
                                "titleAttr": "Print",
                                "className": "btn btn-secondary btn-sm"
                            },
                            {
                                "extend": "colvis",
                                "text": "<i class='fas fa-print'></i> Column",
                                "titleAttr": "Column Sort",
                                "className": "btn btn-info btn-sm text-white"
                            }
                        ]
                    })
                })
            })
        }
    }
}
</script>

<style scoped>

</style>
