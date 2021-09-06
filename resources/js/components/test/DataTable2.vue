<template>
    <custom-card
        :title="$t('Admission_list')"
        :url="'/admissions/add'"
        :text="$t('New_admission')"
        :icon="'fas fa-plus'">

        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                </tbody>
            </table>
        </div>
    </custom-card>
</template>

<script>
require('datatables.net-bs4/js/dataTables.bootstrap4.min')
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min')
require('datatables.net-responsive/js/dataTables.responsive.min')
require('datatables.net-responsive-bs4/js/responsive.bootstrap4.min')
export default {
    name: "DataTable2",
    mounted() {
        this.myTable();
    },
    methods: {
        myTable() {
            this.$nextTick(() => {
                $('#myTable').DataTable({
                    responsive: true,
                    retrieve: true,
                    dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-3 offset-md-3'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-center'i><'col-sm-12 col-md-5'p>>",
                    buttons: [
                        {
                            text: "<i class='fas fa-file-excel'></i> Excel",
                            titleAttr: "Export as Excel",
                            className: "btn btn-primary btn-sm",
                            action: function ( e, dt, node, config ) {
                                alert( 'Excel activated' );
                            }
                        },
                        {
                            text: "<i class='fas fa-file-pdf'></i> PDF",
                            titleAttr: "Export as PDF",
                            className: "btn btn-success btn-sm",
                            action: function ( e, dt, node, config ) {
                                alert( 'Pdf activated' );
                            }
                        },
                    ]
                })
            })
        }
    }
}
</script>

<style scoped>

</style>
