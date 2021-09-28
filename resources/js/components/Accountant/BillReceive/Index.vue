<template>
    <custom-card :title="$t('ReceiveList')" :url="'/bill-receive/new'" :icon="'fas fa-plus'" :text="$t('NewReceive')">

        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>{{ $t("SL") }}</th>
                    <th>{{ $t("PayAt") }}</th>
                    <th>{{ $t("Custom") }}</th>
                    <th>{{ $t("StudentName") }}</th>
                    <th>{{ $t("Academic_Class") }}</th>
                    <th>{{ $t("amount") }}</th>
                    <th class="not-export-col">{{ $t("Action") }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </custom-card>
</template>

<script>
import axios from 'axios'
export default {
    name: "Index",
    data(){
        return{
            name: 'hasan'
        }
    },
    methods:{
        myTable(){
            $('#myTable').DataTable().clear().destroy();
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                retrieve: true,
                destroy : true,
                ajax: {
                    url: "/api/load-bill-pay-lists",
                    type: 'GET',
                    headers: {"Authorization": 'Bearer '+this.$store.getters.currentUser.token}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'created_at'},
                    {data: 'custom'},
                    {data: 'name'},
                    {data: 'academic_class'},
                    {data: 'amount'},
                    {data: 'action'}
                ],
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
                        exportOptions: {
                            columns: ":not(.not-export-col)"
                        },
                        customize: function (doc, config) {
                            doc.defaultStyle.font = 'SolaimanLipi';
                            doc.styles.tableHeader.alignment = 'left';
                            doc.defaultStyle.alignment = 'left';
                            doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5, 5, 5, 5];
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');

                            let tableNode;
                            for (let i = 0; i < doc.content.length; ++i) {
                                if (doc.content[i].table !== undefined) {
                                    tableNode = doc.content[i];
                                    break;
                                }
                            }
                            const rowIndex = 0;
                            const tableColumnCount = tableNode.table.body[rowIndex].length;
                            if (tableColumnCount > 6) {
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

            })
        },
        myTableDelete(){
            this.myTable();
        }
    },
    mounted(){
        this.myTable();
        window.addEventListener('click', event => {
            let target = event.target;
            if (target && target.localName === 'button' && target.dataset.id) {
                event.preventDefault();
                event.stopPropagation();
                let id = target.dataset.id;
                let action = target.dataset.action;
                if(action == 'delete'){
                    Swal.fire({
                        title: this.$t('confirm_title'),
                        text: this.$t('confirm_message'),
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete('/api/delete-bill-pay-lists',{data:{id:id}}).then((res) =>{
                                Toast.fire({
                                    icon: 'success',
                                    title: this.$t('delete_message')
                                });
                                this.myTableDelete();
                            })
                        }
                    })
                }

            }
            return;
        });
    },
}
</script>

<style scoped>

</style>
