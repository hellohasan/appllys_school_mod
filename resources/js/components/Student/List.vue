<template>
	<card :title="$t('StudentList')">
		<form @submit.prevent="loadStudent">
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
						<custom-select-empty :options="levelOnes" v-model="form.level_one_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.level_one_id">{{ errors.level_one_id[0] }}</div>
					</div>
				</template>

				<template v-if="this.form.academic_class_type == '1'">
					<div class="form-group col-6">
						<label for="academic_group_id">{{ $t('Academic_Group') }}</label>
						<custom-select-empty :options="levelOnes" @change="changeGroupDepartment" v-model="form.level_one_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.level_one_id">{{ errors.level_one_id[0] }}</div>
					</div>
					<div class="form-group col-6">
						<label for="academic_group_section_id">{{ $t('Group_section') }}</label>
						<custom-select-empty :options="levelTwos" v-model="form.level_two_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.level_two_id">{{ errors.level_two_id[0] }}</div>
					</div>
				</template>
				<template v-if="this.form.academic_class_type == '2'">
					<div class="form-group col-6">
						<label for="academic_department_id">{{ $t('Academic_Department') }}</label>
						<custom-select-empty @change="changeGroupDepartment" :options="levelOnes" v-model="form.level_one_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.level_one_id">{{ errors.level_one_id[0] }}</div>
					</div>
					<div class="form-group col-6">
						<label for="academic_year_id">{{ $t('Department_year') }}</label>
						<custom-select-empty :options="levelTwos" v-model="form.level_two_id" :placeholder="$t('Select_One')"></custom-select-empty>
						<div class="invalid-feedback" v-if="errors.level_two_id">{{ errors.level_two_id[0] }}</div>
					</div>
				</template>

				<div class="form-group col-12">
					<button type="submit" id="button" :disabled="form.busy" class="btn btn-primary btn-lg btn-block"><i class="fas fa-search"></i> {{ $t('StudentList') }}</button>
				</div>
			</div>
		</form>
		<template v-if="info != null">
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
								<td>{{ info.session.duration }}</td>
							</tr>
							<tr>
								<td class="text-right" width="50%">{{$t("AcademicInfo") }}</td>
								<td>{{ info.academic_info.details }}</td>
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
									<template v-if="info.students.length">

										<tr v-for="(s, index) in info.students" :key="index">
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
									</template>
									<template v-else>
										<tr class="text-center">
											<td colspan="9">No Student are found </td>
										</tr>
									</template>
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
					academic_class_id: '',
					academic_class_type: '',
					level_one_id: '',
					level_two_id: ''
				}),
				basic: {},
				errors: [],
				sessions: [],
				classes: [],
				levelOnes: [],
				levelTwos: [],
				levelTwoData: [],
				info: null
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
					'academic_class_id': ['required'],
					'academic_class_type': ['required'],
					'level_one_id': ['required'],
					'level_two_id': ['required_unless:academic_class_type,0'],
				});

				if (validation.passes()) {
					this.form.post('/api/load-class-student-list').then((res) => {
						this.basic = this.$store.getters.basicData;
						this.info = res.data
					})
				} else {
					this.errors = validation.errors.all();
				}
			},
			changeGroupDepartment(e) {
				this.levelTwos = [];
				if (e) {
					this.levelTwos = _.find(this.levelOnes, function (o) { return o.id == e }).sections;
				}
			},
			classChange: function (e) {
				if (e) {
					axios.get(`/api/load-class-all-details/${e}`).then((res) => {

						let type = res.data.type;
						this.levelOnes = [];
						this.LevelTwos = [];
						this.form.academic_class_type = String(type);
						this.form.level_one_id = '';
						this.form.level_two_id = '';

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
				axios.get('/api/load-only-session-list').then((res) => {
					this.sessions = res.data
				})
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
