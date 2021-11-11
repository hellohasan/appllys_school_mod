<template>
	<custom-card :title="$t('ExamRoutine')" :url="`/academic-exam`" :text="$t('ExamList')">
		<div class="row">
			<div class="col-12">
				<div class="text-center">
					<h3>{{basic.name}}</h3>
					<h5>{{basic.address}}</h5>
					<h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
				</div>
				<hr>
			</div>
			<div class="col-12 mt-1" v-if="exam != ''">
				<table class="table table-striped table-bordered">
					<tr>
						<th class="text-right">{{ $t('Title') }}</th>
						<th>{{ $t('Details') }}</th>
					</tr>
					<tr>
						<td class="text-right">{{ $t('Custom') }}</td>
						<td>{{ exam.custom }}</td>
					</tr>
					<tr>
						<td class="text-right">{{ $t('Academic_Session') }}</td>
						<td>{{ exam.session.duration }}</td>
					</tr>
					<tr>
						<td class="text-right">{{ $t('Title') }}</td>
						<td>{{ exam.title }}</td>
					</tr>
					<tr>
						<td class="text-right">{{ $t('DateRange') }}</td>
						<td>{{ exam.start_date | myDate}} to {{ exam.end_date | myDate }}</td>
					</tr>
					<tr>
						<td class="text-right">{{ $t('CreatedAt') }}</td>
						<td>{{ exam.created_at | myDate }}</td>
					</tr>
				</table>
			</div>
			<hr>
			<div class="col-12">

				<div class="row" v-if="Object.keys(this.errors).length">
					<div class="col-md-12">
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
				</div>

				<form @submit.prevent="submitRoutine">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="12%">{{ $t('Date') }}</th>
								<th>{{ $t('ExamSubjects') }}</th>
								<th width="10%">{{ $t('StartTime') }}</th>
								<th width="10%">{{ $t('EndTime') }}</th>
								<th width="5%">{{ $t('Action') }}</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(r,index) in form.routine" :key="index">
								<td>
									<input type="date" v-model="r.date" :placeholder="$t('SelectDate')" class="form-control" id="">
								</td>
								<td>
									<custom-select-multiple v-model="r.subject_ids" :options="subjects" :placeholder="$t('SelectMultiple')"></custom-select-multiple>
								</td>
								<td>
									<input type="time" v-model="r.start_time" :placeholder="$t('SelectTime')" class="form-control" id="">
									<span v-if="index == 0">
										<div class="form-check">
											<input type="checkbox" name="check_start" id="check_start" @click="choiceStart(index, $event)" class="form-check-input">
											<label class="form-check-label" for="check_start">Check for all</label>
										</div>
									</span>
								</td>
								<td>
									<input type="time" v-model="r.end_time" :placeholder="$t('SelectTime')" class="form-control" id="">
									<span v-if="index == 0">
										<div class="form-check">
											<input type="checkbox" name="check_end" id="check_end" @click="choiceEnd(index, $event)" class="form-check-input">
											<label class="form-check-label" for="check_end">Check for all</label>
										</div>
									</span>
								</td>
								<td>
									<button type="button" class="btn btn-danger btn-sm" @click.prevent="deleteRoutine(index)"><i class="fas fa-trash-alt"></i> {{ $t('Delete') }}</button>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="d-flex justify-content-end border-top">
						<button type="button" class="btn btn-success btn-sm" @click.prevent="addNew">
							<i class="fas fa-plus"></i> {{ $t('AddMore') }}
						</button>
					</div>
					<v-button class="mt-2" :loading="form.busy">{{$t('Submit')}}</v-button>
				</form>
			</div>
		</div>
	</custom-card>
</template>

<script>
	import CustomSelectMultiple from '../../globals/CustomSelectMultiple'
	import * as Validator from 'validatorjs';
	export default {
		name: "Routine",
		components: {
			CustomSelectMultiple
		},
		data() {
			return {
				basic: {},
				exam: '',
				subjects: {},
				form: new Form({
					exam_id: '',
					routine: [
						{
							date: '',
							subject_ids: [],
							start_time: '',
							end_time: ''
						}
					]
				}),
				errors: []
			}
		},
		methods: {
			submitRoutine() {
				let validation = new Validator(this.form, {
					'exam_id': ['required'],
					'routine': ['required', 'array'],
					'routine.*.date': ['required'],
					'routine.*.subject_ids': ['required', 'array'],
					'routine.*.start_time': ['required'],
					'routine.*.end_time': ['required'],
				});
				this.errors = [];
				if (validation.passes()) {
					this.form.post('/api/academic-exam-routine-submit').then((res) => {
						Toast.fire({
							icon: "success",
							text: this.$t("success_message_create"),
						});
						this.$router.push(`/academic-exam/${res.data.custom}/routine/show`);
					})
				} else {
					this.errors = validation.errors.all();
				}
			},
			addNew() {
				this.form.routine.push({
					date: '',
					subject_ids: [],
					start_time: '',
					end_time: ''
				})
			},
			deleteRoutine(index) {
				if (this.form.routine.length > 1) {
					this.form.routine.splice(index, 1);
				}
			},
			choiceStart(index, event) {
				if (event.target.checked) {
					let start_time = this.form.routine[index].start_time;
					this.form.routine.forEach(e => {
						e.start_time = start_time
					});
				}
			},
			choiceEnd(index, event) {
				if (event.target.checked) {
					let end_time = this.form.routine[index].end_time;
					this.form.routine.forEach(e => {
						e.end_time = end_time
					});
				}
			},
			loadExamSubjectList(custom, id) {
				axios.get(`/api/academic-exam-routine/${custom}`).then((res) => {
					this.subjects = res.data.subjects;
					this.exam = res.data.exam;
					this.form.exam_id = res.data.exam.id
					setTimeout(() => {
						this.form.routine = res.data.routines;
					}, 3000);
				})
			}
		},
		created() {
			this.loadExamSubjectList(this.$route.params.custom, this.$route.params.id);
			this.basic = this.$store.getters.basicData;
		},
	}
</script>

<style lang="scss" scoped>
</style>
