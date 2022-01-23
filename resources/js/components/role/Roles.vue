<template>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ $t('Manage Role') }}</h3>
					<div class="card-tools">
						<button class="btn btn-success" @click="openRoleModal"><i class="fas fa-plus fa-w"></i>
							{{ $t('Add New') }}
						</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0">
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>{{ $t('SL') }}</th>
								<th>{{ $t('Name') }}</th>
								<th>{{ $t('Modify') }}</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(role, index) in roles" :key="role.id">
								<td>{{ role.id }}</td>
								<td>{{ role.name }}</td>
								<td>
									<button class="btn btn-primary btn-sm" v-if="index" @click="editRole(role)"><i class="far fa-edit"></i>
										{{ $t('Edit') }}
									</button>
									<button class="btn btn-danger btn-sm" v-if="index" @click="deleteRole(role.id)"><i class="fas fa-trash"></i> {{ $t('Delete') }}
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.card -->
		</div>

		<!-- Modal -->
		<div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="userModalLabel">{{ editMode ? $t('Update') : $t('Add') }}
							{{ $t('Role') }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="editMode ? updateRole() : createRole()" @keydown="form.onKeydown($event)">
						<div class="modal-body">
							<div class="form-group">
								<input v-model="form.name" type="text" name="name" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
								<has-error :form="form" field="name"></has-error>
							</div>

							<div class="row">
								<div class="col-md-3" v-for="permission in permissions" :key="permission.id">
									<div class="form-check">
										<input type="checkbox" v-model="form.permissions" name="permissions" :value="permission.id" class="form-check-input" :id="permission.id">
										<label class="form-check-label" :for="permission.id">{{ permission.name }}</label>
									</div>
								</div>
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
				roles: {},
				permissions: {},
				form: new Form({
					name: '',
					permissions: []
				}),
				editMode: false,
				editId: null
			}
		},
		methods: {
			openRoleModal() {
				this.form.reset();
				this.form.clear();
				this.form.permissions = [];
				this.editMode = false;
				this.editId = null;
				$('#crudModal').modal('show');
			},
			editRole(role) {
				this.openRoleModal();
				this.editMode = true;
				this.editId = role.id;
				axios.get('/api/roles/' + role.id).then(({ data }) => (this.form.permissions = data.permissions))
				this.form.fill(role);
			},
			createRole() {
				this.form.post('/api/roles')
					.then(() => {
						Fire.$emit('loadRoleList');
						$('#crudModal').modal('hide');
						Toast.fire({
							icon: 'success',
							title: this.$t('success_message_create')
						})
					})
					.catch(() => {

					});
			},
			updateRole() {
				this.form.put('/api/roles/' + this.editId)
					.then(() => {
						Fire.$emit('loadRoleList');
						$('#crudModal').modal('hide');
						Toast.fire({
							icon: 'success',
							title: this.$t('success_message_update')
						})
					})
			},
			deleteRole(id) {
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
						axios.delete('/api/roles/' + id)
							.then(() => {
								Fire.$emit('loadRoleList');
								Swal.fire({
									title: this.$t('delete_title'),
									text: this.$t('delete_message'),
									icon: 'success',
									confirmButtonText: this.$t('ok')
								})
							}).catch(() => {
								Swal.fire({
									icon: 'error',
									title: this.$t('error_alert_title'),
									text: this.$t('error_alert_text'),
									confirmButtonText: this.$t('ok'),
								})
							});
					}
				})
			},
			loadRole() {
				axios.get('api/roles').then(({ data }) => (this.roles = data))
			},
			loadPermissions() {
				axios.get('api/permissions').then(({ data }) => (this.permissions = data))
			}
		},
		created() {
			this.loadRole();
			this.loadPermissions();
			Fire.$on('loadRoleList', () => {
				this.loadRole();
			});
		}
	}
</script>

<style>
</style>
