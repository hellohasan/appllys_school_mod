<template>
    <card :title="$t('image_setting')">
        <div class="row">
            <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="vert-tabs-logo-tab" data-toggle="pill" href="#vert-tabs-logo" role="tab" aria-controls="vert-tabs-logo" aria-selected="true">Logo & Favicon</a>
                    <a class="nav-link" id="vert-tabs-pad-tab" data-toggle="pill" href="#vert-tabs-pad" role="tab" aria-controls="vert-tabs-pad" aria-selected="true">Manage Pad</a>
                </div>
            </div>
            <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane text-left fade show active" id="vert-tabs-logo" role="tabpanel" aria-labelledby="vert-tabs-logo-tab">
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Update Logo & Favicon
                                </h3>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submitImage" role="form" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                                <label for="logo">Site Logo: </label>
                                                <v-image v-model="form.logo" :custom="`Choice Logo`" :default-image= "`${oldLogo}`" input-name="logo" :class="{ 'is-invalid': form.errors.has('logo') }"></v-image>
                                                <has-error :form="form" field="logo"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="favicon">Favicon Image: </label>
                                                <v-image v-model="form.favicon" :custom="`Choice Favicon`" :default-image= "`${oldFavicon}`" input-name="favicon" :class="{ 'is-invalid': form.errors.has('favicon') }"></v-image>
                                                <has-error :form="form" field="favicon"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <v-button :loading="form.busy">
                                            <i class="fas fa-cogs"></i> {{ $t('Update') }}
                                        </v-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane text-left fade" id="vert-tabs-pad" role="tabpanel" aria-labelledby="vert-tabs-pad-tab">
                        <h3>Update Banner Image</h3>
                        <form action="" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <code>Size : 1920X1080. Image extension only .jpg supported. After update press CTRL+F5
                                    button or clear browser cache.</code>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-primary btn-block btn-lg bold uppercase">
                                    <i class="fas fa-paper-plane"></i> Update Banner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </card>
</template>

<script>
export default {
    name: "ImageSetting",

    data(){
        return{
            form: new Form({
                logo: '',
                favicon: ''
            }),
            oldLogo: '',
            oldFavicon: ''
        }
    },
    methods:{
        submitImage(){
            this.form.post('/api/update-logo')
                .then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                }).catch(()=> (this.form.reset()))
        }
    },
    created() {
        this.oldLogo = process.env.MIX_APP_URL+'img/logo.png'
        this.oldFavicon = process.env.MIX_APP_URL+'img/favicon.png'
    }
}
</script>

<style scoped>

</style>
