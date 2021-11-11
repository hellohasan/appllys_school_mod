<template>
	<custom-card :title="$t('ExamRoutine')" :url="`/academic-exam`" :text="$t('ExamList')">
		<div id="printAble">
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
					</table>
				</div>
				<hr>
				<div class="col-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>{{ $t('Date') }}</th>
								<th>{{ $t('ExamSubjects') }}</th>
								<th>{{ $t('Time') }}</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(routine, index) in routines" :key="index">
								<td style="vertical-align: middle">{{ index | myDate }}</td>
								<td>
									<table style="width: 100%;">
										<tr v-for="(r, i) in routine" :key="i">
											<template v-if="r.academic_subject.academic_class_type == 2">
												<td> {{ r.academic_subject.academic_class.name }} - ({{ r.academic_subject.academic_department.name }}) - ({{ r.academic_subject.department_year.name }}) - {{ r.academic_subject.name }} - ({{ r.academic_subject.code }}) </td>
											</template>
											<template v-if="r.academic_subject.academic_class_type == 1">
												<td> {{ r.academic_subject.academic_class.name }} - ({{ r.academic_subject.academic_group.name }}) - {{ r.academic_subject.name }} - ({{ r.academic_subject.code }}) </td>
											</template>
											<template v-if="r.academic_subject.academic_class_type == 0">
												<td> {{ r.academic_subject.academic_class.name }} - {{ r.academic_subject.name }} ({{ r.academic_subject.code }}) </td>
											</template>
										</tr>
									</table>
								</td>
								<td style="vertical-align: middle">{{ routine[0].start_time | myTime }} - {{ routine[0].end_time | myTime }}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-12">
					<div class="d-flex justify-content-around mt-5">
						<div class="text-center">
							<p>---------------------------------- <br> {{ $t('RegisterSign') }}</p>
						</div>

						<div class="text-center">
							<p>---------------------------------- <br> {{ $t('HeadSign') }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="button" @click="printMe('printAble')" class="btn btn-success"><i class="fas fa-print"></i> {{ $t('Print') }}</button>
	</custom-card>
</template>

<script>
	export default {
		name: "RoutineShow",
		data() {
			return {
				exam: '',
				routines: []
			}
		},
		methods: {
			async printMe(divName) {
				await this.$htmlToPaper(divName);
			},
			loadExamRoutineList(custom) {
				axios.get(`/api/academic-exam-routine-show/${custom}`).then((res) => {
					this.exam = res.data.exam;
					this.routines = res.data.routines
				})
			}
		},
		created() {
			this.loadExamRoutineList(this.$route.params.custom);
			this.basic = this.$store.getters.basicData;
		},
	}
</script>

<style lang="scss" scoped>
</style>
