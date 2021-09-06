<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ $t('ClassPeriod') }}</h3>
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
                            <th>{{ $t('Title') }}</th>
                            <th>{{ $t('Displayed') }}</th>
                            <th>{{ $t('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(list, index ) in lists" :key="list.id">
                            <td>{{ ++index }}</td>
                            <td>{{ list.title }}</td>
                            <td>{{ list.show }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="editClassPeriod(list)"><i class="far fa-edit"></i> {{$t('Edit')}}</button>
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
                        <h5 class="modal-title" id="myModalLabel">{{ editMode ? $t('Update') : $t('New') }} {{$t('ClassPeriod') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateClassPeriod() : createClassPeriod()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <form-group-input :form="form" v-model="form.title" name="title" :label="$t('Title')"></form-group-input>
                            <form-group-input type="time" :form="form" v-model="form.start" name="start" :label="$t('StartTime')"></form-group-input>
                            <form-group-input type="time" :form="form" v-model="form.end" name="end" :label="$t('EndTime')"></form-group-input>
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
    name: "ClassPeriod",
    data(){
        return{
            form: new Form({
                title : '',
                start : '',
                end : '',
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
        editClassPeriod(scale) {
            this.openMyModal();
            this.editMode = true;
            this.editId = scale.id;
            this.form.fill(scale);
        },
        createClassPeriod() {
            this.form.post('/api/class-periods')
                .then(() => {
                    this.loadClassPeriods();
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message_create')
                    })
                })
        },
        updateClassPeriod() {
            this.form.put('/api/class-periods/' + this.editId)
                .then(() => {
                    this.loadClassPeriods();
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message_update')
                    })
                })
        },
        loadClassPeriods(){
            axios.get('/api/class-periods').then(({data}) => this.lists = data)
        }
    },
    created(){
        this.loadClassPeriods();
    }
}
</script>

<style scoped>

</style>
