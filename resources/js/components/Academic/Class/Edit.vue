<template>
    <form @submit.prevent="updateAcademicClass" class="p-3">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" placeholder="Class Name" class="form-control">
                    <has-error :form="form" field="name"></has-error>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="code">Class Code</label>
                    <input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" placeholder="Class Code" class="form-control">
                    <has-error :form="form" field="code"></has-error>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="academic_grading_id">Grading Type</label>
                    <Select2 :options="gradings" v-model="form.academic_grading_id" placeholder="Select One"></Select2>
                    <has-error :form="form" field="academic_grading_id"></has-error>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <v-toggle v-model="form.status" :options="checkOptions" :disabled="false" :class="{ 'is-invalid': form.errors.has('status') }" id="status"/>
                    <has-error :form="form" field="status"></has-error>
                </div>
            </div>
        </div>


        <template v-if="type == 2">
            <div class="form-group" v-if="this.departments.length">
                <label for="type">Select Departments</label>
                <v-select :options="departments" multiple="true" v-model="form.academic_department_ids" placeholder="Select One" name="academic_department_ids"></v-select>
                <has-error :form="form" field="academic_department_ids"></has-error>
            </div>
        </template>

        <template v-if="type == 1">
            <div class="form-group" v-if="this.groups.length">
                <label for="type">Select Groups</label>
                <v-select :options="groups" multiple="true" v-model="form.academic_group_ids" placeholder="Select One" name="academic_groups_ids"></v-select>
                <has-error :form="form" field="academic_groups_ids"></has-error>
            </div>
        </template>

        <template v-if="type == 0">
            <div class="form-group" v-if="this.sections.length">
                <label for="type">Select Sections</label>
                <v-select :options="sections" multiple="true" v-model="form.academic_section_ids" name="academic_section_ids"></v-select>
                <has-error :form="form" field="academic_section_ids"></has-error>
            </div>
        </template>

        <v-button :loading="form.busy">{{ $t('Update') }}</v-button>
    </form>
</template>

<script>
import VToggle from "../../globals/VToggle"
import Select2 from "../../globals/Select2"
import VSelect from "../../globals/VSelect";
import CustomSelect from "../../globals/CustomSelect";

export default {
    name: "Edit",
    components: {
        VToggle, Select2,VSelect,CustomSelect
    },
    data() {
        return {
            form: new Form({
                name: '',
                code: '',
                academic_grading_id:'',
                status: true,
                academic_department_ids: [],
                academic_group_ids: [],
                academic_section_ids: []
            }),
            checkOptions: {
                on: 'ACTIVATED',
                off: 'DEACTIVATED',
                onstyle: 'success',
                offstyle: 'danger',
                width: '100%'
            },
            gradings: {},
            type: '',
            groups:{},
            departments:{},
            sections:{},
            types: [
                {id: 0, text: 'Only Section Available'},
                {id: 1, text: 'Group Available'},
                {id: 2, text: 'Department Available'},
            ],
        }
    },
    methods: {
        updateAcademicClass() {
            this.form.put('/api/academic-class-update/' + this.$route.params.id)
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                    this.$router.push('/academic-class')
                })
                .catch(error=> {
                if (error.response.status == 422){
                    this.$router.go(this.$router.currentRoute)
                    Swal.fire({
                        icon: 'error',
                        title: this.$t('error_alert_title'),
                        text: this.$t('error_alert_text')
                    })
                }
            })
        },
        loadEditClass() {
            axios.get(`/api/edit-academic-classes/${this.$route.params.id}`)
                .then(({data}) => {
                    this.type = data.type
                    this.form.fill(data)
                    if (data.type === 2){
                        this.form.academic_department_ids = data.academic_departments.map(section => section.id)
                    }else if (data.type === 1){
                        this.form.academic_group_ids = data.academic_groups.map(section => section.id)
                    }else{
                        this.form.academic_section_ids = data.sections.map(section => section.id)
                    }
                })
        },
        loadAcademicGrading() {
            axios.get('/api/load-academic-grading-list').then((res) => this.gradings = res.data)
        },
        loadAcademicGroups(){
            axios.get('/api/load-academic-group-list').then((res)=>this.groups = res.data)
        },
        loadAcademicDepartments(){
            axios.get('/api/load-academic-department-list').then((res) => this.departments = res.data)
        },
        loadAcademicSections(){
            axios.get('/api/load-academic-section-list').then((res) => this.sections = res.data)
        }
    },
    created() {
        this.loadAcademicGrading()
        this.loadEditClass()
        this.loadAcademicGroups()
        this.loadAcademicDepartments()
        this.loadAcademicSections()
    }
}
</script>

<style scoped>

</style>
