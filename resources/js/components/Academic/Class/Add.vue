<template>
	<form @submit.prevent="addAcademicClass" class="p-3">

		<div class="alert alert-danger" role="alert" v-show="Object.keys(this.form.errors.errors).length">
			<h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Warring.!</h4>
			<ul class="list-group">
				<li class="list-group-item" v-for="(err,er) in this.form.errors.errors" :key="er">{{err[0]}}</li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">Class Name</label>
					<input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" placeholder="Class Name" class="form-control">
					<has-error :form="form" field="name"></has-error>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="code">Class Code</label>
					<input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" placeholder="Class Code" class="form-control">
					<has-error :form="form" field="code"></has-error>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="type">Class have Department or Group?</label>
					<custom-select :options="types" @change="changeType" v-model="form.type" :placeholder="$t('Select_One')" name="type"></custom-select>
					<has-error :form="form" field="type"></has-error>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="academic_grading_id">Grading Type</label>
					<Select2 :options="gradings" v-model="form.academic_grading_id" placeholder="Select One"></Select2>
					<has-error :form="form" field="academic_grading_id"></has-error>
				</div>
			</div>
		</div>

		<template v-if="type == '2'">
			<div class="form-group">
				<label for="type">Select Departments</label>
				<custom-select-multiple :options="departments" multiple="true" v-model="form.academic_department_ids" placeholder="Select One" name="academic_department_ids"></custom-select-multiple>
				<has-error :form="form" field="academic_department_ids"></has-error>
			</div>
		</template>

		<template v-if="type == '1'">
			<div class="form-group">
				<label for="type">Select Groups</label>
				<custom-select-multiple :options="groups" multiple="true" v-model="form.academic_group_ids" placeholder="Select One" name="academic_groups_ids"></custom-select-multiple>
				<has-error :form="form" field="academic_groups_ids"></has-error>
			</div>
		</template>

		<template v-if="type == '0'">
			<div class="form-group">
				<label for="type">Select Sections</label>
				<custom-select-multiple :options="sections" multiple="true" v-model="form.academic_section_ids" name="academic_section_ids"></custom-select-multiple>
				<has-error :form="form" field="academic_section_ids"></has-error>
			</div>
		</template>

		<div class="form-group">
			<label for="status">Status</label>
			<v-toggle v-model="form.status" :options="checkOptions" :disabled="false" :class="{ 'is-invalid': form.errors.has('status') }" id="status" />
			<has-error :form="form" field="status"></has-error>
		</div>
		<v-button :loading="form.busy">{{ $t('Add New') }}</v-button>
	</form>
</template>

<script>
	import VToggle from "../../globals/VToggle";
	import Select2 from "../../globals/Select2";
	import CustomSelect from "../../globals/CustomSelect";
	import VSelect from "../../globals/VSelect";
	import CustomSelectMultiple from '../../globals/CustomSelectMultiple'

	export default {
		name: "Add",
		components: {
			VToggle,
			VSelect,
			CustomSelect,
			Select2,
			CustomSelectMultiple
		},
		data() {
			return {
				form: new Form({
					type: "",
					name: "",
					code: "",
					academic_grading_id: "",
					status: true,
					academic_department_ids: [],
					academic_group_ids: [],
					academic_section_ids: [],
					academic_year_ids: [],
				}),
				checkOptions: {
					on: "ACTIVATED",
					off: "DEACTIVATED",
					onstyle: "success",
					offstyle: "danger",
					width: "100%",
				},
				types: [
					{ id: 0, text: "Only Section Available" },
					{ id: 1, text: "Group Available" },
					{ id: 2, text: "Department Available" },
				],
				type: "",
				sessions: {},
				gradings: {},
				departments: {},
				groups: {},
				years: {},
				sections: {},
			};
		},
		methods: {
			changeType(e) {
				this.type = e;
				this.form.academic_group_ids = [];
				this.form.academic_department_ids = [];
				this.form.academic_section_ids = [];
			},
			addAcademicClass() {
				this.form
					.post("/api/academic-class-store")
					.then((response) => {
						Toast.fire({
							icon: "success",
							title: this.$t("success_message"),
						});
						this.$router.push("/academic-class");
					})
					.catch((error) => {
						if (error.response.status == 422) {
							this.$router.go(this.$router.currentRoute);
							Swal.fire({
								icon: "error",
								title: this.$t("error_alert_title"),
								text: this.$t("error_alert_text"),
							});
						}
					});
			},
			loadAcademicGrading() {
				axios
					.get("/api/load-academic-grading-list")
					.then((res) => (this.gradings = res.data));
			},
			loadAcademicGroups() {
				axios
					.get("/api/load-academic-group-list")
					.then((res) => (this.groups = res.data));
			},
			loadAcademicDepartments() {
				axios
					.get("/api/load-academic-department-list")
					.then((res) => (this.departments = res.data));
			},
			loadAcademicSections() {
				axios
					.get("/api/load-academic-section-list")
					.then((res) => (this.sections = res.data));
			},
		},
		created() {
			this.loadAcademicGrading();
			this.loadAcademicGroups();
			this.loadAcademicDepartments();
			this.loadAcademicSections();
		},
	};
</script>

<style scoped>
	.area {
		border: 1px solid #ddd;
		padding: 5px;
		border-radius: 5px;
	}
</style>
