<template>
<div class="card">
    <div class="card-body register-card-body">
    <p class="login-box-msg">Create a new account</p>
    <form @submit.prevent="submitRegistration" method="post">
        <div class="input-group mb-3">
            <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Full name">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            <has-error :form="form" field="name"></has-error>
        </div>

        <div class="input-group mb-3">
            <input type="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            <has-error :form="form" field="email"></has-error>
        </div>

        <div class="input-group mb-3">
            <input type="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            <has-error :form="form" field="password"></has-error>
        </div>

        <div class="input-group mb-3">
            <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" v-model="form.agree" name="terms" value="agree">
                    <label for="agreeTerms"> I agree to the <a href="#">terms</a></label>
                </div>
                <has-error :form="form" field="agree"></has-error>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        <!-- /.col -->
        </div>
    </form>

    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i>
        Sign up using Facebook
        </a>

        <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i>
        Sign up using Google+
        </a>
    </div>

    <router-link to="login" class="text-center">I already have an account</router-link>
    </div>
    <!-- /.form-box -->
</div><!-- /.card -->
</template>

<script>
import { setAuthorization } from "../../helpers/general";

export default {
    data(){
        return{
            form: new Form({
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
                agree:''
            })
        }
    },
    methods:{
        submitRegistration(){
            this.form.post('/api/auth/register')
            .then((response)=>{
                setAuthorization(response.data.access_token);
                this.$store.commit("loginSuccess",response.data)
                this.$router.push({path:'/dashboard'})
            })
            .catch((error)=>{
                this.$store.commit('loginFailed',{error})
            })
        }
    }
}
</script>

<style>

</style>
