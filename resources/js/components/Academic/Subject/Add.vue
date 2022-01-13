<template>
	<div class="card">
		<div class="card-header">
			<h3 class="card-title font-weight-bold">{{ $t('Create_subject') }}</h3>
			<div class="card-tools">
				<router-link class="btn btn-success" to="/academic-subject">
					<i class="fas fa-lists fa-w"></i> {{ $t('Subject_list') }}
				</router-link>
			</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body p-3">
			<form method="post" @submit.prevent="storeAcademicSubject">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="academic_class_id">{{ $t('SelectAcademicClass') }}</label>
							<custom-select @change="classChange" :options="classes" v-model="form.academic_class_id" placeholder="Select One"></custom-select>
							<has-error :form="form" field="academic_class_id"></has-error>
						</div>
					</div>
					<div class="col-md-6">
						<template v-if="this.form.academic_class_type == '1'">
							<div class="form-group">
								<label for="academic_group_id">{{ $t('SelectGroup') }}</label>
								<custom-select :options="groups" v-model="form.academic_group_id" placeholder="Select One"></custom-select>
								<has-error :form="form" field="academic_group_id"></has-error>
							</div>
						</template>

						<template v-if="this.form.academic_class_type == '2'">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="academic_department_id">{{ $t('SelectDepartment') }}</label>
									<custom-select @change="changeDepartment" :options="departments" v-model="form.academic_department_id" placeholder="Select One"></custom-select>
									<has-error :form="form" field="academic_department_id"></has-error>
								</div>
								<div class="form-group col-md-6">
									<label for="academic_year_id">{{ $t('SelectYear') }}</label>
									<custom-select-empty :options="years" v-model="form.academic_year_id" placeholder="Select One"></custom-select-empty>
									<has-error :form="form" field="academic_year_id"></has-error>
								</div>
							</div>
						</template>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name">{{ $t('SubjectName') }}</label>
							<input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" :placeholder="$t('SubjectName')" class="form-control">
							<has-error :form="form" field="name"></has-error>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="code">{{ $t('SubjectCode') }}</label>
							<input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" :placeholder="$t('SubjectCode')" class="form-control">
							<has-error :form="form" field="code"></has-error>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="mark_type">{{ $t('MarkType') }}</label>
							<Select2 :options="mark_types" v-model="form.mark_type" :placeholder="$t('Select_One')"></Select2>
							<has-error :form="form" field="mark_type"></has-error>
						</div>
					</div>
					<template v-if="form.mark_type === '0'">
						<div class="col-md-6">
							<div class="form-group">
								<label for="full_mark">{{ $t('FullMark') }}</label>
								<input type="number" v-model="form.full_mark" :class="{ 'is-invalid': form.errors.has('full_mark') }" id="full_mark" :placeholder="$t('FullMark')" class="form-control">
								<has-error :form="form" field="full_mark"></has-error>
							</div>
						</div>
					</template>
					<template v-if="form.mark_type === '1'">
						<div class="col-md-3">
							<div class="form-group">
								<label for="theory">{{ $t('TheoryMark') }}</label>
								<input type="number" v-model="form.theory" :class="{ 'is-invalid': form.errors.has('theory') }" id="theory" :placeholder="$t('TheoryMark')" class="form-control">
								<has-error :form="form" field="theory"></has-error>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="practical">{{ $t('PracticalMark') }}</label>
								<input type="number" v-model="form.practical" :class="{ 'is-invalid': form.errors.has('practical') }" id="practical" :placeholder="$t('PracticalMark')" class="form-control">
								<has-error :form="form" field="practical"></has-error>
							</div>
						</div>
					</template>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="subject_type">{{ $t('SubjectType') }}</label>
							<Select2 :options="subject_types" v-model="form.subject_type" :placeholder="$t('Select_One')"></Select2>
							<has-error :form="form" field="subject_type"></has-error>
						</div>
					</div>
					<div class="col-md-6">
						<template v-if="form.subject_type === '0'">
							<div class="form-group">
								<label for="point">{{ $t('TotalPoint') }}</label>
								<input type="number" step="0.01" v-model="form.point" id="point" :class="{ 'is-invalid': form.errors.has('point') }" :placeholder="$t('TotalPoint')" class="form-control">
								<has-error :form="form" field="point"></has-error>
							</div>
						</template>
						<template v-if="form.subject_type === '1'">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="total_point">{{ $t('TotalPoint') }}</label>
									<input type="number" step="0.01" id="total_point" v-model="form.total_point" :class="{ 'is-invalid': form.errors.has('total_point') }" :placeholder="$t('TotalPoint')" class="form-control">
									<has-error :form="form" field="total_point"></has-error>
								</div>
								<div class="form-group col-md-6">
									<label for="optional_point">{{ $t('OptionalPoint') }}</label>
									<input type="number" step="0.01" v-model="form.optional_point" :class="{ 'is-invalid': form.errors.has('optional_point') }" id="optional_point" :placeholder="$t('OptionalPoint')" class="form-control">
									<has-error :form="form" field="optional_point"></has-error>
								</div>
							</div>
						</template>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="religion_type">{{ $t('ReligionType') }}</label>
							<Select2 :options="religion_types" v-model="form.religion_type" :placeholder="$t('ReligionType')"></Select2>
							<has-error :form="form" field="religion_type"></has-error>
						</div>
					</div>
					<div class="col-md-6">
						<template v-if="form.religion_type == '1'">
							<div class="form-group">
								<label for="religion_id">{{ $t('SelectReligion') }}</label>
								<Select2 :options="religions" v-model="form.religion_id" :placeholder="$t('Select_One')"></Select2>
								<has-error :form="form" field="religion_id"></has-error>
							</div>
						</template>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="online_url">{{ $t('OnlineLink') }}</label>
							<textarea v-model="form.online_url" id="" cols="30" rows="1" class="form-control" :placeholder="$t('OnlineLink') +' ('+$t('IfAvailable')+')'"></textarea>
							<has-error :form="form" field="religion_id"></has-error>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="status">{{ $t('Status') }}</label>
							<v-toggle v-model="form.status" :options="checkOptions" :disabled="false" :class="{ 'is-invalid': form.errors.has('status') }" id="status" />
							<has-error :form="form" field="status"></has-error>
						</div>
					</div>
				</div>
				<v-button :loading="form.busy">{{ $t('Add New') }}</v-button>
			</form>
		</div>
	</div>
