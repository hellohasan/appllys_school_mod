<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background: url('./img/user-cover.png') center center;">
                <h3 class="widget-user-username text-left">{{ userDetails.name  }}</h3>
                <h5 class="widget-user-desc text-left">
                    <template v-for="role in userDetails.roles">{{ role.name | capitalize}}</template>
                </h5>
              </div>
              <div class="widget-user-image">
                  <div class="ph-avatar img-circle" v-if="!userDetails.photo"></div>
                  <img class="img-circle" v-else :src="userDetails.photo" alt="User Avatar">
              </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">{{$t('your_info')}}</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">{{ $t('password') }}</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="profile">
                    <form class="form-horizontal" @submit.prevent="updateProfile" @keydown="form.onKeydown($event)" enctype="multipart">

                        <div class="form-group row">
                            <label for="inputName1" class="col-sm-2 col-form-label">{{ $t('Name') }}</label>
                            <div class="col-sm-10">
                            <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="inputName1" placeholder="Name">
                            <has-error :form="form" field="name"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" id="inputEmail" placeholder="Email">
                            <has-error :form="form" field="email"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" v-model="form.bio" :class="{ 'is-invalid': form.errors.has('bio') }" id="inputExperience" placeholder="Experience"></textarea>
                            <has-error :form="form" field="bio"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPhoto" class="col-sm-2 col-form-label">Profile Photo</label>
                            <div class="col-sm-10">
                            <input type="file" @change="changePhoto" accept="image/*" class="form-control-file" :class="{ 'is-invalid': form.errors.has('photo') }" id="inputPhoto">
                            <has-error :form="form" field="photo"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                            <button type="submit" :disabled="form.busy" class="btn btn-success">{{ $t('update') }}</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="password">
                    <form class="form-horizontal" @submit.prevent="updatePassword" @keydown="form.onKeydown($event)">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                            <div class="col-sm-10">
                            <input type="password" v-model="pForm.current_password" class="form-control" :class="{ 'is-invalid': pForm.errors.has('current_password') }" id="inputName" placeholder="Current Password">
                            <has-error :form="pForm" field="current_password"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                            <input type="password" v-model="pForm.password" class="form-control" :class="{ 'is-invalid': pForm.errors.has('password') }" id="inputPassword" placeholder="New Password">
                            <has-error :form="pForm" field="password"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName4" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                            <input type="password" v-model="pForm.password_confirmation" class="form-control" id="inputName4" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                            <button type="submit" :disabled="form.busy" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            userDetails:{},

            form : new Form({
                name : null,
                email : null,
                bio : null,
                photo : null,
            }),

            pForm : new Form({
                current_password : null,
                password : null,
                password_confirmation : null,
            }),

        }
    },
    methods:{

        updateProfile(){
            this.form.post('/api/update-profile')
            .then(()=>{
                $('#inputPhoto').val('');
                this.form.photo = null;
                this.$store.dispatch('refreshCurrentUser');
                this.getUserDetails();
                Toast.fire({
                    icon: 'success',
                    title: 'Profile successfully Updated.'
                })
            })
        },
        changePhoto(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = (file) => {
                //console.log('result',reader.result)
                this.form.photo = reader.result
            }
            reader.readAsDataURL(file)
        },
        updatePassword(){
            this.pForm.post('/api/update-password')
            .then(()=>{
                this.pForm.reset();
                Toast.fire({
                    icon: 'success',
                    title: 'Password successfully Updated.'
                })
            }).catch((error)=>{
                if(error.response.status === 400){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.response.data.message,
                    })
                }
            })
        },
        getUserDetails(){
            axios.get('/api/profile').then(({data}) =>{
                this.form.fill(data);
                this.form.photo = null;
                this.userDetails = data;
            });
        }
    },
    created(){
        this.getUserDetails();
    }
}
</script>

<style scoped>
    .widget-user .widget-user-header{
        background-position: center center;
        background-size: cover;
        height:200px
    }
</style>
