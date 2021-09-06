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


        <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config"></vue-bootstrap4-table>

    </custom-card>
</template>

<script>
import VueBootstrap4Table from 'vue-bootstrap4-table'
import CustomSelect from "../../globals/CustomSelect";
export default {
    name: "Index",
    components: {
        VueBootstrap4Table,CustomSelect
    },
    data: function () {
        return {
            form: new Form({
                session_id: ''
            }),
            sessions:[],
            rows: [],
            columns: [
                {label: "Admission ID", name: "user.custom", sort: true},
                {label: "Name", name: "user.name", sort: true},
                {label: "Phone", name: "user.phone", sort: true},
                {label: "Class", name: "user.phone", sort: true}
            ],
            config: {
                checkbox_rows: false,
                rows_selectable: true,
                card_title: "Admission List"
            }
        }
    },
    methods: {
        changeSession(e){
            this.config.card_title = this.sessions.find(list => list.id == e).text+' Admission List'
            this.form.post('/api/get-admission-list').then((res) => this.rows = res.data)
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
