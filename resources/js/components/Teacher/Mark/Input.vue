<template>
	<card :title="$t('MarkInput')" icon="fa fa-pencil-alt">
		<form action="" @submit.prevent="searchStudent">

			<div class="row" v-if="Object.keys(this.errors).length">
				<div class="col-md-12">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">{{ $t('Warning') }}!</h4>
						<ul class="list-group">
							<li class="list-group-item" v-for="(error, e) in errors" :key="e">{{ error[0] }}</li>
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-6">
					<label for="academic_session_id">Select Session</label>
					<custom-select @change="changeSession($event)" :options="sessions" v-model="form.academic_session_id" :placeholder="$t('Select_One')"></custom-select>
					<has-error :form="form" field="academic_session_id"></has-error>
				</div>

				<div class="form-group col-6">
					<label for="academic_exam_id">Select Exams</label>
					<custom-select-empty @change="changeExam($event)" :options="exams" v-model="form.academic_exam_id" :placeholder="$t('Select_One')"></custom-select-empty>
					<has-error :form="form" field="academic_exam_id"></has-error>
				</div>

				<div class="form-group col-6">
					<label for="academic_exam_class_id">Select Academic Class</label>
					<custom-select-empty @change="changeExamClass($event)" :options="classes" v-model="form.academic_exam_class_id" :placeholder="$t('Select_One')"></custom-select-empty>
					<has-error :form="form" field="academic_exam_class_id"></has-error>
				</div>

				<div class="form-group col-6">
					<label for="academic_subject_id">Select Academic Subject</label>
					<custom-select-empty :options="subjects" v-model="form.academic_subject_id" :placeholder="$t('Select_One')"></custom-select-empty>
					<has-error :form="form" field="academic_subject_id"></has-error>
				</div>
			</div>
			<div class="form-group mt-2">
				<v-button :loading="form.busy"><i class="fas fa-search-plus"></i> {{$t('LoadStudent')}}</v-button>
			</div>
		</form>
		<template v-if="students.length">
			<hr>
			<form action="" @submit.prevent="submitMark">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">SL</th>
							<th width="10%">IDNumber</th>
							<th width="15%">Name</th>
							<th width="10%">Status</th>
							<th width="40%">Mark</th>
							<th width="20%">Comment</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(student, index) in students" :key="index">
							<td>{{ ++index }}</td>
							<td>{{ student.user.custom }}</td>
							<td>{{ student.user.name }} <br> {{ student.user.phone }}</td>
							<td>
								<select v-model="marks[getIndex(student.id)].status" class="form-control">
									<option value="1">Present</option>
									<option value="0">Absent</option>
								</select>
							</td>
							<td>
								<template v-if="student.subject.mark_type == 0">
									<table class="table table-bordered">
										<tr>
											<td>
												<div class="input-group">
													<input type="number" step="0.001" v-model="marks[getIndex(student.id)].theory" min="0" :max="student.subject.full_mark" class="form-control" placeholder="Gain mark" aria-label="Recipient's username" aria-describedby="basic-addon2">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">out of {{ student.subject.full_mark }}</span>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</template>

								<template v-else>
									<table class="table table-bordered">
										<tr>
											<td>
												<div class="input-group">
													<input type="number" step="0.001" v-model="marks[getIndex(student.id)].theory" min="0" :max="student.subject.theory" class="form-control" placeholder="Theory mark" aria-label="Recipient's username" aria-describedby="basic-addon2">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">out of {{ student.subject.theory }}</span>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input type="number" step="0.001" v-model="marks[getIndex(student.id)].practical" min="0" :max="student.subject.practical" class="form-control" placeholder="Practical mark" aria-label="Recipient's username" aria-describedby="basic-addon2">
													<div class="input-group-append">
														<span class="input-group-text" id="basic-addon2">out of {{ student.subject.practical }}</span>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</template>
							</td>
							<td>
								<textarea name="" id="" cols="30" rows="1" v-model="marks[getIndex(student.id)].comment" placeholder="Write comment against this student" class="form-control"></textarea>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="row mt-3">
					<div class="col-8">
						<button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold" :disabled="markDisable"><i class="fas fa-paper-plane"></i> {{$t('SubmitMark')}}</button>
					</div>
					<div class="col-4">
						<button type="button" class="btn btn-success btn-lg btn-block font-weight-bold" @click.prevent="makePrint"><i class="fas fa-print"></i> {{$t('Print')}}</button>
					</div>
				</div>
			</form>
		</template>

		<div class="modal fade" id="markModal" tabindex="-1" role="dialog" aria-labelledby="markModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="markModalLabel">{{ $t('MarkInput') }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="printMe">
						<div class="row" v-if="markDetails">
							<div class="col-12">
								<img src="img/pad.png" style="width: 100%" alt="">
							</div>
							<div class="col-md-12">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-right">{{ $t('Title') }}</th>
											<th>{{ $t('Details') }}</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-right">{{ $t('Academic_Session') }}</td>
											<td>{{ markDetails.session }}</td>
										</tr>
										<tr>
											<td class="text-right">{{ $t('AcademicExam') }}</td>
											<td>{{ markDetails.exam }}</td>
										</tr>
										<tr>
											<td class="text-right">{{ $t('AcademicDetails') }}</td>
											<td>{{ markDetails.academicDetails }}</td>
										</tr>
										<tr>
											<td class="text-right">{{ $t('Academic_subject') }}</td>
											<td>{{ markDetails.subject.code }} - {{ markDetails.subject.name }}</td>
										</tr>
										<tr>
											<td class="text-right">{{ $t('Academic_teacher') }}</td>
											<td>{{ markDetails.teacher }}</td>
										</tr>
										<tr>
											<td class="text-right">{{ $t('DateTime') }}</td>
											<td>{{ markDetails.submitted }}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<hr>
							<div class="col-12">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>{{ $t('SL') }}</th>
											<th>{{ $t('IDNumber') }}</th>
											<th>{{ $t('StudentName') }}</th>
											<th>{{ $t('Status') }}</th>
											<th class="text-center">{{ $t('Mark') }}</th>
											<th class="text-center">{{ $t('Grade') }}</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(student, index) in markDetails.students" :key="index" :class="!student.status ? 'bg-warning': ''">
											<td>{{ ++index }}</td>
											<td>{{ student.user.custom }}</td>
											<td>{{ student.user.name }} <br> {{ student.user.phone }}</td>
											<td>
												<template v-if="student.status">{{ $t('Present') }}</template>
												<template v-else>{{ $t('Absent') }}</template>
											</td>
											<td>
												<template v-if="student.status">
													<table class="table table-bordered table-striped">
														<template v-if="markDetails.subject.mark_type == 1">
															<tr>
																<td>{{ $t('Theory') }}: {{ student.theory }} </td>
																<td>{{ $t('Practical') }}: {{ student.practical }}</td>
																<td>{{ $t('Total') }}: {{ student.total_gain }} out of {{markDetails.subject.full_mark}}</td>
															</tr>
														</template>
														<template v-if="markDetails.subject.mark_type == 0">
															<tr>
																<td>{{ $t('Theory') }}: {{ student.theory }}</td>
																<td>{{ $t('Total') }}: {{ student.total_gain }} out of {{markDetails.subject.full_mark}} </td>
															</tr>
														</template>
													</table>
												</template>
												<template v-else>N/A</template>
											</td>
											<td class="text-center">
												<template v-if="student.status">{{ student.grade.name }}</template>
												<template v-else>N/A</template>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('Close') }}</button>
						<button type="button" class="btn btn-primary" @click.prevent="printMe('printMe')">{{ $t('Print') }}</button>
					</div>
				</div>
			</div>
		</div>

	</card>
