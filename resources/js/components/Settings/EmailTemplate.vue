<template>
    <card :title="$t('Email_template')">
        <form @submit.prevent="submitEmailTemplate" role="form" method="post">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <summernote v-model="form.content" :height="320" :class="{ 'is-invalid': form.errors.has('content') }"></summernote>
                        <has-error :form="form" field="content"></has-error>
                    </div>
                    <div class="form-group">
                        <v-button :loading="form.busy">
                            <i class="fas fa-cogs"></i> {{ $t('update') }}
                        </v-button>
                    </div>
                </div>
            </div>
        </form>
    </card>
</template>

<script>
import Summernote from "../globals/Summernote";
export default {
    name: "EmailTemplate",
    components: {
        Summernote
    },
    data(){
        return{
            form: new Form({
                content: ''
            })
        }
    },
    methods:{
        submitEmailTemplate(){
            this.form.post('api/update-email-template')
            .then(()=>{
                Toast.fire({
                    icon: 'success',
                    title: this.$t('success_message')
                })
            })
        },
        loadEmailTemplate(){
            axios.get('/api/get-email-template').then((res)=> (this.form.content = res.data))
        }
    },
    mounted() {
        this.loadEmailTemplate()
    }
}
</script>

<style scoped>

</style>
