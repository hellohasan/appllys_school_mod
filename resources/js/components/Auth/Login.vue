<template>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form @submit.prevent="authenticate" method="post">

                <div class="alert alert-warning text-center font-weight-bold" role="alert" v-if="authError">
                    {{ authError }}
                </div>

                <div class="input-group mb-3">
                    <input type="email" v-model="form.email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" v-model=form.password class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <v-button :bold="false" :block="false" :uppercase="false" :large="false" :loading="form.busy">
                            Sign In
                        </v-button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>

                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <router-link to="/forget">I forgot my password</router-link>
            </p>
            <p class="mb-0">
                <router-link to="/register" class="text-center">Create a new account</router-link>
            </p>
        </div>
    </div>
</template>

<script>
import {login} from '../../helpers/auth';

export default {
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: null
        }
    },
    methods: {
        authenticate() {
            this.$store.dispatch('login');

            login(this.$data.form)
                .then((res) => {
                    this.$store.commit("loginSuccess", res)
                    window.location = '/dashboard';
                    // this.$router.push({path:'/dashboard'})
                })
                .catch((error) => {
                    this.$store.commit('loginFailed', {error})
                });
        },
    },
    computed: {
        authError() {
            return this.$store.getters.authError;
        }
    },

}
</script>

<style>

</style>

