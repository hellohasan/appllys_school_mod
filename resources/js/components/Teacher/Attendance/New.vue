<template>
	<card :title="$t('NewAttendance')" icon="fa fa-notes-medical">
		<form action="" @submit.prevent="searchStudent" @keydown="form.onKeydown($event)">

			<!-- <div class="row" v-if="Object.keys(this.form.errors.errors).length">
				<div class="col-md-12">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">{{ $t('Warning') }}!</h4>
						<ul class="list-group">
							<li class="list-group-item" v-for="(error, e) in form.errors.errors" :key="e">{{ error[0] }}</li>
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
 -->
			<div class="form-row">
				<div class="form-group col-6">
					<label for="academic_session_id">{{ $t('SelectSession') }}</label>
					<custom-select :options="sessions" v-model="form.academic_session_id" :placeholder="$t('Select_One')"></custom-select>
					<has-error :form="form" field="academic_session_id"></has-error>
				</div>

				<div class="form-group col-6">
					<label for="attendance_date">{{ $t('SelectDate') }}</label>
					<input type="date" v-model="form.attendance_date" :class="{ 'is-invalid': form.errors.has('attendance_date') }" id="attendance_date" :placeholder="$t('SelectDate')" class="form-control">
					<has-error :form="form" field="attendance_date"></has-error>
				</div>

				<div class="form-group col-6">
					<label for="academic_class_id">{{ $t('SelectAcademicClass') }}</label>
					<custom-select-empty @change="changeClass($event)" :options="classes" v-model="form.academic_class_id" :placeholder="$t('Select_One')"></custom-select-empty>
					<has-error :form="form" field="academic_class_id"></has-error>
				</div>

				<template v-if="this.form.academic_class_type == '0'">
					<div class="form-group col-6">
						<label for="academic_section_id">{{ $t('Group_section') }}</label>
						<custom-select-empty :options="levelOnes" v-model="form.level_one_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<has-error :form="form" field="level_one_id"></has-error>
					</div>
				</template>
				<template v-if="this.form.academic_class_type == '1'">
					<div class="form-group col-3">
						<label for="academic_group_id">{{ $t('Academic_Group') }}</label>
						<custom-select-empty :options="levelOnes" @change="changeGroupDepartment" v-model="form.level_one_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<has-error :form="form" field="level_one_id"></has-error>
					</div>
					<div class="form-group col-3">
						<label for="academic_group_section_id">{{ $t('Group_section') }}</label>
						<custom-select-empty :options="levelTwos" v-model="form.level_two_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<has-error :form="form" field="level_two_id"></has-error>
					</div>
				</template>
				<template v-if="this.form.academic_class_type == '2'">
					<div class="form-group col-3">
						<label for="academic_department_id">{{ $t('Academic_Department') }}</label>
						<custom-select-empty @change="changeGroupDepartment" :options="levelOnes" v-model="form.level_one_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<has-error :form="form" field="level_one_id"></has-error>
					</div>
					<div class="form-group col-3">
						<label for="academic_year_id">{{ $t('Department_year') }}</label>
						<custom-select-empty :options="levelTwos" v-model="form.level_two_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<has-error :form="form" field="level_two_id"></has-error>
					</div>
				</template>
			</div>
			<div class="form-group mt-2">
				<v-button :loading="form.busy"><i class="fas fa-search-plus"></i> {{$t('LoadSubject')}}</v-button>
			</div>
		</form>
		<template v-if="subjects.length">
			<hr>
			<div class="form-row">
				<div class="form-group col-12">
					<label for="academic_subject_id">{{ $t('SelectSubject') }}</label>
					<custom-select-empty :options="subjects" @change="changeSubject" v-model="form.academic_subject_id" :placeholder="$t('Select_One')"></custom-select-empty>
					<div class="invalid-feedback" v-if="errors.academic_subject_id">{{ errors.academic_subject_id[0] }}</div>
				</div>

				<div class="col-12">
					<vue-element-loading :active="isActive" :text="$t('PleaseWait')" spinner="bar-fade-scale" color="#FF6700" />
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>{{ $t('SL') }}</th>
								<th>{{ $t('IDNumber') }}</th>
								<th>{{ $t('Status') }}</th>
								<th>{{ $t('Photo') }}</th>
								<th>{{ $t('Name') }}</th>
								<th>{{ $t('GuardianName') }}</th>
							</tr>
						</thead>
						<tbody>
							<template v-if="students.length">
								<tr v-for="(student, index) in students" :key="index">
									<td>{{ ++index }}</td>
									<td>{{ student.custom }}</td>
									<td>
										<v-toggle :options="checkOptions" :disabled="false" id="status" />
									</td>
									<td>
										<img :src="student.photo" width="50px" height="50px" class="img-rounded" alt="">
									</td>
									<td>{{ student.name }} <br> {{ student.phone }}</td>
									<td>
										{{ student.guardian.guardian.name }} <br>
										{{ student.guardian.guardian.phone }}
									</td>
								</tr>
							</template>
							<template v-else>
								<tr class="text-center">
									<td colspan="6"><strong>{{ $t('NoRecordFound') }}</strong></td>
								</tr>
							</template>
						</tbody>
					</table>
				</div>
			</div>
		</template>

	</card>
