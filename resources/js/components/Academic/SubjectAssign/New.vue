<template>
	<card :title='$t("TeacherSubjectAssign")' icon="fas fa-user-graduate">
		<form @submit.prevent="submitTeacher">

			<div class="form-row">
				<div class="form-group col-6">
					<label for="session_id">{{ $t('Academic_Session') }}</label>
					<custom-select :options="sessions" v-model="form.session_id" :placeholder="$t('Select_One')" name="session_id"></custom-select>
					<div class="invalid-feedback" v-if="errors.session_id">{{ errors.session_id[0] }}</div>
				</div>
				<div class="form-group col-6">
					<label for="academic_class_id">{{ $t('Academic_Class') }}</label>
					<custom-select @change="classChange" :options="classes" v-model="form.academic_class_id" :placeholder="$t('Select_One')"></custom-select>
					<div class="invalid-feedback" v-if="errors.academic_class_id">{{ errors.academic_class_id[0] }}</div>
				</div>

				<template v-if="this.form.academic_class_type == '0'">
					<div class="form-group col-12">
						<label for="academic_section_id">{{ $t('Group_section') }}</label>
						<custom-select-empty :options="sections" v-model="form.academic_section_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.academic_section_id">{{ errors.academic_section_id[0] }}</div>
					</div>
				</template>

				<template v-if="this.form.academic_class_type == '1'">
					<div class="form-group col-6">
						<label for="academic_group_id">{{ $t('Academic_Group') }}</label>
						<custom-select-empty :options="groups" @change="changeGroup" v-model="form.academic_group_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.academic_group_id">{{ errors.academic_group_id[0] }}</div>
					</div>
					<div class="form-group col-6">
						<label for="academic_group_section_id">{{ $t('Group_section') }}</label>
						<custom-select-empty :options="group_sections" v-model="form.academic_group_section_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.academic_group_section_id">{{ errors.academic_group_section_id[0] }}</div>
					</div>
				</template>
				<template v-if="this.form.academic_class_type == '2'">
					<div class="form-group col-6">
						<label for="academic_department_id">{{ $t('Academic_Department') }}</label>
						<custom-select-empty @change="changeDepartment" :options="departments" v-model="form.academic_department_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.academic_department_id">{{ errors.academic_department_id[0] }}</div>
					</div>
					<div class="form-group col-6">
						<label for="academic_year_id">{{ $t('Department_year') }}</label>
						<custom-select-empty :options="department_years" v-model="form.academic_year_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.academic_year_id">{{ errors.academic_year_id[0] }}</div>
					</div>
				</template>

				<div class="form-group col-12">
					<button type="submit" id="button" :disabled="form.busy" class="btn btn-primary btn-lg btn-block"><i class="fas fa-search"></i> {{ $t('ClassList') }}</button>
				</div>
			</div>
		</form>
		<hr>
		<div class="row" v-if="sForm.subjects.length">
			<div class="col-md-12" v-if="Object.keys(this.errors).length">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<h4 class="alert-heading">Warning!</h4>
					<ul class="list-group">
						<li class="list-group-item" v-for="(error, e) in errors" :key="e">{{ error[0] }}</li>
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Code</th>
							<th>Type</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(subject,index) in sForm.subjects" :key="index">
							<td>{{ subject.subject_name }}</td>
							<td>{{ subject.subject_code }}</td>
							<td>
								<label class="badge" :class="subject.subject_type ? 'badge-warning' : 'badge-success'">{{ subject.subject_type ? 'Optional' : 'Compulsory' }}</label>
							</td>
							<td>
								<table class="table">
									<tr>
										<th>Day</th>
										<th>Teacher</th>
										<th>Period</th>
										<th>Action</th>
									</tr>
									<tr v-for="(day, d) in subject.days" :key="d">
										<td>{{ day.day_name }}</td>
										<td>
											<custom-select-empty :options="teachers" v-model="sForm.subjects[index].days[d].teacher_id" :placeholder="$t('Select_One')" name="teacher_id"></custom-select-empty>
											<span v-if="d == 0">
												<div class="form-check">
													<input type="checkbox" name="check_teacher" :id="'check_teacher'+d+index" @click="choiceTeacher(index, d, $event)" class="form-check-input">
													<label class="form-check-label" :for="'check_teacher'+d+index">Check it if all are same</label>
												</div>
											</span>
										</td>
										<td>
											<custom-select-empty :options="periods" v-model="sForm.subjects[index].days[d].period_id" :placeholder="$t('Select_One')" name="teacher_id"></custom-select-empty>
											<span v-if="d == 0">
												<div class="form-check">
													<input type="checkbox" name="check_period" :id="'check_period'+d+index" @click="choicePeriod(index, d, $event)" class="form-check-input">
													<label class="form-check-label" :for="'check_period'+d+index">Check it if all are same</label>
												</div>
											</span>
										</td>
										<td>
											<div class="btn btn-danger btn-sm" @click.prevent="deleteDay(index, d)"><i class="fas fa-trash"></i> {{ $t('Delete') }}</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<button class="btn btn-primary btn-block btn-lg" :disabled="sForm.busy" @click.prevent="submitAssign"> Assign Subject Now</button>
			</div>
		</div>
	</card>