</template>

<script>
	import CustomSelect from '../../globals/CustomSelect.vue'
	import CustomSelectEmpty from '../../globals/CustomSelectEmpty.vue'
	import * as Validator from 'validatorjs';
	export default {
		components: {
			CustomSelect, CustomSelectEmpty
		},
		data() {
			return {
				form: new Form({
					academic_session_id: '',
					academic_exam_id: '',
					academic_exam_class_id: '',
					academic_subject_id: ''
				}),
				errors: [],
				sessions: [],
				exams: [],
				classes: [],
				subjects: [],
				students: [],
				marks: [],
				markDisable: false,
				markDetails: ''
			}
		},
		methods: {
			async printMe(divName) {
				await this.$htmlToPaper(divName);
			},
			makePrint() {
				this.form.post(`/api/mark-input-print`).then((res) => {
					this.markDetails = res.data;
					setTimeout(function () {
						$('#markModal').modal('show');
					}, 3000);
				})
			},
			submitMark() {
				Swal.fire({
					title: this.$t("confirm_title"),
					text: this.$t("confirm_message"),
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: this.$t("confirm"),
					cancelButtonText: this.$t("cancel"),
				}).then((result) => {
					if (result.isConfirmed) {
						this.markDisable = true;
						let postData = {
							marks: this.marks,
							form: this.form
						};
						axios.post(`/api/submit-inputted-mark`, postData).then((res) => {
							this.markDisable = false;
							Swal.fire({
								icon: "success",
								title: this.$t("success"),
								text: this.$t("success_message"),
								showConfirmButton: false,
								timer: 2500
							})
							this.makePrint();
						});

					}
				})
			},
			getIndex(id) {
				return this.marks.findIndex((e) => e.log_id == id)
			},
			async searchStudent() {
				let validation = new Validator(this.form, {
					'academic_session_id': ['required'],
					'academic_exam_id': ['required'],
					'academic_exam_class_id': ['required'],
					'academic_subject_id': ['required'],
				})
				this.errors = [];
				if (validation.passes()) {
					await this.form.post(`/api/load-mark-input-students`).then((res) => {
						this.students = res.data;
						res.data.forEach(element => {
							let sub = {
								log_id: element.id,
								mark_type: element.subject.mark_type,
								theory: element.theory ?? 0,
								practical: element.practical ?? 0,
								comment: element.comment,
								status: element.status,
							}
							this.marks.push(sub);
						});
					})
				} else {
					this.errors = validation.errors.all();
				}
			},
			changeSession(e) {
				if (e) {
					this.exams = [];
					this.classes = [];
					this.subjects = [];
					axios.get(`/api/load-session-exams`, { params: { id: e } }).then(({ data }) => this.exams = data)
				}
			},
			changeExam(e) {
				if (e) {
					this.classes = [];
					this.subjects = [];
					axios.get(`/api/load-exam-classes`, { params: { id: e } }).then(({ data }) => this.classes = data)
				}
			},
			changeExamClass(e) {
				if (e) {
					this.subjects = [];
					axios.get(`/api/load-exam-class-subjects`, { params: { id: e, session_id: this.form.academic_session_id } }).then(({ data }) => this.subjects = data)
				}
			},
			loadAcademicSession() {
				axios.get(`/api/load-only-session-list`).then(({ data }) => this.sessions = data)
			}
		},
		created() {
			this.loadAcademicSession();
		},
	}
</script>

<style scoped>
</style>
