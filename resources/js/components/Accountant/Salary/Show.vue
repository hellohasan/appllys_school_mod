<template>
  <custom-card :title="$t('ShowSalary')" :url="`/salary`" :text="$t('SalaryList')">
    <div id="printAble">
      <div class="row">
        <div class="col-12">
          <div class="text-center">
            <h3>{{basic.name}}</h3>
            <h5>{{basic.address}}</h5>
            <h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
          </div>
        </div>
        <div class="col-12 mt-1" v-if="salary != ''">
          <div class="d-flex justify-content-around">
            <p>{{ $t('Title') }}: {{ salary.title }}</p>
            <p>{{ $t('CreateBy') }}: {{ salary.creator.name }}</p>
            <p>{{ $t('CreatedFor') }}: {{ salary.role.name }} {{ $t('Salary') }}</p>
            <p>{{ $t('CreatedAt') }}: {{ salary.created_at | myDate }}</p>
          </div>
        </div>
        <div class="col-12 mt-1" v-if="salaries.length">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <td>{{ $t('Custom') }}</td>
                <td>{{ $t('Name') }}</td>
                <td>{{ $t('salary_scale') }}</td>
                <td>{{ $t('amount') }}</td>
                <td>{{ $t('PayVia') }}</td>
                <td>{{ $t('PayAt') }}</td>
                <td>{{ $t('Withdrawal') }}?</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, i) in salaries" :key="i">
                <td>{{ item.custom }}</td>
                <td>{{ item.user.name }}</td>
                <td>{{ item.scale.title }}</td>
                <td>{{ item.amount | withCurrency }}</td>
                <td>{{ item.account.name }}</td>
                <td>{{ item.created_at | myDate }}</td>
                <td>
                  <label class="badge badge-success" v-if="item.is_attempt">{{ $t('Lifted') }}</label>
                  <label class="badge badge-warning" v-else>{{ $t('Pending') }}</label>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-right">{{ $t('GrandTotal') }}</td>
                <td colspan="3">{{ salary.total | withCurrency }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-12">
          <div class="d-flex justify-content-around mt-5">
            <div class="text-center">
              <p>---------------------------------- <br> {{ $t('HeadSign') }}</p>
            </div>

            <div class="text-center">
              <p>---------------------------------- <br> {{ $t('AccountantSign') }}</p>
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
    name: "Show",
    data() {
      return {
        salary: '',
        salaries: {},
        basic: {},
      };
    },
    methods: {
      async printMe(divName) {
        await this.$htmlToPaper(divName);
      },
      showSalary(custom) {
        axios.get(`/api/salary/${custom}`).then((res) => {
          this.salary = res.data
          this.salaries = res.data.salaries;
        });
      },
    },
    created() {
      this.showSalary(this.$route.params.custom);
      this.basic = this.$store.getters.basicData;
    },
  };
</script>

<style lang="scss" scoped>
</style>
