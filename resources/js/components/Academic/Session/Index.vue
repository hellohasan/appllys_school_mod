<template>
    <div>
        <div class="ph-item" v-if="!sessions.length">
            <div class="ph-col-12">
                <div class="ph-row">
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
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
                <th>{{ $t('Title') }}</th>
                <th>{{ $t('Duration') }}</th>
                <th>{{ $t('Code') }}</th>
                <th>{{ $t('Off_day') }}</th>
                <th>{{ $t('Status') }}</th>
                <th>{{ $t('Activated') }}</th>
                <th>{{ $t('Action') }}</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="session in sessions" :key="session.id">
                    <td>{{ session.id }}</td>
                    <td>{{ session.title }}</td>
                    <td>{{ session.duration }}</td>
                    <td>{{ session.code }}</td>
                    <td>{{ session.off_day }}</td>
                    <td>
                        <span v-if="session.status" class="badge badge-primary font-weight-bold text-uppercase">{{$t('Activated')}}</span>
                        <span v-else class="badge badge-danger font-weight-bold text-uppercase">{{$t('Deactivated')}}</span>
                    </td>
                    <td>
                        <span v-if="session.isCurrent" class="badge badge-success font-weight-bold text-uppercase">{{$t('Running')}}</span>
                        <span v-else class="badge badge-danger font-weight-bold text-uppercase">{{$t('PassOut')}}</span>
                    </td>
                    <td>
                        <router-link :to="`/academic-session/${session.id}/edit`" class="btn btn-success btn-sm text-uppercase font-weight-bold"><i class="far fa-edit"></i> {{$t('Edit')}}</router-link>
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
            sessions: []
        }
    },
    methods:{
        loadSessions(){
            axios.get("api/academic-sessions").then(res=>{
                this.sessions = res.data
            })
        }
    },
    created() {
        this.loadSessions();
    }
}
</script>

<style scoped>

</style>
