<template>
	<div class="card">
		<div class="card-header">
			<h3 class="card-title font-weight-bold">{{ $t('Subject_list') }}</h3>
			<div class="card-tools">
				<router-link class="btn btn-success" to="/academic-subject/add">
					<i class="fas fa-plus fa-w"></i> {{ $t('Add New') }}
				</router-link>
			</div>
		</div>
		<div class="card-body p-3">
			<form @submit.prevent="searchClassSubject">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="academic_class_id">{{ $t('SelectAcademicClass') }}</label>
							<custom-select @change="classChange" :options="classes" v-model="form.academic_class_id" placeholder="Select One"></custom-select>
							<has-error :form="form" field="academic_class_id"></has-error>
						</div>
					</div>
					<div class="col-md-6">
						<template v-if="this.form.academic_class_type == '0'">
							<div class="form-group">
								<label for="level_one_id">{{ $t('SelectSection') }}</label>
								<custom-select-empty :options="sections" v-model="form.level_one_id"></custom-select-empty>
								<has-error :form="form" field="level_one_id"></has-error>
							</div>
						</template>
						<template v-if="this.form.academic_class_type == '1'">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="level_one_id">{{ $t('SelectGroup') }}</label>
									<custom-select-empty :options="groups" @change="changeGroup" v-model="form.level_one_id" placeholder="Select One"></custom-select-empty>
									<has-error :form="form" field="level_one_id"></has-error>
								</div>
								<div class="form-group col-md-6">
									<label for="level_two_id">{{ $t('GroupSection') }}</label>
									<custom-select-empty :options="groupSections" v-model="form.level_two_id"></custom-select-empty>
									<has-error :form="form" field="level_two_id"></has-error>
								</div>
							</div>
						</template>
						<template v-if="this.form.academic_class_type == '2'">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="level_one_id">{{ $t('SelectDepartment') }}</label>
									<custom-select-empty @change="changeDepartment" :options="departments" v-model="form.level_one_id" placeholder="Select One"></custom-select-empty>
									<has-error :form="form" field="level_one_id"></has-error>
								</div>
								<div class="form-group col-md-6">
									<label for="level_two_id">{{ $t('DepartmentYear') }}</label>
									<custom-select-empty :options="years" v-model="form.level_two_id" placeholder="Select One"></custom-select-empty>
									<has-error :form="form" field="level_two_id"></has-error>
								</div>
							</div>
						</template>
					</div>
					<div class="col-md-12">
						<v-button :loading="form.busy"><i class="fas fa-search"></i> {{ $t('Search') }}</v-button>
					</div>
				</div>
			</form>
			<hr>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>{{ $t('SL') }}</th>
						<th>{{ $t('SubjectName') }}</th>
						<th>{{ $t('SubjectCode') }}</th>
						<th>{{ $t('Mark') }}</th>
						<th>{{ $t('Type') }}</th>
						<th>{{ $t('Religion') }}</th>
						<th>{{ $t('Status') }}</th>
						<th>{{ $t('Action') }}</th>
					</tr>
				</thead>
				<tbody>
					<template v-if="subjects.length > 0">
						<tr v-for="(sub, index) in subjects" :key="index">
							<td>{{++index}}</td>
							<td>{{sub.subject.name}}</td>
							<td>{{sub.subject.code}}</td>
							<td>
								<template v-if="sub.subject.mark_type">
									<span>{{ $t('Theory') }}: {{sub.subject.theory}} &nbsp;&nbsp; {{ $t('Practical') }}: {{sub.subject.practical}} &nbsp;&nbsp;</span>
								</template>
								<span>{{ $t('Total') }}: {{sub.subject.full_mark}}</span>
							</td>
							<td>
								<template v-if="sub.subject.subject_type">
									<h6>{{ $t('OptionalSubject') }}</h6>
									<span>{{ $t('TotalPoint') }}: {{sub.subject.total_point}}</span>
									<span>{{ $t('OptionalPoint') }}: {{sub.subject.optional_point}}</span>
								</template>
								<template v-else>
									<h6>{{ $t('CompulsorySubject') }}</h6>
									<span>{{ $t('Point') }}: {{sub.subject.point}}</span>
								</template>
							</td>
							<td>
								<template v-if="sub.subject.religion_type">
									<h6>{{ $t('ReligiousSubject') }}</h6>
									<span>{{ $t('Religion') }}: {{sub.subject.religion.name}}</span>
								</template>
								<template v-else>
									<h6>{{ $t('NonreligiousSubject') }}</h6>
								</template>
							</td>
							<td>
								<span class="badge" :class="sub.subject.status ? 'badge-success' : 'badge-warning'">{{sub.subject.status ? $t('Activated') : $t('Deactivated')}}</span>
							</td>
							<td>
								<router-link :to="`/academic-subject/${sub.id}/edit`" class="btn btn-sm btn-primary font-weight-bold"><i class="fas fa-edit"></i> {{ $t('Edit') }}</router-link>
							</td>
						</tr>
					</template>
					<template v-else>
						<tr>
							<td colspan="8" class="text-center font-weight-bold">{{ $t('SubjectListEmpty') }}</td>
						</tr>
					</template>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	import CustomSelect from "../../globals/CustomSelect";
	import CustomSelectEmpty from "../../globals/CustomSelectEmpty";
	export default {
		name: "Index",
		components: {
			CustomSelect, CustomSelectEmpty
		},
		data() {
			return {
				form: new Form({
					academic_class_type: '',
					academic_class_id: '',
					level_one_id: '',
					level_two_id: '',
				}),
				classes: {},
				sections: {},
				groups: {},
				groupSections: {},
				departments: {},
				years: {},
				subjects: {}
			}
		},
		methods: {
			searchClassSubject() {
				this.subjects = {};
				this.form.post('/api/search-class-subject').then((res) => {
					this.subjects = res.data
				})
			},
			classChange: function (e) {
				if (e) {
          axios.get('/api/load-class-group-department', { params: { id: e } }).then((res) => {
					this.form.academic_class_type = res.data.type;
          this.form.level_one_id = '';
          this.form.level_two_id = '';
					this.sections = res.data.sections;
					this.groups = res.data.academic_groups;
					this.departments = res.data.academic_departments;
				});
        }
			},
			changeGroup: function (e) {
				if (e) {
          axios.get('/api/load-only-group-section', { params: { id: e } }).then((res) => {
					this.form.academic_class_type = 1;
          this.form.level_two_id = '';
					this.groupSections = {};
					this.groupSections = res.data.sections;
				});
        }
			},
			changeDepartment: function (e) {
				if (e) {
          axios.get('/api/load-only-department-year', { params: { id: e } }).then((res) => {
					this.form.academic_class_type = 2;
          this.form.level_two_id = '';
					this.years = {};
					this.years = res.data.sections;
				});
        }
			},
			loadClassList() {
				axios.get('/api/load-class-list').then((res) => {
					this.classes = res.data
				});
			}
		},
		created() {
			this.loadClassList()
		}
	}
</script>

<style scoped>
</style>
