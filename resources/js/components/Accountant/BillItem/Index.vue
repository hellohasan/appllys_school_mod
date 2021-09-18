<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $t('BillItem') }}</h3>
                    <div class="card-tools">
                        <button class="btn btn-success" @click="openItemModal"><i class="fas fa-user-plus fa-w"></i>
                            {{ $t('Add') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>{{ $t('SL') }}</th>
                                <th>{{ $t('Title') }}</th>
                                <th>{{ $t('BillFor') }}</th>
                                <th>{{ $t('DefaultAmount') }}</th>
                                <th>{{ $t('Status') }}</th>
                                <th>{{ $t('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index ) in items" :key="item.id">
                                <td>{{ ++index }}</td>
                                <td>{{ item.title }}</td>
                                <td>{{ item.item_for }}</td>
                                <td>{{ item.default_amount }}</td>
                                <td>
                                    <span class="badge" :class="item.activated ? 'badge-success' : 'badge-warning'">{{item.activated ? $t('Activated') : $t('Deactivated')}}</span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="editItem(item)"><i class="far fa-edit"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">{{ editMode ? $t('Update') : $t('Add New') }} {{$t('BillItem') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateItem() : createItem()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <form-group-input :form="form" v-model="form.title" name="name" :label="$t('Title')"></form-group-input>
                            <form-group-select :options="itemsFor" label="Select One" id="role" v-model="form.item_for" :form="form"></form-group-select>
                            <form-group-input :form="form" v-model="form.default_amount" name="default_amount" :label="$t('DefaultAmount')"></form-group-input>
                            <form-group-toggle :form="form" v-model="form.activated" id="activated" :label="$t('Status')"></form-group-toggle>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('Close') }}
                            </button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">
                                {{ editMode ? $t('Update') : $t('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
require('../../../helpers/datatable')
import dom from '../../../helpers/datatableDom'
export default {
    name: "Index",
    data(){
        return{
            items: {},
            form: new Form({
                title: '',
                item_for: '',
                default_amount: '',
                activated:''
            }),
            editMode: false,
            editId: null,
            itemsFor:[
                {
                    "id": 'Students',
                    "text": "Students"
                },
                {
                    "id": 'Office',
                    "text": "Office"
                }
            ]
        }
    },
    methods: {
        callMethodOne(){
            alert('new')
        },
        myTable(){
            let token = this.$store.getters.currentUser.token;
            this.$nextTick(()=> {
                $('#myTable').DataTable({
                    dom,
                    retrieve: true,
                    buttons: [
                        {
                            text: "<i class='fas fa-file-excel'></i> Excel",
                            titleAttr: "Export as Excel",
                            className: "btn btn-primary btn-sm",
                            action: function ( e, dt, node, config ) {
                                $.ajax({
                                    url: "/api/bill-item-export",
                                    type: 'POST',
                                    data:{type:'excel'},
                                    headers: {"Authorization": 'Bearer '+token},
                                    success: function(response) {
                                        let a = document.createElement("a");
                                        a.href = response.file;
                                        a.download = response.name;
                                        document.body.appendChild(a);
                                        a.click();
                                        a.remove();
                                    }
                                });
                            }
                        },
                        {
                            text: "<i class='fas fa-file-pdf'></i> PDF",
                            titleAttr: "Export as PDF",
                            className: "btn btn-success btn-sm",
                            action: function ( e, dt, node, config ) {
                                $.ajax({
                                    url: "/api/bill-item-export",
                                    type: 'POST',
                                    data:{type:'pdf'},
                                    headers: {"Authorization": 'Bearer '+token},
                                    xhrFields: {
                                        responseType: 'blob'
                                    },
                                    success: function(response) {
                                        var blob = new Blob([response]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = "Bill Item List.pdf";
                                        link.click();
                                    },
                                    error: function(blob){
                                        console.log(blob);
                                    }
                                });
                            }
                        },
                    ]
                });
            })
        },
        openItemModal() {
            this.form.reset();
            this.form.clear();
            this.editMode = false;
            this.editId = null;
            $('#itemModal').modal('show');
        },
        editItem(item) {
            this.openItemModal();
            this.editMode = true;
            this.editId = item.id;
            this.form.fill(item);
        },
        createItem() {
            this.form.post('/api/bill-items')
                .then(() => {
                    Fire.$emit('loadBillItemList');
                    $('#itemModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                })
        },
        updateItem() {
            this.form.put('/api/bill-items/' + this.editId)
                .then(() => {
                    Fire.$emit('loadBillItemList');
                    $('#itemModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                })
        },
        loadBillItems(){
            axios.get('/api/bill-items')
                .then(res =>{
                    this.items = res.data
                    this.myTable()
                })
        },
    },
    created() {
        this.loadBillItems();
        Fire.$on('loadBillItemList', () => {
            this.loadBillItems();
        });
    }
}
</script>

<style scoped>

</style>
