<template>
    <form @submit.prevent="updateAcademicGrade" class="p-3">
        <div class="alert alert-danger" role="alert" v-show="Object.keys(this.form.errors.errors).length > 1">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Warring.!</h4>
            <ul class="list-group">
                <li class="list-group-item" v-for="err in this.form.errors.errors">{{err[0]}}</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Grading Title</label>
                    <input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="title" placeholder="Grade Title" class="form-control">
                    <has-error :form="form" field="name"></has-error>
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
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between border-bottom">
                    <h4>Grade List</h4>
                    <button type="button" class="btn btn-success btn-sm" @click="addNew" v-tooltip="'Click here to add another Grade'">
                        <i class="fas fa-plus"></i> Add Grade
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row group-markup mt-2" v-for="(grade,i) in form.percentages" :key="i">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="letter">Grade Letter</label>
                            <input type="text" v-model="grade.name" placeholder="Grade Letter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="min_percent">Minimum Percentage</label>
                            <div class="input-group">
                                <input type="number" v-model="grade.min_percentage" aria-describedby="basic-addon3" placeholder="Minimum Percentage" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-percentage"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="max_percentage">Maximum Percentage</label>
                            <div class="input-group mb-3">
                                <input type="number" v-model="grade.max_percentage" aria-describedby="basic-addon2" placeholder="Maximum Percentage" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-percentage"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" @click="deleteNew(i)" class="btn btn-danger btn-sm delete_group cursor-pointer" v-tooltip="'Remove Grade'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <v-button class="mt-2" :loading="form.busy">{{ $t('Update') }}</v-button>
    </form>
</template>

<script>
import VToggle from "../../globals/VToggle";

export default {
    name: "Edit",
    components: {
        VToggle
    },
    data() {
        return {
            form: new Form({
                name: '',
                status: 1,
                percentages: [
                    {
                        name: '',
                        min_percentage: '',
                        max_percentage: '',
                    }
                ]
            }),
            checkOptions: {
                on: 'ACTIVATED',
                off: 'DEACTIVATED',
                onstyle: 'success',
                offstyle: 'danger',
                width: '100%'
            },
        }
    },
    methods:{
        addNew(){
            this.form.percentages.push({
                name: '',
                min_percentage: '',
                max_percentage: '',
            })
        },
        deleteNew(index){
            if (this.form.percentages.length > 1){
                this.form.percentages.splice(index, 1)
            }
        },
        updateAcademicGrade(){
            this.form.put('/api/update-academic-grade/'+this.$route.params.id).then((response) => {
                Toast.fire({
                    icon: 'success',
                    title: this.$t('success_message')
                })
                this.$router.push('/academic-grading')
            })
        },
        loadGrading(){
            axios.get('/api/edit-academic-grade/'+this.$route.params.id).then((res)=>this.form.fill(res.data))
        }
    },
    created(){
        this.loadGrading()
    }
}
</script>

<style scoped>
.group-markup {
    border: 1px solid #ddd;
    padding: 10px 0 0 0;
    border-radius: 5px 5px 0 5px;
    margin: 0;
    position: relative;
}

.delete_group {
    position: absolute;
    right: 0;
    top: 0;
}
</style>