</template>

<script>
	import CustomSelect from '../../globals/CustomSelect'
	import CustomSelectEmpty from '../../globals/CustomSelectEmpty'
	import VToggle from '../../globals/VToggle'
	import * as Validator from 'validatorjs';
	export default {
		name: 'New',
		components: {
			CustomSelect, CustomSelectEmpty, VToggle
		},
		data() {
			return {
				form: new Form({
					attendance_date: '',
					academic_session_id: '',
					academic_class_id: '',
					academic_class_type: '',
					level_one_id: '',
					level_two_id: '',
					academic_subject_id: ''
				}),
				errors: [],
				sessions: [],
				classes: [],
				levelOnes: [],
				levelTwos: [],
				subjects: [],
				level_id: '',
				isActive: false,
				students: [],
				subjectDetails: '',
				checkOptions: {
					on: this.$i18n.tc('Present'),
					off: this.$i18n.tc('Absent'),
					onstyle: 'success',
					offstyle: 'danger',
					width: '100%'
				}
			}
		},
		methods: {

			changeSubject: function (e) {
				if (e) {
					let propsData = {
						attendance_date: this.form.attendance_date,
						academic_session_id: this.form.academic_session_id,
						academic_class_id: this.form.academic_class_id,
						academic_class_type: this.form.academic_class_type,
						level_id: this.level_id,
						academic_subject_id: this.form.academic_subject_id
					}
					this.isActive = true;
					this.students = [];
					this.subjectDetails = '';
					axios.post(`/api/load-subject-student-for-attendance`, propsData).then(({ data }) => {
						this.isActive = false;
						this.students = data.students
						this.subjectDetails = data.subject_details
					})
				}
			},

			searchStudent() {
				this.form.errors.errors = {};
				let validation = new Validator(this.form, {
					'attendance_date': ['required'],
					'academic_session_id': ['required'],
					'academic_class_id': ['required'],
					'academic_class_type': ['required'],
					'level_one_id': ['required'],
					'level_two_id': ['required_unless:academic_class_type,0'],
				});

				if (validation.passes()) {
					this.form.post('/api/load-subject-for-attendance').then(({ data }) => {
						this.subjects = [];
						this.students = [];
						this.subjectDetails = '';
						this.subjects = data.subjects
						this.level_id = data.academic_level_id
					});
				} else {
					this.form.errors.errors = validation.errors.all();
				}
			},
			changeGroupDepartment(e) {
				this.levelTwos = [];
				if (e) {
					this.levelTwos = _.find(this.levelOnes, function (o) { return o.id == e }).sections;
				}
			},
			changeClass: function (e) {
				if (e) {
					axios.get(`/api/load-class-all-details/${e}`).then((res) => {
						let type = res.data.type;
						this.levelOnes = [];
						this.LevelTwos = [];
						this.form.academic_class_type = String(type);
						this.form.level_one_id = '';
						this.form.level_two_id = '';

						this.students = [];
						this.subjects = [];
						this.subjectDetails = '';

						if (type == 2) {
							this.levelOnes = res.data.academic_departments;
						} else if (type == 1) {
							this.levelOnes = res.data.academic_groups;
						} else {
							this.levelOnes = res.data.sections;
						}
					});
				}
			},
			loadClassList() {
				axios.get("/api/load-class-list").then((res) => {
					this.classes = res.data;
				});
			},
			loadAcademicSession() {
				axios.get(`/api/load-only-session-list`).then(({ data }) => this.sessions = data)
			}
		},
		created() {
			this.loadAcademicSession();
			this.loadClassList();
		},
	}
</script>

<style lang="scss" scoped>
</style>
