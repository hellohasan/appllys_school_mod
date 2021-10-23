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
              <label for="academic_class_id">Academic Class</label>
              <custom-select @change="classChange" :options="classes" v-model="form.academic_class_id" placeholder="Select One"></custom-select>
              <has-error :form="form" field="academic_class_id"></has-error>
            </div>
          </div>
          <div class="col-md-6">
            <template v-if="this.form.academic_class_type == '1'">
              <div class="form-group">
                <label for="academic_group_id">Select Class Groups</label>
                <custom-select :options="groups" v-model="form.academic_group_id" placeholder="Select One"></custom-select>
                <has-error :form="form" field="academic_group_id"></has-error>
              </div>
            </template>
            <template v-if="this.form.academic_class_type == '2'">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="academic_department_id">Select Department</label>
                  <custom-select @change="changeDepartment" :options="departments" v-model="form.academic_department_id" placeholder="Select One"></custom-select>
                  <has-error :form="form" field="academic_department_id"></has-error>
                </div>
                <div class="form-group col-md-6">
                  <label for="academic_section_id">Select Year</label>
                  <custom-select-empty :options="years" v-model="form.academic_section_id" placeholder="Select One"></custom-select-empty>
                  <has-error :form="form" field="academic_section_id"></has-error>
                </div>
              </div>
            </template>
          </div>
          <div class="col-md-12">
            <v-button :loading="form.busy">{{ $t('Search') }}</v-button>
          </div>
        </div>
      </form>
      <hr>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Code</th>
            <th>Mark</th>
            <th>Type</th>
            <th>Religion</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <template v-if="subjects.length > 0">
            <tr v-for="(subject, index) in subjects" :key="index">
              <td>{{++index}}</td>
              <td>{{subject.name}}</td>
              <td>{{subject.code}}</td>
              <td>
                <template v-if="subject.mark_type">
                  <span>Theory: {{subject.theory}} &nbsp;&nbsp; Practical: {{subject.practical}} &nbsp;&nbsp;</span>
                </template>
                <span>Total: {{subject.full_mark}}</span>
              </td>
              <td>
                <template v-if="subject.subject_type">
                  <h6>Optional Subject</h6>
                  <span>Total Point: {{subject.total_point}}</span>
                  <span>Optional Point: {{subject.optional_point}}</span>
                </template>
                <template v-else>
                  <h6>Compulsory Subject</h6>
                  <span>Point: {{subject.point}}</span>
                </template>
              </td>
              <td>
                <template v-if="subject.religion_type">
                  <h6>Religious Subject</h6>
                  <span>Religion: {{subject.religion.name}}</span>
                </template>
                <template v-else>
                  <h6>Nonreligious Subject</h6>
                </template>
              </td>
              <td>
                <span class="badge" :class="subject.status ? 'badge-success' : 'badge-warning'">{{subject.status ? 'Activated' : 'Deactivated'}}</span>
              </td>
              <td>
                <router-link :to="`/academic-subject/${subject.id}/edit`" class="btn btn-sm btn-primary font-weight-bold"><i class="fas fa-edit"></i> Edit</router-link>
              </td>
            </tr>
          </template>

          <template v-else>
            <tr>
              <td colspan="8" class="text-center font-weight-bold">Subject list is empty</td>
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
          academic_class_id: '',
          academic_class_type: '',
          academic_group_id: '',
          academic_department_id: '',
          academic_section_id: '',
        }),
        classes: {},
        groups: {},
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
        axios.get('/api/load-class-group-department', { params: { id: e } }).then((res) => {
          this.form.academic_class_type = res.data.type
          this.groups = res.data.academic_groups
          this.departments = res.data.academic_departments
        });
      },
      changeDepartment: function (e) {
        axios.get('/api/load-department-years', { params: { id: e } }).then((res) => {
          this.form.academic_class_type = 2
          this.years = {}
          this.years = res.data.sections
        });
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