</template>

<script>
	import Select2 from "../../globals/Select2";
	import CustomSelect from "../../globals/CustomSelect";
	import CustomSelectEmpty from "../../globals/CustomSelectEmpty";
	import VToggle from "../../globals/VToggle";

	export default {
		name: "Add",
		components: {
			Select2, CustomSelect, CustomSelectEmpty, VToggle
		},
		data() {
			return {
				form: new Form({
					academic_class_id: '',
					academic_class_type: '',
					academic_group_id: '',
					academic_department_id: '',
					academic_year_id: '',
					name: '',
					code: '',
					mark_type: '',
					full_mark: '',
					theory: '',
					practical: '',
					subject_type: '',
					total_point: '',
					point: '',
					optional_point: '',
					religion_type: '',
					religion_id: '',
					online_url: '',
					status: 1
				}),
				mark_types: [
					{ id: 0, text: 'Straight Mark' },
					{ id: 1, text: 'Partial mark' }
				],
				subject_types: [
					{ id: 0, text: 'Compulsory Subject' },
					{ id: 1, text: 'Optional Subject' }
				],
				religion_types: [
					{ id: 0, text: 'Non Religious' },
					{ id: 1, text: 'Religious Subject' }
				],
				checkOptions: {
					on: 'ACTIVATED',
					off: 'DEACTIVATED',
					onstyle: 'success',
					offstyle: 'danger',
					width: '100%'
				},
				religions: {},
				classes: {},
				groups: {},
				departments: {},
				years: {}
			}
		},
		methods: {
			storeAcademicSubject() {
				this.form.post('/api/store-academic-subject').then((res) => {
					Toast.fire({
						icon: 'success',
						title: this.$t('success_message')
					})
					//this.$router.push('/academic-subject')
					//this.form.clear();
					//this.form.reset();
				})
			},
			classChange: function (e) {
				if (e) {
					axios.get('/api/load-class-group-department', { params: { id: e } }).then((res) => {
						this.form.academic_class_type = res.data.type
						this.groups = res.data.academic_groups
						this.departments = res.data.academic_departments
					});
				}
			},
			changeDepartment: function (e) {
				if (e) {
					axios.get('/api/load-department-years', { params: { id: e } }).then((res) => {
						this.form.academic_class_type = 2
						this.years = {}
						this.years = res.data.sections
					});
				}
			},
			loadReligionList() {
				axios.get('/api/load-religion-list').then((res) => this.religions = res.data);
			},
			loadClassList() {
				axios.get('/api/load-class-list').then((res) => {
					this.classes = res.data
				});
			}
		},
		created() {
			this.loadReligionList();
			this.loadClassList()
		}
	}
</script>

<style scoped>
</style>
