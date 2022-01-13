<template>
	<card :title="$t('StudentList')">
		<form @submit.prevent="loadStudent">
			<div class="form-row">
				<div class="form-group col-4">
					<label for="session_id">{{ $t('Academic_Session') }}</label>
					<custom-select :options="sessions" @change="changeSession" v-model="form.session_id" :placeholder="$t('Select_One')" name="session_id"></custom-select>
					<div class="invalid-feedback" v-if="errors.session_id">{{ errors.session_id[0] }}</div>
				</div>
				<div class="form-group col-8">
					<label for="teacher_subject_id">{{ $t('Academic_subject') }}</label>
					<custom-select-empty :options="subjects" v-model="form.teacher_subject_id" :placeholder="$t('Select_One')"></custom-select-empty>
					<div class="invalid-feedback" v-if="errors.teacher_subject_id">{{ errors.teacher_subject_id[0] }}</div>
				</div>
				<div class="form-group col-12">
					<button type="submit" id="button" :disabled="form.busy" class="btn btn-primary btn-lg btn-block"><i class="fas fa-search"></i> {{ $t('StudentList') }}</button>
				</div>
			</div>
		</form>
		<template v-if="students.length">
			<div id="printAble">
				<div class="row">
					<div class="col-12">
						<div class="text-center">
							<h3>{{basic.name}}</h3>
							<h5>{{basic.address}}</h5>
							<h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
							<span class="border rounded p-2">{{ $t('StudentList') }}</span>
						</div>
					</div>
					<div class="col-12 mt-3">
						<table class="table table-bordered">
							<tr>
								<td class="text-right" width="50%">{{$t("Academic_Session") }}</td>
								<td>{{ assign.academic_session.duration }}</td>
							</tr>
							<tr>
								<td class="text-right" width="50%">{{$t("Academic_Class") }}</td>
								<td>{{ assign.academic_class.name }}</td>
							</tr>

							<template v-if="assign.type == 0">
								<tr>
									<td class="text-right" width="50%">{{$t("Section") }}</td>
									<td>{{ assign.section.name }}</td>
								</tr>
							</template>

							<template v-if="assign.type == 1">
								<tr>
									<td class="text-right" width="50%">{{$t("Academic_Group") }}</td>
									<td>{{ assign.group.name }}</td>
								</tr>
								<tr>
									<td class="text-right" width="50%">{{$t("Group_section") }}</td>
									<td>{{ assign.group_section.name }}</td>
								</tr>
							</template>

							<template v-if="assign.type == 2">
								<tr>
									<td class="text-right" width="50%">{{$t("Academic_Department") }}</td>
									<td>{{ assign.department.name }}</td>
								</tr>
								<tr>
									<td class="text-right" width="50%">{{$t("Department_year") }}</td>
									<td>{{ assign.year.name }}</td>
								</tr>
							</template>
							<tr>
								<td class="text-right" width="50%">{{$t("Academic_subject") }}</td>
								<td>{{ subject.name }} - ({{ subject.code }})</td>
							</tr>
						</table>
					</div>
					<div class="col-12 mt-3">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
								<thead>
									<tr>
										<th>{{ $t('SL') }}</th>
										<th>{{ $t('IDNumber') }}</th>
										<th>{{ $t('Photo') }}</th>
										<th>{{ $t('Name') }}</th>
										<th>{{ $t('GuardianName') }}</th>
										<th>{{ $t('Attendance') }}</th>
										<th>{{ $t('LastResult') }}</th>
										<th>{{ $t('Status') }}</th>
										<th class="not-export-col d-print-none">{{ $t('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(s, index) in students" :key="index">
										<td>{{ ++index }}</td>
										<td>{{ s.custom }}</td>
										<td>
											<img :src="s.user.photo" width="75px" alt="">
										</td>
										<td>
											{{ s.user.name }} <br>
											{{ s.user.phone }}
										</td>
										<td>
											{{ s.user.guardian.guardian.name }} <br>
											{{ s.user.guardian.guardian.phone }}
										</td>
										<td>
											<!-- TODO:attendance percentage show show here -->
										</td>
										<td>
											<!-- TODO:Last semester result should show here  -->
										</td>
										<td>
											<span v-if="s.status == 0" class="badge badge-success">{{ $t('Running') }}</span>
											<span v-else-if="s.status == 1" class="badge badge-warning">{{ $t('Stop') }}</span>
											<span v-else-if="s.status == 2" class="badge badge-danger">{{ $t('DropOut') }}</span>
										</td>
										<td class="d-print-none">
											<!-- FIXME: add the student profile link -->
											<router-link to="#" class="btn btn-sm btn-secondary">{{ $t('Profile') }}</router-link>
										</td>
									</tr>
								</tbody>

							</table>
						</div>
					</div>
				</div>
			</div>
			<button type="button" @click="printMe('printAble')" class="btn btn-success"><i class="fas fa-print"></i> {{ $t('Print') }}</button>
		</template>

	</card>
</template>

<script>
	import CustomSelect from '../globals/CustomSelect.vue'
	import CustomSelectEmpty from '../globals/CustomSelectEmpty.vue'
	import * as Validator from 'validatorjs';
	export default {
		name: "List",
		components: {
			CustomSelect, CustomSelectEmpty
		},
		data() {
			return {
				form: new Form({
					session_id: '',
					teacher_subject_id: ''
				}),
				basic: {},
				errors: [],
				sessions: [],
				subjects: [],
				assign: {},
				subject: {},
				students: []
			}
		},
		methods: {
			async printMe(divName) {
				await this.$htmlToPaper(divName);
			},
			loadStudent() {
				this.errors = [];
				let validation = new Validator(this.form, {
					'session_id': ['required'],
					'teacher_subject_id': ['required'],
				});

				if (validation.passes()) {
					this.form.post('/api/load-teacher-student-list').then((res) => {
						this.basic = this.$store.getters.basicData;
						this.assign = res.data.detail
						this.subject = res.data.subject
						this.students = res.data.students
					})
				} else {
					this.errors = validation.errors.all();
				}
			},
			changeSession(e) {
				if (e) {
					this.loadAcademicDetails(e);
				}
			},
			loadAcademicDetails(session_id) {
				axios.get('/api/load-teacher-session-subject-list', { params: { session_id } }).then((res) => {
					this.subjects = res.data
				})
			},
			loadAcademicSession() {
				axios.get('/api/load-only-session-list').then((res) => {
					this.sessions = res.data
				})
			}
		},
		created() {
			this.loadAcademicSession();
		},
	}
</script>

<style lang="scss" scoped>
</style>
