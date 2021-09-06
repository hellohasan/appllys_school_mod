<template>
    <custom-card
        :title="$t('Admission_list')"
        :url="'/admissions/add'"
        :text="$t('New_admission')"
        :icon="'fas fa-plus'">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="session_id">Select Session</label>
                <custom-select :options="sessions" @change="changeSession" v-model="form.session_id" :placeholder="$t('Select_One')" name="session_id"></custom-select>
                <has-error :form="form" field="session_id"></has-error>
            </div>
        </div>
        <hr>

        <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
            <tr>
                <th>{{ $t('Register At') }}</th>
                <th>Academic ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Guardian Name</th>
                <th>Class</th>
                <th>Department?</th>
                <th>Status</th>
                <th>{{ $t('Action') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(list, index ) in lists" :key="list.id">
                <td>{{ list.created_at | myDate }}</td>
                <td>{{ list.user.custom }}</td>
                <td>
                    <img class="img-thumbnail" :src="list.user.photo" style="width: 100px;height: 100px">
                </td>
                <td>{{ list.user.name }}</td>
                <td>{{ list.user.guardian.guardian.name }}</td>
                <td>{{ list.academic.class.name }}</td>
                <td>
                    <template v-if="list.academic.group_department">{{list.academic.group_department.name}}</template>
                    <template v-else>N/A</template>
                </td>
                <td>
                    <span class='badge' :class="list.status ? 'badge-success' : 'badge-warning'">{{list.status ? 'Approved' : 'Pending'}}</span>
                </td>
                <td>
                    <router-link :to="`/admissions/view/${list.user.custom}`" class="btn btn-success btn-sm" v-tooltip="'Show Admission'"><i class="far fa-eye"></i></router-link>
                    <button class="btn btn-danger btn-sm" @click="deleteUser(list.id)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            </tbody>
        </table>


    </custom-card>
</template>

<script>
require('datatables.net-bs4/js/dataTables.bootstrap4.min')
import CustomSelect from "../../globals/CustomSelect";
export default {
    name: "Index",
    components:{
        CustomSelect
    },
    data() {
        return {
            form: new Form({
                session_id: ''
            }),
            sessions:{},
            lists:{}
        }
    },
    methods: {
        changeSession(e){
            this.form.post('/api/get-admission-list').then((res) => {
                this.lists = res.data
                this.$nextTick(()=> {
                    $('#sampleTable').DataTable();
                })
            })
        },
        loadOnlySessionList() {
            axios.get('/api/load-only-session-list').then(({data}) => this.sessions = data)
        },
    },
    created() {
        this.loadOnlySessionList();
    }
}
</script>

<style scoped>

</style>
