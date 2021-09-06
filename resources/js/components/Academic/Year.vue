<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ $t('Department_year') }}</h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" @click="openMyModal"><i class="fas fa-plus fa-w"></i>
                            {{ $t('Add New') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>{{ $t('SL') }}</th>
                            <th>{{ $t('Name') }}</th>
                            <th>{{ $t('Seat') }}</th>
                            <th>{{ $t('Status') }}</th>
                            <th>{{ $t('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(list, index ) in lists" :key="list.id">
                            <td>{{ ++index }}</td>
                            <td>{{ list.name }}</td>
                            <td>{{ list.seat }} {{$t('person')}}</td>
                            <td>
                                <span class="badge" :class="list.status ? 'badge-success' : 'badge-warning'">{{list.status ? $t('Activated') : $t('Deactivated')}}</span>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="editYear(list)"><i class="far fa-edit"></i> {{$t('Edit')}}</button>
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
                        <h5 class="modal-title" id="myModalLabel">{{ editMode ? $t('Update') : $t('Add New') }} {{$t('Academic_Group') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateYear() : createYear()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <form-group-input :form="form" v-model="form.name" name="name" :label="$t('Name')"></form-group-input>
                            <form-group-input :form="form" v-model="form.seat" name="seat" :label="$t('Seat')"></form-group-input>
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
    name: "AcademicYear",
    data(){
        return{
            form: new Form({
                name : '',
                seat : '',
                status : true
            }),
            editMode: false,
            editId: null,
            lists: {}
        }
    },
    methods:{
        openMyModal() {
            this.form.reset();
            this.form.clear();
            this.editMode = false;
            this.editId = null;
            $('#myModal').modal('show');
        },
        editYear(scale) {
            this.openMyModal();
            this.editMode = true;
            this.editId = scale.id;
            this.form.fill(scale);
        },
        createYear() {
            this.form.post('/api/academic-years')
                .then(() => {
                    this.loadAcademicYear();
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message_create')
                    })
                })
        },
        updateYear() {
            this.form.put('/api/academic-years/' + this.editId)
                .then(() => {
                    this.loadAcademicYear();
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message_update')
                    })
                })
        },
        loadAcademicYear(){
            axios.get('/api/academic-years').then(({data}) => this.lists = data)
        },
    },
    created(){
        this.loadAcademicYear();
    }
}
</script>

<style scoped>

</style>
