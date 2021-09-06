<template>
    <card :title="$t('Sms_setting')">
        <div class="row">
            <div class="col-md-12">
                <div class="table-scrollable">
                    <table class="table table-striped bg-info table-bordered">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> CODE</th>
                            <th> DESCRIPTION</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> 1</td>
                            <td> username=*******</td>
                            <td> Replace ******** With your username.</td>
                        </tr>
                        <tr>
                            <td> 2</td>
                            <td> password=*******</td>
                            <td> Replace ******** With your password.</td>
                        </tr>

                        <tr>
                            <td> 3</td>
                            <td> {{ message }}</td>
                            <td> Message Text. Which Text User Receive.</td>
                        </tr>

                        <tr>
                            <td> 4</td>
                            <td> {{ number }}</td>
                            <td> User Receive Number</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <form @submit.prevent="submitSmsApi" method="post" role="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="sms_api">SMS API</label>
                            <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('sms_api') }" rows="3" v-model="form.sms_api" id="sms_api" placeholder="API">{!! $basic->smsapi !!}</textarea>
                            <has-error :form="form" field="sms_api"></has-error>
                        </div>
                        <div class="form-group">
                            <v-button :loading="form.busy" :block="true" :large="true">
                                <i class="fas fa-cogs"></i> {{ $t('Update') }}
                            </v-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </card>
</template>

<script>
export default {
    name: "Sms",
    data(){
        return{
            message : '{{message}}',
            number : '{{number}}',
            form: new Form({
                'sms_api': ''
            })
        }
    },
    methods:{
        submitSmsApi(){
            this.form.post('api/sms-api-update')
            .then((res)=>{
                Toast.fire({
                    icon: 'success',
                    title: this.$t('success_message')
                })
            })
            .catch()
        },
        loadSmsApi(){
            axios.get('api/sms-api').then(({data}) => (this.form.fill(data)))
        }
    },
    created() {
        this.loadSmsApi();
    }
}
</script>

<style scoped>

</style>
