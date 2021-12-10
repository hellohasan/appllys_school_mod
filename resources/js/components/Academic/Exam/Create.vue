<template>
	<custom-card :title="$t('NewExam')" :url="'/academic-exam-create'" :text="$t('ExamList')">

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

		<form @submit.prevent="submitExam">
			<div class="form-row">
				<form-group-input :form="form" v-model="form.title" col="col-md-6" name="title" :label="$t('Title')"></form-group-input>
				<div class="form-group col-md-6">
					<label for="daterange">{{ $t('DateRange') }}</label> <br>
					<date-picker v-model="form.daterange" range format="YYYY-MM-DD" type="date" :placeholder="$t('DateRange')"></date-picker>
					<has-error :form="form" field="daterange"></has-error>
				</div>
				<div class="col-md-12">

					<div class="form-row">
						<div class="d-flex justify-content-between border-bottom col-md-12">
							<h5>{{ $t('SelectOneByOne') }}</h5>
						</div>
					</div>

					<div class="form-row mt-2" v-for="(list, i) in form.lists" :key="i">
						<div class="form-group col-md-5">
							<label for="classes">{{ $t('Academic_Class') }}</label>
							<custom-select @change="classChange($event,i)" :options="classes" v-model="list.class_id" :placeholder="$t('Select_One')"></custom-select>
						</div>

						<template v-if="list.type === 0">
							<div class="form-group" :class="'col-md-6'">
								<label for="classes">{{ $t('Section') }}</label>
								<custom-select-multiple v-model="list.section_ids" :options="list.sections" :placeholder="$t('SelectMultiple')"></custom-select-multiple>
							</div>
						</template>

						<template v-if="list.type == 1">
							<div class="form-group" :class="'col-md-3'">
								<label for="classes">{{ $t('Academic_Group') }}</label>
								<custom-select-empty @change="groupChange($event,i)" :options="list.groups" v-model="list.group_id" :placeholder="$t('Select_One')"></custom-select-empty>
							</div>

							<div class="form-group" :class="'col-md-3'">
								<label for="classes">{{ $t('Group_section') }}</label>
								<custom-select-multiple v-model="list.group_section_ids" :options="list.group_sections" :placeholder="$t('SelectMultiple')"></custom-select-multiple>
							</div>
						</template>

						<template v-if="list.type == 2">
							<div class="form-group" :class="'col-md-3'">
								<label for="classes">{{ $t('Academic_Department') }}</label>
								<custom-select-empty @change="departmentChange($event,i)" :options="list.departments" v-model="list.department_id" :placeholder="$t('Select_One')"></custom-select-empty>
							</div>
							<div class="form-group" :class="'col-md-3'">
								<label for="classes">{{ $t('Department_year') }}</label>
								<custom-select-multiple v-model="list.department_year_ids" :options="list.department_years" :placeholder="$t('SelectMultiple')"></custom-select-multiple>
							</div>
						</template>
						<div class="form-group" :class="'col-md-1'">
							<label for="classes">{{ $t('Action') }}</label>
							<button type="button" class="btn btn-danger" @click.prevent="deleteList(i)"><i class="fas fa-far fa-trash-alt"></i> {{ $t('Delete') }}</button>
						</div>
					</div>
					<div class="form-row">
						<div class="d-flex justify-content-end border-top col-md-12">
							<button type="button" class="btn btn-success btn-sm" @click="addNewDocument">
								<i class="fas fa-plus"></i> {{ $t('AddMore') }}
							</button>
						</div>
					</div>

				</div>
				<div class="form-group col-md-12 mt-2">
					<v-button :loading="form.busy">{{$t('Submit')}}</v-button>
				</div>
			</div>
		</form>
	</custom-card>
</template>

