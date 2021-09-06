<template>
    <form @submit.prevent="updateTeacher" class="p-3">

        <div class="alert alert-danger" role="alert" v-show="Object.keys(this.form.errors.errors).length">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Warring.!</h4>
            <ul class="list-group">
                <li class="list-group-item" v-for="err in this.form.errors.errors" :key="err[0]">{{err[0]}}</li>
            </ul>
        </div>
        
        <div class="form-row">
            <form-group-input :form="form" v-model="form.name" col="col-md-4" name="name" :label="$t('Name')"></form-group-input>
            <form-group-input :form="form" v-model="form.code" col="col-md-4" name="code" :label="$t('TeacherCode')"></form-group-input>
            <form-group-image :form="form" size="200" v-model="form.image" col="col-md-4" name="image" :label="$t('TeacherImage')"></form-group-image>

            <form-group-input :form="form" type="email" v-model="form.email" col="col-md-4" name="email" :label="$t('Email')"></form-group-input>
            <form-group-input :form="form" v-model="form.phone" col="col-md-4" name="phone" :label="$t('Phone')"></form-group-input>
            <form-group-select col="col-md-4" :options="designations" label="Select Designation" id="designation_id" v-model="form.designation_id" :form="form"></form-group-select>
            <form-group-select col="col-md-4" :options="scales" label="Select Salary Scale" id="salary_scale_id" v-model="form.salary_scale_id" :form="form"></form-group-select>
            <form-group-select col="col-md-4" :options="religions" label="Select Religious" id="religion_id" v-model="form.religion_id" :form="form"></form-group-select>
            <form-group-select col="col-md-4" :options="bloods" label="Select Blood Group" id="blood" v-model="form.blood" :form="form"></form-group-select>
        </div>
        <div class="form-row">
            <form-group-input :form="form" type="date" v-model="form.join_date" col="col-md-4" name="join_date" :label="$t('JoinDate')"></form-group-input>
            <form-group-input :form="form" type="password" v-model="form.password" col="col-md-4" name="password" :label="$t('password')"></form-group-input>
            <form-group-input :form="form" type="password" v-model="form.password_confirmation" col="col-md-4" name="password_confirmation" :label="$t('confirm_password')"></form-group-input>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="division_id">Teacher Type</label>
                <custom-select :options="types" @change="typeChange" v-model="form.type" :placeholder="$t('Select_One')" name="type"></custom-select>
                <has-error :form="form" field="type"></has-error>
            </div>
            <div class="form-group col-md-6">
                <label for="present_district_id">Select Group/Department</label>
                <custom-select-empty :options="lists" v-model="form.type_id" :placeholder="$t('Select_One')" name="type_id"></custom-select-empty>
                <has-error :form="form" field="type_id"></has-error>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between border-bottom">
                    <h4>Educations</h4>
                    <button type="button" class="btn btn-success btn-sm" @click="addNew">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
                <div class="form-group" v-for="(edu, index) in form.educations" :key="index">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="edu.name" placeholder="Education Details" aria-label="Section Name" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" @click="deleteNew(index)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <v-button :loading="form.busy">{{ $t('Update') }}</v-button>
    </form>
</template>

<script>
import CustomSelect from "../globals/CustomSelect";
import CustomSelectEmpty from "../globals/CustomSelectEmpty";

export default {
    name: "Edit",
    components:{
        CustomSelect,CustomSelectEmpty
    },
    data(){
        return{
            form: new Form({
                name: '',
                email:'',
                code:'',
                phone:'',
                join_date:'',
                designation_id:'',
                salary_scale_id:'',
                type: '',
                image: '',
                type_id : '',
                religion_id: '',
                blood:'',
                educations:[
                    {name:''}
                ]
            }),
            types:[
                {id:0, text: 'Select Group'},
                {id:1, text: 'Select Department'}
            ],
            designations: [],
            scales: [],
            religions: [],
            bloods: [],
            lists: []
        }
    },
    methods:{
        updateTeacher(){
            this.form.put('/api/teacher-update/'+this.$route.params.custom).then((res)=>{
                Toast.fire({
                    icon: 'success',
                    title: this.$t('success_message_update')
                })
                this.$router.push('/teachers')
            })
        },
        typeChange(e){
            if (e === '1'){
                axios.get('/api/load-academic-department-list').then(({data})=> this.lists = data)
            }else{
                axios.get('/api/load-academic-group-all-list').then(({data})=> this.lists = data)
            }
        },
        addNew() {
            this.form.educations.push({
                name: ''
            })
        },
        deleteNew(index){
            if (this.form.educations.length > 1){
                this.form.educations.splice(index, 1)
            }
        },
        loadDesignationList(){
            axios.get('/api/load-designation-list').then(({data})=>this.designations = data)
        },
        loadSalaryScaleList(){
            axios.get('/api/load-salary-scale-list').then(({data})=>this.scales = data)
        },
        loadReligiousList(){
            axios.get('/api/load-religion-list').then(({data})=>this.religions = data)
        },
        loadBloodList(){
            axios.get('/api/load-blood-list').then(({data})=>this.bloods = data)
        },
        editTeacher(){
            axios.get('/api/teacher-edit/'+this.$route.params.custom).then(({data})=>{
                this.form.name = data.name
                this.form.email = data.email
                this.form.phone = data.phone
                this.form.code= data.teacher.code
                this.form.join_date= data.teacher.join_date
                this.form.designation_id= data.teacher.designation_id
                this.form.salary_scale_id= data.teacher.salary_scale_id
                this.form.type= data.teacher.type
                this.form.type_id = data.teacher.academic_department_id
                this.form.religion_id= data.teacher.religion_id
                this.form.blood= data.teacher.blood
                this.form.educations= data.teacher.educations
            })
        }
    },
    created(){
        this.loadDesignationList();
        this.loadSalaryScaleList()
        this.loadReligiousList()
        this.loadBloodList()
        this.editTeacher()
    }
}
</script>

<style scoped>

</style>
