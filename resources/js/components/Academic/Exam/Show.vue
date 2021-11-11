<template>
	<custom-card :title="$t('ShowExam')" :url="'/academic-exam'" :text="$t('ExamList')">
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
							<td class="text-right">{{ $t('CreateBy') }}</td>
							<td>{{ exam.creator.name }}</td>
						</tr>
						<tr>
							<td class="text-right">{{ $t('CreatedAt') }}</td>
							<td>{{ exam.created_at | myDate }}</td>
						</tr>
					</table>
				</div>
				<div class="col-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>{{ $t('Academic_Class') }}</th>
								<th>{{ $t('AcademicGroupDepartment') }}</th>
								<th>{{ $t('SectionYear') }}</th>
								<th>{{ $t('TotalStudent') }}</th>
								<th>{{ $t('Published') }}</th>
								<th>{{ $t('Action') }}</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(list , i) in exam.classes" :key="i">
								<td>{{ list.academic_class.name }}</td>
								<td>
									<template v-if="list.type == 1">{{ list.academic_group.name }}</template>
									<template v-else-if="list.type == 2">{{ list.academic_department.name }}</template>
									<template v-else>N/A</template>
								</td>
								<td>
									<template v-if="list.type == 2">{{ list.year.name }}</template>
									<template v-else-if="list.type == 1">{{ list.group_section.name }}</template>
									<template v-else>{{ list.section.name }}</template>
								</td>
								<td>
									{{ list.logs.length | students }}
								</td>
								<td>
									<template v-if="list.is_assigned">
										<label class="badge badge-success">Assigned</label>
									</template>
									<template v-else>
										<label class="badge badge-warning">Pending</label>
									</template>
								</td>
								<td>
									<button type="button" @click.prevent="examAssign(exam.custom,list.id)" class="btn btn-warning btn-sm">Assign Now</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</custom-card>
</template>

<script>
	export default {
		name: 'Show',
		data() {
			return {
				exam: [],
				basic: [],
			}
		},
		methods: {
			examAssign(custom, id) {
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
						axios.post('/api/academic-exam-assign', { custom, id }).then((res) => {
							this.loadAcademicExamDetails();
						})
					}
				})
			},
			loadAcademicExamDetails() {
				axios.get(`/api/academic-exam/${this.$route.params.custom}`).then((res) => {
					this.exam = res.data
				})
			}
		},
		created() {
			this.loadAcademicExamDetails();
			this.basic = this.$store.getters.basicData;
		},
	}
</script>

<style lang="scss" scoped>
</style>