<script>
	import CustomSelect from '../../globals/CustomSelect.vue'
	import DatePicker from 'vue2-datepicker';
	import 'vue2-datepicker/index.css';
	import CustomSelectEmpty from '../../globals/CustomSelectEmpty.vue';
	import CustomSelectMultiple from '../../globals/CustomSelectMultiple.vue';
	import * as Validator from 'validatorjs';
	export default {
		name: 'Create',
		components: {
			DatePicker, CustomSelect, CustomSelectEmpty, CustomSelectMultiple
		},
		data() {
			return {
				form: new Form({
					title: '',
					daterange: [],
					lists: [
						{
							class_id: '',
							type: '',

							sections: [],
							groups: [],
							group_sections: [],
							departments: [],
							department_years: [],

							section_ids: [],
							group_id: '',
							group_section_ids: [],
							department_id: '',
							department_year_ids: [],
						}
					]
				}),
				classes: [],
				errors: []
			}
		},
		methods: {
			addNewDocument() {
				this.form.lists.push({
					class_id: '',
					type: '',
					section_ids: [],
					group_id: '',
					group_section_ids: [],
					department_id: '',
					department_year_ids: [],

					sections: [],
					groups: [],
					group_sections: [],
					departments: [],
					department_years: [],
				})
			},
			deleteList(index) {
				if (this.form.lists.length > 1) {
					this.form.lists.splice(index, 1)
				}
			},
			classChange(e, i) {
				if (e) {
					axios.get(`/api/load-only-class-sections-groups-departments/${e}`).then((res) => {
						let list = this.form.lists[i];
						if (res.data.type === 0) {
							list.type = res.data.type;
							list.sections = res.data.sections
							list.groups = []
							list.group_sections = []
							list.departments = []
							list.department_years = []
						} else if (res.data.type === 1) {
							list.type = res.data.type;
							list.sections = []
							list.groups = res.data.academic_groups
							list.group_sections = []
							list.departments = []
							list.department_years = []
						} else {
							list.type = res.data.type;
							list.sections = []
							list.groups = []
							list.group_sections = []
							list.departments = res.data.academic_departments
							list.department_years = []
						}
					})
				}
			},
			groupChange(e, i) {
				if (e) {
					axios.get('/api/load-only-group-section', { params: { id: e } }).then((res) => {
						this.form.lists[i].group_sections = res.data.sections;
					})
				}
			},
			departmentChange(e, i) {
				if (e) {
					axios.get('/api/load-only-department-year', { params: { id: e } }).then((res) => {
						this.form.lists[i].department_years = res.data.sections;
					})
				}
			},
			submitExam() {
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
						/* FIXME: take decision for this comment lines */
						let validation = new Validator(this.form, {
							'title': ['required'],
							'daterange': ['required'],
							'lists': ['required', 'array'],
							'lists.*.class_id': ['required'],
							'lists.*.type': ['required'],
							/* 'lists.*.section_ids': [{ required_if: ['lists.*.type', 0] }],
							'lists.*.group_id': [{ required_if: ['lists.*.type', 1] }],
							'lists.*.group_section_ids': [{ required_if: ['lists.*.type', 1] }],
							'lists.*.department_id': [{ required_if: ['lists.*.type', 2] }],
							'lists.*.department_year_ids': [{ required_if: ['lists.*.type', 2] }], */
						});
						this.errors = [];
						if (validation.passes()) {
							this.form.post(`/api/academic-exam`).then((res) => {
								Toast.fire({
									icon: "success",
									text: this.$t("success_message_create"),
								});
								this.$router.push(`/academic-exam/${res.data.custom}/show`);
							})
						} else {
							this.errors = validation.errors.all();
						}
					}
				})
			},
			loadAcademicClass() {
				axios.get(`/api/load-academic-class-list`).then((res) => {
					this.classes = res.data
				});
			}
		},
		created() {
			this.loadAcademicClass();
		},
	}
</script>

<style lang="scss" scoped>
	.mx-datepicker {
		display: block;
		width: 100%;
	}
	.mx-input {
		height: 38px;
		font-size: 16px;
	}
</style>
