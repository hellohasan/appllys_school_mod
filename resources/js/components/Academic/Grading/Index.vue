<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Status</th>
                <th>Grade Details</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(grade,index) in grades" :key="index">
                <td>{{++index}}</td>
                <td>{{grade.name}}</td>
                <td>
                    <span class="badge" :class="grade.status ? 'badge-success' : 'badge-warning'">{{grade.status ? 'Activated' : 'Deactivated'}}</span>
                </td>
                <td>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Letter</th>
                            <th>Percentage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(p,i) in grade.percentages" :key="i">
                            <td>{{p.name}}</td>
                            <td>{{p.min_percentage}}% - {{p.max_percentage}}%</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <router-link :to="`/academic-grading/${grade.id}/edit`" class="btn btn-sm btn-primary font-weight-bold"><i class="fas fa-edit"></i> Edit</router-link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Index",
    data(){
        return{
            grades: {}
        }
    },
    methods:{
        loadGrades(){
            axios.get('/api/load-academic-grade-list').then((res)=>this.grades = res.data)
        }
    },
    created(){
        this.loadGrades()
    }
}
</script>

<style scoped>

</style>