</template>

<script>
	import CustomSelect from '../../globals/CustomSelect.vue'
	import CustomSelectEmpty from '../../globals/CustomSelectEmpty.vue'
	import * as Validator from 'validatorjs';
	export default {
		name: "New",
		components: { CustomSelect, CustomSelectEmpty },
		data() {
			return {
				form: new Form({
					'session_id': '',
					'academic_class_id': '',
					'academic_class_type': '',
					'academic_section_id': '',
					'academic_group_id': '',
					'academic_group_section_id': '',
					'academic_department_id': '',
					'academic_year_id': '',
				}),
				sForm: new Form({
					subjects: []
				}),
				teachers: [],
				sessions: [],
				classes: [],
				sections: [],
				groups: [],
				group_sections: [],
				departments: [],
				department_years: [],
				errors: [],
				periods: [],
			}
		},
		methods: {
			submitAssign() {
				this.errors = [];
				let validation = new Validator(this.sForm, {
					'subjects.*.days': ['required', 'array'],
					'subjects.*.days.*.day_id': ['required'],
					'subjects.*.days.*.teacher_id': ['required'],
					'subjects.*.days.*.period_id': ['required'],
				});

				if (validation.passes()) {
					let postData = { ...this.form, ...this.sForm };
					axios.post('/api/submit-academic-class-subject-list', postData).then((res) => {
						Toast.fire({
							icon: "success",
							text: this.$t("success_message_create"),
						});
						this.$router.push(`/subject-assign/${res.data.custom}/show`);
					})
				} else {
					this.errors = validation.errors.all()
					//console.log(Object.keys(this.errors).length);
				}
			},
			submitTeacher() {
				this.errors = [];
				let validation = new Validator(this.form, {
					'session_id': ['required'],
					'academic_class_id': ['required'],
					'academic_class_type': ['required'],
					'academic_section_id': [{ required_if: ['academic_class_type', 0] }],
					'academic_group_id': [{ required_if: ['academic_class_type', 1] }],
					'academic_group_section_id': [{ required_if: ['academic_class_type', 1] }],
					'academic_department_id': [{ required_if: ['academic_class_type', 2] }],
					'academic_year_id': [{ required_if: ['academic_class_type', 2] }],
				});

				if (validation.passes()) {
					this.form.post('/api/get-academic-class-subjects').then((res) => {
						this.sForm.subjects = []
						this.sForm.subjects = res.data.subjects
						this.sForm.custom = res.data.custom
					})
				} else {
					this.errors = validation.errors.all()
				}
			},
			choicePeriod(index, d, event) {
				if (event.target.checked) {
					let period_id = this.sForm.subjects[index].days[d].period_id;
					this.sForm.subjects[index].days.forEach(e => {
						e.period_id = period_id
					});
				}
			},
			choiceTeacher(index, d, event) {
				if (event.target.checked) {
					let teacher_id = this.sForm.subjects[index].days[d].teacher_id;
					this.sForm.subjects[index].days.forEach(e => {
						e.teacher_id = teacher_id
					});
				}
			},
			deleteDay(index, d) {
				this.sForm.subjects[index].days.splice(d, 1)
			},
			changeGroup(e) {
				this.group_sections = [];
				if (e) {
					this.group_sections = _.find(this.groups, function (o) { return o.id == e }).sections;
				}
			},
			changeDepartment(e) {
				this.department_years = [];
				if (e) {
					this.department_years = _.find(this.departments, function (o) { return o.id == e }).sections;
				}
			},
			classChange: function (e) {
				if (e) {
					axios.get(`/api/load-class-all-details/${e}`).then((res) => {
						this.form.academic_class_type = res.data.type;
						this.sections = []
						this.groups = []
						this.form.academic_group_id = ''
						this.form.academic_section_id = ''
						this.form.academic_group_section_id = ''
						this.form.academic_department_id = ''
						this.form.academic_year_id = ''
						this.group_sections = []
						this.departments = []
						this.department_years = []
						this.sections = res.data.sections;
						this.groups = res.data.academic_groups;
						this.departments = res.data.academic_departments;
					});
				}
			},
			loadTeacherList() {
				axios.get('/api/load-teacher-list').then(({ data }) => this.teachers = data)
			},
			loadAcademicSession() {
				axios.get('/api/load-active-academic-session').then(({ data }) => this.sessions = data);
			},
			loadClassList() {
				axios.get("/api/load-class-list").then((res) => {
					this.classes = res.data;
				});
			},
			loadPeriodList() {
				axios.get("/api/load-period-list").then((res) => {
					this.periods = res.data;
				});
			},
		},
		created() {
			this.loadTeacherList();
			this.loadAcademicSession();
			this.loadClassList();
			this.loadPeriodList();
		}
	}
</script>

<style lang="scss" scoped>
</style>
