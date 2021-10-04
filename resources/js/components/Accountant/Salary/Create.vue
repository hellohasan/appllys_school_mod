<template>
  <custom-card :title="$t('NewSalary')" :url="'/salary'" :text="$t('SalaryList')">

    <div class="alert alert-danger" role="alert" v-show="Object.keys(this.salaryForm.errors.errors).length">
      <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> {{ $t('Warning') }}.!</h4>
      <ul class="list-group">
        <li class="list-group-item" v-for="(err,er) in this.salaryForm.errors.errors" :key="er">{{err[0]}}</li>
      </ul>
    </div>
    <form @submit.prevent="roleSubmit" class="border-bottom">
      <div class="form-row">
        <form-group-input :form="salaryForm" v-model="salaryForm.title" col="col-md-4" name="title" :label="$t('Title')"></form-group-input>
        <div class="form-group col-md-4">
          <form-group-select :options="roleList" class="input-lg" :label="$t('SelectRole')" id="role_id" v-model="form.role_id" :form="form"></form-group-select>
        </div>
        <div class="form-group col-md-4">
          <label for="btn">{{ $t('Search') }}</label>
          <v-button id="btn" :large='false' :loading="form.busy"><i class="fas fa-search"></i> {{ $t('Search') }}</v-button>
        </div>
      </div>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>{{ $t('Name') }}</th>
            <th>{{ $t('Role') }}</th>
            <th>{{ $t('salary_scale') }}</th>
            <th>{{ $t('amount') }}</th>
            <th>{{ $t('PayVia') }}</th>
            <th>{{ $t('Action') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in salaryForm.salaries" :key="index">
            <td>{{ item.name }}</td>
            <td> {{ item.role_name }} </td>
            <td> {{ item.scale }} </td>
            <td>
              <div class="input-group">
                <input type="number" step="0.001" v-model="item.amount" class="form-control" :placeholder="$t('amount')" name="amount" id="amount">
                <div class="input-group-append">
                  <div class="btn btn-outline-danger" type="button">{{ $t('BDT') }}</div>
                </div>
              </div>
            </td>
            <td>
              <div class="form-group">
                <custom-select :options="accounts" v-model="item.account_id" :placeholder="$t('Select_One')" name="account_id"></custom-select>
              </div>
            </td>
            <td>
              <button class="btn btn-outline-danger btn-sm" type="button" @click="deleteItem(index)"><i class="fas fa-trash-alt"></i> {{ $t('Delete') }}</button>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-right font-weight-bold">{{ $t('GrandTotal') }}</td>
            <td colspan="3" class="font-weight-bold">{{ getTotal() | withCurrency }}</td>
          </tr>
        </tfoot>
      </table>

      <button @click="submitData" :disabled='btn' :class="{'btn-loading':salaryForm.busy}" type="button" class="btn btn-primary btn-block font-weight-bold btn-lg"><i class="far fa-paper-plane"></i> {{ $t('Submit') }}</button>

    </form>
  </custom-card>
</template>

<script>
  import CustomSelect from "../../globals/CustomSelect.vue";
  export default {
    name: "Create",
    components: {
      CustomSelect,
    },
    data() {
      return {
        form: new Form({
          role_id: "",
        }),
        salaryForm: new Form({
          title: "",
          role_id: "",
          salaries: [],
        }),
        btn: true,
        accounts: [],
        roleList: [{ id: "all", text: this.$t("AllRole") }],
      };
    },
    watch: {
      "form.role_id": function (val) {
        this.salaryForm.role_id = val;
      },
    },
    methods: {
      submitData() {
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
            this.salaryForm.post("/api/salary").then((res) => {
              Toast.fire({
                icon: "success",
                text: this.$t("success_message_create"),
              });

              this.$router.push(`/salary/${res.data.salary_id}/show`);
            });
          }
        });
      },
      getTotal() {
        let total = 0;
        _.forEach(this.salaryForm.salaries, (value, key) => {
          let amount = value.amount == "" ? 0 : value.amount;
          total = parseInt(total) + parseInt(amount);
        });
        this.salaryForm.total = total;
        return total;
      },
      deleteItem(index) {
        if (this.salaryForm.salaries.length > 1) {
          this.salaryForm.salaries.splice(index, 1);
        }
      },
      roleSubmit() {
        if (this.form.role_id != "") {
          this.form.post("/api/salary-finder").then((res) => {
            this.salaryForm.salaries = [];
            let salaries = this.salaryForm.salaries;
            _.forEach(res.data, function (value, key) {
              salaries.push({
                user_id: value.id,
                name: value.name,
                scale: value.salary.salary_scale.title,
                scale_id: value.salary.salary_scale.id,
                amount: value.salary.salary_scale.amount,
                role_name: value.roles[0].name,
                account_id: "",
              });
            });
            this.btn = this.salaryForm.salaries.length ? false : true;
          });
        } else {
          Swal.fire({
            icon: "error",
            title: this.$t("error_alert_title"),
            text: this.$t("role_select_error"),
            showConfirmButton: false,
          });
        }
      },
      loadRoleList() {
        axios.get("/api/load-role-list").then(({ data }) => {
          let rolelist = this.roleList;
          _.forEach(data, function (value, key) {
            rolelist.push(value);
          });
        });
      },
      loadAccountList() {
        axios
          .get("/api/load-account-list")
          .then(({ data }) => (this.accounts = data));
      },
    },
    created() {
      this.loadRoleList();
      this.loadAccountList();
    },
  };
</script>

<style lang="scss" scoped>
</style>
