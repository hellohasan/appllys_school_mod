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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Created AT</th>
                    <th>Created AT</th>
                </tr>
                </thead>
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
    name: "DataTable3",
    mounted(){
        this.myTable();
        window.addEventListener('click', event => {
            let target = event.target;
            if (target && target.localName === 'button' && target.dataset.id) {
                event.preventDefault();
                console.log(target.dataset.id)
                console.log(target.dataset.action)
                //const url = JSON.parse(target.dataset.to);
                //router.push({ name: 'user', params: { userId: '123' } })
                this.$router.push('/dashboard');
            }
        });

    },
    methods: {
        myTable() {
            this.$nextTick(() => {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    retrieve: true,
                    ajax: {
                        url: "/api/load-test3-student",
                        type: 'GET',
                        headers: {"Authorization": 'Bearer '+this.$store.getters.currentUser.token}
                    },
                    columns: [
                        {data: 'name'},
                        {data: 'email'},
                        {data: 'phone'},
                        {data: 'username'},
                        {data: 'created_at'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            clickToSelect: false,
                            align: 'center',
                            render: function ( data, type, row ) {
                                return '<button data-id="'+row.id+'" data-action="show" class="btn btn-sm btn-info mr-1"><i class="fas fa-eye"></i></button><button data-id="'+row.id+'" data-action="edit" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i></button><button data-id="'+row.id+'" data-action="delete" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i></button>'
                            }
                        },
                    ],
                    lengthMenu: [ [15, 50, 100, 200, -1], [15, 50, 100, 200, 'All'] ],
                    pageLength: 15,
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
                });

            })
        }
    }
}
</script>

<style scoped>

</style>
