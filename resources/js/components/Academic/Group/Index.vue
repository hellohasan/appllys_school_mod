<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ $t('Academic_Group') }}</h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" @click="openMyModal"><i class="fas fa-plus fa-w"></i>
                            {{ $t('Add New') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="ph-item" v-if="!groups.length">
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
                            <th>{{ $t('Name') }}</th>
                            <th>{{ $t('Section') }}</th>
                            <th>{{ $t('Current_student') }}</th>
                            <th>{{ $t('Total_student') }}</th>
                            <th>{{ $t('Status') }}</th>
                            <th>{{ $t('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(group, index ) in groups" :key="group.id">
                            <td>{{ ++index }}</td>
                            <td>{{ group.name }}</td>
                            <td>
                                <span class="badge badge-primary ml-2" v-for="(s,i) in group.sections">{{s.name}}</span>
                            </td>
                            <td>0 {{$t('person')}}</td>
                            <td>0 {{$t('person')}}</td>
                            <td>
                                <span class="badge" :class="group.status ? 'badge-success' : 'badge-warning'">{{group.status ? $t('Activated') : $t('Deactivated')}}</span>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="editGroup(group)"><i class="far fa-edit"></i> {{$t('Edit')}}</button>
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

                    <form @submit.prevent="editMode ? updateGroup() : createGroup()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <form-group-input :form="form" v-model="form.name" name="name" :label="$t('Name')"></form-group-input>
                            <div class="form-group">
                                <label for="type">Select Sections</label><br>
                                <v-select :options="sections" multiple="true" v-model="form.academic_section_ids" name="academic_section_ids"></v-select>
                                <has-error :form="form" field="academic_section_ids"></has-error>
                            </div>
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
import VSelect from "../../globals/VSelect";

export default {
    name: "Group",
    components:{
        VSelect
    },
    data(){
        return{
            form: new Form({
                name: '',
                academic_section_ids: [],
                status: false
            }),
            groups:{},
            sections:[],
            editMode: false,
            editId: null
        }
    },
    methods: {
        openMyModal() {
            this.form.reset();
            this.form.clear();
            this.editMode = false;
            this.editId = null;
            $('#myModal').modal('show');
        },
        editGroup(scale) {
            this.openMyModal();
            this.editMode = true;
            this.editId = scale.id;
            this.form.name = scale.name
            this.form.status = scale.status
            this.form.academic_section_ids = scale.sections.map(section => section.id)
        },
        createGroup() {
            this.form.post('/api/academic-groups')
                .then(() => {
                    this.loadGroupList();
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message_create')
                    })
                })
        },
        updateGroup() {
            this.form.put('/api/academic-groups/' + this.editId)
                .then(() => {
                    this.loadGroupList();
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message_update')
                    })
                })
        },
        loadGroupList() {
            axios.get('/api/academic-groups').then((res) => {
                this.groups = res.data
            })
        },
        loadAcademicSectionList() {
            axios.get('/api/load-academic-section-list').then((res) => {
                this.sections = res.data
            })
        }
    },
    created() {
        this.loadGroupList();
        this.loadAcademicSectionList();
    }
}
</script>

<style scoped>

</style>
