<template>
    <div class="table-responsive p-2">
        <table class="table table-hover table-bordered" id="sampleTable">

            <thead>
            <tr>
                <th>SL</th>
                <th>Academic ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Department?</th>
                <th>Blood</th>
                <th>SalaryScale</th>
                <th>Status</th>
                <th>{{ $t('Action') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(list, index ) in lists" :key="list.id">
                <td>{{++index}}</td>
                <td>{{list.custom}}</td>
                <td>
                    <img class="img-thumbnail" :src="list.photo" style="width: 100px;height: 100px">
                </td>
                <td>{{ list.name }}</td>
                <td>{{ list.email }}</td>
                <td>{{ list.phone }}</td>
                <td>{{ list.teacher.designation.title }}</td>
                <td>
                    <template v-if="list.teacher.type === 1">{{ list.teacher.academic_department.name }}</template>
                    <template v-else>{{ list.teacher.academic_group.name }}</template>
                </td>
                <td>{{ list.teacher.blood }}</td>
                <td>{{ list.teacher.salary_scale.title }}</td>
                <td>
                    <span class='badge' :class="list.status ? 'badge-success' : 'badge-warning'">{{ list.status ? 'Approved' : 'Pending' }}</span>
                </td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <router-link :to="`/teachers/${list.custom}/edit`" type="button" v-tooltip="'Edit'" class="btn btn-success"><i class="far fa-edit"></i></router-link>
                        <button type="button" v-tooltip="'Show'" class="btn btn-primary"><i class="far fa-eye"></i></button>
                        <button type="button" @click="deleteUser(list.id)" v-tooltip="'Delete'" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import('datatables.net-bs4/js/dataTables.bootstrap4.min')

export default {
    name: "Index",
    data(){
        return{
            lists: []
        }
    },
    methods:{
        myTable(){
            this.$nextTick(()=> {
                $('#sampleTable').DataTable();
            })
        },
        getTeachers(){
            axios.get('/api/teacher-list').then(({data}) => {
                this.lists = data
                this.myTable()
            })
        }
    },
    created() {
        this.getTeachers();
    }

}
</script>

<style scoped>

</style>
