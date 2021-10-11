<template>
  <custom-card :title="$t('NewAssign')" :url="'/bill-assigns'" :text="$t('AssignList')">
    <form @submit.prevent="assignSubmit">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="academic_class_id">{{ $t('Academic_Class') }}</label>
            <custom-select @change="classChange" :options="classes" v-model="form.academic_class_id" :placeholder="$t('Select_One')"></custom-select>
            <has-error :form="form" field="academic_class_id"></has-error>
          </div>
        </div>
        <div class="col-md-6">
          <template v-if="this.form.academic_class_type == '1'">
            <div class="form-group">
              <label for="academic_group_id">{{ $t('Academic_Group') }}</label>
              <custom-select :options="groups" @change="changeGroup" v-model="form.academic_group_id" :placeholder="$t('Select_One')"></custom-select>
              <has-error :form="form" field="academic_group_id"></has-error>
            </div>
          </template>
          <template v-if="this.form.academic_class_type == '2'">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="academic_department_id">{{ $t('Academic_Department') }}</label>
                <custom-select @change="changeDepartment" :options="departments" v-model="form.academic_department_id" :placeholder="$t('Select_One')"></custom-select>
                <has-error :form="form" field="academic_department_id"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label for="academic_year_id">{{ $t('Department_year') }}</label>
                <custom-select-empty :options="years" @change="changeYear" v-model="form.academic_year_id" :placeholder="$t('Select_One')"></custom-select-empty>
                <has-error :form="form" field="academic_year_id"></has-error>
              </div>
            </div>
          </template>
        </div>
      </div>
      <template v-if="this.form.academic_class_id != ''">
        <hr>

        <div class="form-group">
          <label for="bill_type">{{ $t('SelectType') }}</label>
          <custom-select :options="types" @change="changeBillType" v-model="form.bill_type" :placeholder="$t('Select_One')" name="bill_type"></custom-select>
          <has-error :form="form" field="bill_type"></has-error>
        </div>
        <template v-if="this.form.bill_type === 'Specific'">
          <div class="form-group">
            <label for="student_ids">{{ $t('SelectStudent') }}</label>
            <custom-select-multiple :options="students" v-model="form.student_ids" :placeholder="$t('Select_One')"></custom-select-multiple>
            <has-error :form="form" field="student_ids"></has-error>
          </div>
        </template>
      </template>
      <hr>
      <div class="form-row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between border-bottom">
            <h4>{{ $t('BillItem') }}</h4>
          </div>
          <div class="form-group" v-for="(item, index) in form.items" :key="index">
            <div class="input-group">
              <div class="input-group">
                <input type="text" class="form-control input-sm" v-model="item.text" :readonly="item.id > 1" :required="item.id === 1" />
                <span class="input-group-btn" style="width:0px;"></span>
                <input type="number" step="0.001" class="form-control input-sm" v-model="item.amount" />
                <div class="input-group-append">
                  <button class="btn btn-outline-danger" type="button" @click="deleteItem(index)"><i class="fas fa-trash-alt"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-6">
          <h4>{{ $t('Total') }} : {{ getTotal()|withCurrency }}</h4>
        </div>
      </div>
      <v-button :loading="form.busy">{{ $t('AssignNow') }}</v-button>
    </form>
  </custom-card>
</template>

<script>
  import Select2 from "../../globals/Select2";
  import CustomSelect from "../../globals/CustomSelect";
  import CustomSelectEmpty from "../../globals/CustomSelectEmpty";
  import FormGroupSelect from "../../globals/FormGroupSelect";
  import CustomSelectMultiple from "../../globals/CustomSelectMultiple";

  export default {
    name: "Add",
    components: {
      Select2,
      CustomSelect,
      CustomSelectEmpty,
      FormGroupSelect,
      CustomSelectMultiple,
    },
    data() {
      return {
        form: new Form({
          academic_class_id: "",
          academic_class_type: "",
          academic_group_id: "",
          academic_department_id: "",
          academic_year_id: "",
          bill_type: "",
          total: "",
          items: {},
          student_ids: [],
        }),
        classes: {},
        groups: {},
        departments: {},
        years: {},
        students: [],
        types: [
          { id: "All", text: this.$t("AllStudent") },
          { id: "Specific", text: this.$t("SpecificStudent") },
        ],
      };
    },
    created() {
      this.loadClassList();
      this.loadBillForStudents();
    },
    methods: {
      changeBillType: function (e) {
        if (e === "Specific") {
          let classType = this.form.academic_class_type;
          let yearId = this.form.academic_year_id;
          if (classType === 0) {
            axios
              .get("/api/load-student-for-class", {
                params: { class_id: this.form.academic_class_id },
              })
              .then((res) => {
                this.students = res.data;
              });
          } else if (classType === 1 && this.form.academic_group_id !== "") {
            axios
              .get("/api/load-student-for-class-group", {
                params: {
                  class_id: this.form.academic_class_id,
                  group_id: this.form.academic_group_id,
                },
              })
              .then((res) => {
                this.students = res.data;
              });
          } else if (classType === 2 && this.form.academic_department_id !== "") {
            axios
              .get("/api/load-student-for-class-department-year", {
                params: {
                  class_id: this.form.academic_class_id,
                  department_id: this.form.academic_department_id,
                  year_id: this.form.academic_year_id,
                },
              })
              .then((res) => {
                this.students = res.data;
              });
          }
        }
      },
      getTotal() {
        let total = 0;
        _.forEach(this.form.items, (value, key) => {
          total = parseInt(total) + parseInt(value.amount);
        });
        this.form.total = total;
        return total;
      },
      assignSubmit() {
        this.form.post("/api/bill-assign-submit").then((res) => {
          Toast.fire({
            icon: "success",
            title: this.$t("success_message_create"),
          });
          this.$router.push("/bill-assigns");
        });
      },
      deleteItem(index) {
        if (this.form.items.length > 1) {
          this.form.items.splice(index, 1);
        }
      },
      classChange: function (e) {
        if (e) {
          axios
            .get("/api/load-class-group-department", { params: { id: e } })
            .then((res) => {
              this.form.academic_class_type = res.data.type;
              this.groups = res.data.academic_groups;
              this.departments = res.data.academic_departments;
              this.form.bill_type = "";
              this.form.student_ids = [];
              this.students = [];
            });
        }
      },
      changeGroup: function (e) {
        if (e) {
          this.form.bill_type = "";
          this.form.student_ids = [];
          this.students = [];
        }
      },
      changeYear: function (e) {
        if (e) {
          this.form.academic_year_id = e;
          this.form.bill_type = "";
          this.form.student_ids = [];
          this.students = [];
        }
      },
      changeDepartment: function (e) {
        if (e) {
          axios
            .get("/api/load-department-years", { params: { id: e } })
            .then((res) => {
              this.form.academic_class_type = 2;
              this.years = {};
              this.years = res.data.sections;
              this.form.bill_type = "";
              this.form.student_ids = [];
              this.students = [];
            });
        }
      },
      loadBillForStudents() {
        axios.get("/api/load-bill-for-student").then((res) => {
          this.form.items = res.data;
        });
      },
      loadClassList() {
        axios.get("/api/load-class-list").then((res) => {
          this.classes = res.data;
        });
      },
    },
  };
</script>

<style scoped>
</style>
