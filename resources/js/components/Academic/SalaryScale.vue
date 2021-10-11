<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ $t('salary_scale') }}</h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" @click="openMyModal"><i class="fas fa-plus fa-w"></i>
                            {{ $t('Add New') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="ph-item" v-if="!scales.length">
                        <div class="ph-col-12">
                            <div class="ph-row">
                                <div class="ph-col-12 big"></div>
                                <div class="ph-col-12 big"></div>
                                <div class="ph-col-12 big"></div>
                                <div class="ph-col-12 big"></div>
                                <div class="ph-col-12 big"></div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover table-bordered" v-else>
                        <thead>
                            <tr>
                                <th>{{ $t('SL') }}</th>
                                <th>{{ $t('Title') }}</th>
                                <th>{{ $t('amount') }}</th>
                                <th>{{ $t('total_user') }}</th>
                                <th>{{ $t('total_pay') }}</th>
                                <th>{{ $t('Status') }}</th>
                                <th>{{ $t('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(scale, index ) in scales" :key="scale.id">
                                <td>{{ ++index }}</td>
                                <td>{{ scale.title }}</td>
                                <td>{{ scale.amount }}</td>
                                <td>{{ scale.users_count }} {{$t('person')}}</td>
                                <td>{{ scale.salaries_sum_amount == null ? 0 : scale.salaries_sum_amount | withCurrency}}</td>
                                <td>
                                    <span class="badge" :class="scale.status ? 'badge-success' : 'badge-warning'">{{scale.status ? $t('Activated') : $t('Deactivated')}}</span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" @click="editScale(scale)"><i class="far fa-edit"></i> {{$t('Edit')}}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">{{ editMode ? $t('Update') : $t('Add New') }} {{$t('salary_scale') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateScale() : createScale()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <form-group-input :form="form" v-model="form.title" name="title" :label="$t('Title')"></form-group-input>
                            <form-group-input :form="form" v-model="form.amount" type="number" name="amount" :label="$t('amount')"></form-group-input>
                            <form-group-toggle :form="form" v-model="form.status" id="status" :label="$t('Publication_Status')"></form-group-toggle>
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
    export default {
        name: "SalaryScale",
        data() {
            return {
                form: new Form({
                    title: "",
                    amount: "",
                    status: "",
                }),
                scales: {},
                editMode: false,
                editId: null,
            };
        },
        methods: {
            openMyModal() {
                this.form.reset();
                this.form.clear();
                this.editMode = false;
                this.editId = null;
                $("#myModal").modal("show");
            },
            editScale(scale) {
                this.openMyModal();
                this.editMode = true;
                this.editId = scale.id;
                this.form.fill(scale);
            },
            createScale() {
                this.form.post("/api/salary-scale").then(() => {
                    this.loadSalaryScaleList();
                    $("#myModal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: this.$t("success_message_create"),
                    });
                });
            },
            updateScale() {
                this.form.put("/api/salary-scale/" + this.editId).then(() => {
                    this.loadSalaryScaleList();
                    $("#myModal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: this.$t("success_message_update"),
                    });
                });
            },
            loadSalaryScaleList() {
                axios.get("/api/salary-scale").then((res) => {
                    this.scales = res.data;
                });
            },
        },
        created() {
            this.loadSalaryScaleList();
        },
    };
</script>

<style scoped>
</style>
