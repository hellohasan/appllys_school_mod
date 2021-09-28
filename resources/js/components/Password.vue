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
                    <h6>{{ $t('password') }}</h6>
                </div><!-- /.card-header -->
                <div class="card-body">

                    <form class="form-horizontal" @submit.prevent="updatePassword" @keydown="pForm.onKeydown($event)">
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
                                <button type="submit" :disabled="pForm.busy" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>

                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Password",
        data() {
            return {
                userDetails: {},
                pForm: new Form({
                    current_password: null,
                    password: null,
                    password_confirmation: null,
                }),
            };
        },
        methods: {
            updatePassword() {
                this.pForm
                    .post("/api/update-password")
                    .then(() => {
                        this.pForm.reset();
                        Toast.fire({
                            icon: "success",
                            title: "Password successfully Updated.",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status === 400) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: error.response.data.message,
                            });
                        }
                    });
            },
            getUserDetails() {
                axios.get("/api/profile").then(({ data }) => {
                    this.userDetails = data;
                });
            },
        },
        created() {
            this.getUserDetails();
        },
    };
</script>

<style lang="scss" scoped>
    .widget-user .widget-user-header {
        background-position: center center;
        background-size: cover;
        height: 200px;
    }
</style>
