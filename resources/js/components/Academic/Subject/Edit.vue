<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">{{ $t('Subject_Edit') }}</h3>
            <div class="card-tools">
                <router-link class="btn btn-success" to="/academic-subject">
                    <i class="fas fa-lists fa-w"></i> {{ $t('Subject_list') }}
                </router-link>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-3">
            <form method="post" @submit.prevent="updateAcademicSubject">

                <div class="alert alert-success" role="alert">
                    <div class="d-flex justify-content-around bd-highlight">
                        <div class="p-2 bd-highlight font-weight-bold font">Class: {{class_name }}</div>
                        <template v-if="form.academic_class_type == 1">
                            <div class="p-2 bd-highlight font-weight-bold ">Group: {{group_name}}</div>
                        </template>

                        <template v-if="form.academic_class_type == 2">
                            <div class="p-2 bd-highlight font-weight-bold ">Department: {{department_name}}</div>
                            <div class="p-2 bd-highlight font-weight-bold ">Year: {{section_name}}</div>
                        </template>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Subject Name</label>
                            <input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" placeholder="Subject Name" class="form-control">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Subject Code</label>
                            <input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" placeholder="Subject Code" class="form-control">
                            <has-error :form="form" field="code"></has-error>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mark_type">Mark Type</label>
                            <Select2 :options="mark_types" v-model="form.mark_type" placeholder="Select One"></Select2>
                            <has-error :form="form" field="mark_type"></has-error>
                        </div>
                    </div>
                    <template v-if="form.mark_type === '0'">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_mark">Full Mark</label>
                                <input type="number" v-model="form.full_mark" :class="{ 'is-invalid': form.errors.has('full_mark') }" id="full_mark" placeholder="Full Mark" class="form-control">
                                <has-error :form="form" field="full_mark"></has-error>
                            </div>
                        </div>
                    </template>
                    <template v-if="form.mark_type === '1'">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="theory">Theory Mark</label>
                                <input type="number" v-model="form.theory" :class="{ 'is-invalid': form.errors.has('theory') }" id="theory" placeholder="Theory Mark" class="form-control">
                                <has-error :form="form" field="theory"></has-error>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="practical">Practical Mark</label>
                                <input type="number" v-model="form.practical" :class="{ 'is-invalid': form.errors.has('practical') }" id="practical" placeholder="Practical Mark" class="form-control">
                                <has-error :form="form" field="practical"></has-error>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subject_type">Subject Type</label>
                            <Select2 :options="subject_types" v-model="form.subject_type" placeholder="Select One"></Select2>
                            <has-error :form="form" field="subject_type"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <template v-if="form.subject_type === '0'">
                            <div class="form-group">
                                <label for="point">Total Point</label>
                                <input type="number" step="0.01" v-model="form.point" id="point" :class="{ 'is-invalid': form.errors.has('point') }" placeholder="Total Point" class="form-control">
                                <has-error :form="form" field="point"></has-error>
                            </div>
                        </template>
                        <template v-if="form.subject_type === '1'">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="total_point">Total Point</label>
                                    <input type="number" step="0.01" id="total_point" v-model="form.total_point" :class="{ 'is-invalid': form.errors.has('total_point') }" placeholder="Total Point" class="form-control">
                                    <has-error :form="form" field="total_point"></has-error>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="optional_point">Optional Point</label>
                                    <input type="number" step="0.01" v-model="form.optional_point" :class="{ 'is-invalid': form.errors.has('optional_point') }" id="optional_point" placeholder="Optional Point" class="form-control">
                                    <has-error :form="form" field="optional_point"></has-error>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion_type">Religion Type</label>
                            <Select2 :options="religion_types" v-model="form.religion_type" placeholder="Select One"></Select2>
                            <has-error :form="form" field="religion_type"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <template v-if="form.religion_type === '1'">
                            <div class="form-group">
                                <label for="religion_id">Select Religion</label>
                                <Select2 :options="religions" v-model="form.religion_id" placeholder="Select One"></Select2>
                                <has-error :form="form" field="religion_id"></has-error>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <v-toggle v-model="form.status" :options="checkOptions" :disabled="false" :class="{ 'is-invalid': form.errors.has('status') }" id="status"/>
                    <has-error :form="form" field="status"></has-error>
                </div>
                <v-button :loading="form.busy">{{ $t('Update') }}</v-button>
            </form>
        </div>
    </div>
</template>

<script>
import Select2 from "../../globals/Select2";
import CustomSelect from "../../globals/CustomSelect";
import CustomSelectEmpty from "../../globals/CustomSelectEmpty";
import VToggle from "../../globals/VToggle";

export default {
    name: "Edit",
    components: {
        Select2, CustomSelect, CustomSelectEmpty, VToggle
    },
    data() {
        return {
            form: new Form({
                academic_class_id: '',
                academic_class_type: '',
                academic_group_id: '',
                academic_department_id: '',
                academic_section_id: '',
                name: '',
                code: '',
                mark_type: '',
                full_mark: '',
                theory: '',
                practical: '',
                subject_type: '',
                total_point: '',
                point:'',
                optional_point: '',
                religion_type: '',
                religion_id: '',
                status: ''
            }),
            mark_types: [
                {id: 0, text: 'Straight Mark'},
                {id: 1, text: 'Partial mark'}
            ],
            subject_types: [
                {id: 0, text: 'Compulsory Subject'},
                {id: 1, text: 'Optional Subject'}
            ],
            religion_types: [
                {id: 0, text: 'Non Religious'},
                {id: 1, text: 'Religious Subject'}
            ],
            checkOptions: {
                on: 'ACTIVATED',
                off: 'DEACTIVATED',
                onstyle: 'success',
                offstyle: 'danger',
                width: '100%'
            },
            religions: {},
            class_name: '',
            group_name: '',
            department_name: '',
            section_name: ''
        }
    },
    methods: {
        updateAcademicSubject() {
            this.form.put('/api/update-academic-subject/'+this.$route.params.id).then((res)=>{
                Toast.fire({
                    icon: 'success',
                    title: this.$t('success_message')
                })
                //this.$router.push('/academic-subject')
            })
        },
        loadReligionList() {
            axios.get('/api/load-religion-list').then((res) => this.religions = res.data);
        },
        loadSubjectEdit(){
            axios.get('/api/edit-academic-subject/'+this.$route.params.id).then((res)=>{
                this.form.fill(res.data)
                let details = res.data;
                this.class_name = details.academic_class.name

                if(res.data.academic_class_type == 1){
                    this.group_name = details.academic_group.name
                } else if(res.data.academic_class_type == 2){
                    this.department_name = details.academic_department.name
                    this.section_name = details.academic_section.name
                }
            })
        }
    },
    created() {
        this.loadReligionList();
        this.loadSubjectEdit()
    }
}
</script>

<style scoped>

</style>
