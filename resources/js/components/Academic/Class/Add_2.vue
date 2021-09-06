<template>
    <div>

<!--

<template v-if="form.type === '2'">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between border-bottom">
                        <h4>Departments</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-2 area" v-for="(department,i) in form.departments" :key="i">
                        <div class="d-flex justify-content-between">
                            <label for="deptName">{{department.name}} Department</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 pl-3">
                            <label>Add {{department.name}} Department Years</label>
                            <button type="button" class="btn btn-success btn-sm" @click="addSec(i)">
                                <i class="fas fa-plus"></i> Add Year
                            </button>
                        </div>
                        <div v-for="(s, ii) in department.sections" :key="ii" class="pl-3">
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="s.name" placeholder="Write Department Year Name">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" @click="deleteSec(i, ii)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template v-if="form.type === '1'">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between border-bottom">
                        <h4>Groups</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-2 area" v-for="(group,i) in form.groups" :key="i">
                        <div class="d-flex justify-content-between">
                            <label for="groupName">{{group.name}} Group</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 pl-3">
                            <label>Add {{group.name}} Group Sections</label>
                            <button type="button" class="btn btn-success btn-sm" @click="addSecGroup(i)">
                                <i class="fas fa-plus"></i> Add Section
                            </button>
                        </div>
                        <div v-for="(s, ii) in group.sections" :key="ii" class="pl-3">
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="s.name" placeholder="Write Group Section Name">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="button" @click="deleteSecGroup(i, ii)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>


-->



        <button class="btn btn-success mt-5" @click="addNew">
            Add new
        </button>

        <div class="card mb-3 p-3" v-for="(employee, index) in employees" :key="index">
            <h4 class="card-title">Add Employee (Index: {{index}})</h4>
            <div class="card-body p-0">
                <span class="float-right" style="cursor: pointer" @click="deleteNew(index)">X</span>
                <div class="employee-form">
                    <input type="text" v-model="employee.name" class="form-control mb-2" placeholder="Name">

                    <p>Sections <span @click="addSec(index)">Add Section</span></p>
                    <div v-for="(section, i) in employee.sections">
                        <span @click="deleteSec(index,i)">C</span>
                        <input type="text" v-model="section.sec" class="form-control mb-2" placeholder="Name">
                    </div>

                </div>
            </div>
        </div>
    </div>


</template>

<script>
export default {
    name: "Add_2",
    data(){
        return{

            employees:[
                {
                    name: '',
                    sections:[{
                        sec: ''
                    }]
                }
            ]

        }
    },
    methods:{
        addNew(){
            this.employees.push({
                name: '',
                sections:[{
                    sec: ''
                }]
            })
        },
        deleteNew(index){
            this.employees.splice(index, 1)
        },
        addSec(index){
            this.employees[index].sections.push({
                sec: ''
            })
        },
        deleteSec(index,i){
            this.employees[index].sections.splice(i, 1)
        }
    }
}
</script>

<style scoped>

</style>
