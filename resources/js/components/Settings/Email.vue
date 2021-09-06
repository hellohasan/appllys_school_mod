<template>
    <card :title="$t('Email_setting')">

        <form @submit.prevent="submitEmailSetting" role="form" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sender_name">Sender Name</label>
                        <input type="text" v-model="form.sender_name" :class="{ 'is-invalid': form.errors.has('sender_name') }" id="sender_name" placeholder="Sender Name" class="form-control">
                        <has-error :form="form" field="sender_name"></has-error>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sender_email">Sender Email</label>
                        <input type="text" v-model="form.sender_email" :class="{ 'is-invalid': form.errors.has('sender_email') }" id="sender_email" placeholder="Sender Email" class="form-control">
                        <has-error :form="form" field="sender_email"></has-error>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="mail_driver">Email Driver</label>
                        <select name="mail_driver" v-model="form.mail_driver" id="mail_driver" class="form-control">
                            <option value="mail">PHP Mailer</option>
                            <option value="smtp">SMTP Driver</option>
                        </select>
                        <has-error :form="form" field="mail_driver"></has-error>
                    </div>
                </div>
                <template v-if="form.mail_driver === 'smtp'">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="smtp_host">SMTP Host</label>
                            <input type="text" v-model="form.smtp_host" :class="{ 'is-invalid': form.errors.has('smtp_host') }" id="smtp_host" placeholder="SMTP Host" class="form-control">
                            <has-error :form="form" field="smtp_host"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="smtp_port">SMTP Port</label>
                            <input type="number" v-model="form.smtp_port" :class="{ 'is-invalid': form.errors.has('smtp_port') }" id="smtp_port" placeholder="SMTP Port" class="form-control">
                            <has-error :form="form" field="smtp_port"></has-error>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="smtp_username">SMTP Username</label>
                            <input type="text" v-model="form.smtp_username" :class="{ 'is-invalid': form.errors.has('smtp_username') }" id="smtp_username" placeholder="SMTP Username" class="form-control">
                            <has-error :form="form" field="smtp_username"></has-error>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="smtp_password">SMTP Password</label>
                            <input type="text" v-model="form.smtp_password" :class="{ 'is-invalid': form.errors.has('smtp_password') }" id="smtp_password" placeholder="SMTP Password" class="form-control">
                            <has-error :form="form" field="smtp_password"></has-error>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="smtp_enc">SMTP Encryption</label>
                            <input type="text" v-model="form.smtp_enc" :class="{ 'is-invalid': form.errors.has('smtp_enc') }" id="smtp_enc" placeholder="SMTP Encryption" class="form-control">
                            <has-error :form="form" field="smtp_enc"></has-error>
                        </div>
                    </div>
                </template>

                <div class="col-md-12">
                    <div class="form-group">
                        <v-button :loading="form.busy">
                            <i class="fas fa-cogs"></i> {{ $t('Update') }}
                        </v-button>
                    </div>
                </div>
            </div>
        </form>
    </card>
</template>

<script>

export default {
    name: "Email",
    data() {
        return {
            form: new Form({
                sender_name: '',
                sender_email: '',
                mail_driver: '',
                smtp_host: '',
                smtp_port: '',
                smtp_username: '',
                smtp_password: '',
                smtp_enc: '',
            }),
        }
    },
    methods: {
        submitEmailSetting() {
            this.form.post('/api/email-setting-update')
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: this.$t('error_alert_title'),
                        text: this.$t('error_alert_text'),
                        confirmButtonText: this.$t('ok'),
                    })
                })
        },
        loadEmailSetting() {
            axios.get('api/email-setting').then(({data}) => (this.form.fill(data)))
        }
    },
    created() {
        this.loadEmailSetting()
    }
}
</script>

<style scoped>

</style>
