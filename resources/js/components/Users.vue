<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $t('Manage User') }}</h3>
                    <div class="card-tools">
                        <button class="btn btn-success" @click="openUserModal"><i class="fas fa-user-plus fa-w"></i>
                            {{ $t('Add') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>{{ $t('SL') }}</th>
                            <th>{{ $t('Name') }}</th>
                            <th>{{ $t('Email') }}</th>
                            <th>{{ $t('Role') }}</th>
                            <th>{{ $t('salary_scale') }}</th>
                            <th>{{ $t('Register At') }}</th>
                            <th>{{ $t('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(user, index ) in users.data" :key="user.id">
                            <td>{{ ++index }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <template v-if="user.roles.length">
                                    <span class="badge badge-success" v-for="role in user.roles" :key="role.id">{{role.name | capitalize }}</span>
                                </template>
                            </td> 
                            <td>{{ user.salary.title ? user.salary.title : user.salary.salary_scale.title }} </td>
                            <td>{{ user.created_at | myDate }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="editUser(user)"><i class="far fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" @click="deleteUser(user.id)"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="users" class="justify-content-center" @pagination-change-page="getPaginationResults">
                        <span slot="prev-nav">{{ $t('Previous') }}</span>
                        <span slot="next-nav">{{ $t('Next') }}</span>
                    </pagination>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">{{ editMode ? $t('Update') : $t('Add New') }} {{$t('User') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email" placeholder="Email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                            <textarea v-model="form.bio" type="text" name="bio" placeholder="Short Bio for user (Optional)" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            <form-group-select :options="roleList" :label="$t('SelectRole')" id="role" v-model="form.role" :form="form"></form-group-select>

                            <form-group-select :options="scales" :label="$t('Select_One')" id="salary_scale_id" v-model="form.salary_scale_id" :form="form"></form-group-select>

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" placeholder="Password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('Close') }}
                            </button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">
                                {{ editMode ? $t('Update') : $t('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            users: {},
            roleList: {},
            scales: {},
            form: new Form({
                name: '',
                email: '',
                password: '',
                bio: '',
                role: [],
                salary_scale_id: ''
            }),
            editMode: false,
            editId: null
        }
    },
    methods: {
        openUserModal() {
            this.form.reset();
            this.form.clear();
            this.editMode = false;
            this.editId = null;
            $('#userModal').modal('show');
        },
        editUser(user) {
            this.openUserModal();
            this.editMode = true;
            this.editId = user.id;
            this.form.fill(user);
            this.form.role = user.roles.length ? user.roles[0].id : '';
            this.form.salary_scale_id = user?.salary?.salary_scale_id;
        },
        createUser() {
            this.form.post('/api/user')
                .then(() => {
                    Fire.$emit('loadUserList');
                    $('#userModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                })
        },
        updateUser() {
            this.form.put('/api/user/' + this.editId)
                .then(() => {
                    Fire.$emit('loadUserList');
                    $('#userModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                })
        },
        deleteUser(id) {
            Swal.fire({
                title: this.$t('confirm_title'),
                text: this.$t('confirm_message'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: this.$t('confirm'),
                cancelButtonText: this.$t('cancel'),
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/user/' + id)
                        .then(() => {
                            Fire.$emit('loadUserList');
                            Swal.fire({
                                title: this.$t('delete_title'),
                                text: this.$t('delete_message'),
                                icon: 'success'
                            })
                        }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: this.$t('error_alert_title'),
                            text: this.$t('error_alert_text')
                        })
                    });
                }
            })
        },
        loadUsers() {
            axios.get('api/user').then((res) => {
                this.users = res.data
            })
        },
        loadRoles() {
            axios.get('api/roles-select').then(({data}) => (this.roleList = data))
        },
        loadSalaryScale(){
          axios.get('/api/load-salary-scales').then(({data}) => (this.scales = data))
        },
        getPaginationResults(page = 1) {
            axios.get('/api/user?page=' + page)
                .then(response => {
                    this.users = response.data;
                });
        }
    },
    created() {
        this.loadUsers();
        this.loadRoles();
        this.loadSalaryScale();
        Fire.$on('loadUserList', () => {
            this.loadUsers();
        });
    }
}
</script>

<style>

</style>
