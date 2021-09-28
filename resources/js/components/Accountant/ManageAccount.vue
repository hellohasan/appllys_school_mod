<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ $t('ManageAccount') }}</h3>
                    <div class="card-tools" v-permission="['manage-accounts-create']">
                        <button class="btn btn-success btn-sm" @click="openMyModal"><i class="fas fa-plus fa-w"></i>
                            {{ $t('Add New') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-3">
                    <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ $t('SL') }}</th>
                                <th>{{ $t('Name') }}</th>
                                <th>{{ $t('amount') }}</th>
                                <th>{{ $t('BankAccount') }}</th>
                                <th>{{ $t('BankBranch') }}</th>
                                <th>{{ $t('Status') }}</th>
                                <th class="not-export-col">{{ $t('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(list, index) in lists" :key=index>
                                <td>{{ ++index }}</td>
                                <td>{{ list.name }}</td>
                                <td>{{ list.amount | withCurrency }}</td>
                                <td>{{ list.bank_account }}</td>
                                <td>{{ list.bank_branch }}</td>
                                <td>
                                    <template v-if="list.isActive">
                                        <span class="badge badge-success">{{ $t('Activated') }}</span>
                                    </template>
                                    <template v-else>
                                        <span class="badge badge-warning">{{ $t('Deactivated') }}</span>
                                    </template>
                                </td>
                                <td>
                                    <template v-if="list.id != 1">
                                        <button class="btn btn-primary btn-sm" @click="editAccount(list)" v-permission="['manage-accounts-edit']"><i class="far fa-edit"></i> {{$t('Edit')}}</button>
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">{{ editMode ? $t('Update') : $t('Add New') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateAccount() : createAccount()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <form-group-input :form="form" v-model="form.name" name="name" :label="$t('Name')"></form-group-input>
                            <form-group-input :form="form" v-model="form.amount" type="number" name="amount" :label="$t('amount')"></form-group-input>
                            <form-group-input :form="form" v-model="form.bank_account" type="text" name="bank_account" :label="$t('BankAccount')"></form-group-input>
                            <form-group-input :form="form" v-model="form.bank_branch" type="text" name="bank_branch" :label="$t('BankBranch')"></form-group-input>
                            <form-group-toggle :form="form" v-model="form.isActive" id="isActive" :label="$t('Publication_Status')"></form-group-toggle>
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
    import permission from "../../directive/permission/permission";
    import {myTableDom} from "../../helpers/myTableDom"
    export default {
        name: "ManageAccount",
        directives: { permission },
        data() {
            return {
                form: new Form({
                    name: "",
                    amount: "",
                    isActive: "",
                    bank_account: "",
                    bank_branch: "",
                    isActive: "",
                }),
                editMode: false,
                editId: null,
                lists: {},
            };
        },
        methods: {
            myTable(){
                this.$nextTick(()=>{
                    $('#myTable').DataTable(myTableDom)
                })
            },
            openMyModal() {
                this.form.reset();
                this.form.clear();
                this.editMode = false;
                this.editId = null;
                $("#myModal").modal("show");
            },

            editAccount(list) {
                this.openMyModal();
                this.editMode = true;
                this.editId = list.id;
                this.form.fill(list);
            },
            createAccount() {
                this.form.post("/api/manage-accounts-store").then(() => {
                    this.loadManageAccount();
                    this.myTable();
                    $("#myModal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: this.$t("success_message_create"),
                    });
                });
            },
            updateAccount() {
                this.form
                    .put(`/api/manage-accounts-update/${this.editId}`)
                    .then(() => {
                        this.loadManageAccount();
                        this.myTable();
                        $("#myModal").modal("hide");
                        Toast.fire({
                            icon: "success",
                            title: this.$t("success_message_update"),
                        });
                    });
            },
            loadManageAccount() {
                axios.get("/api/manage-accounts").then((res) => {
                    this.lists = res.data;
                    this.myTable();
                });
            },
        },
        created() {
            this.loadManageAccount();
        }
    };
</script>

<style lang="scss" scoped>
</style>
