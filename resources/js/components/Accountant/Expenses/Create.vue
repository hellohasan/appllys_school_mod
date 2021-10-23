<template>
  <custom-card :title="$t('NewExpense')" :url="'/expenses'" :text="$t('ExpenseList')">
    <form @submit.prevent="expenseSubmit">
      <div class="form-row">
        <div class="col-md-12">
          <div class="text-center">
            <h3>{{ basic.name}}</h3>
            <h5>{{basic.address}}</h5>
            <h6>{{ $t('Phone') }}: {{basic.phone}}</h6>
            <span class="border rounded p-2">{{ $t('ExpenseMemo') }}</span>
          </div>

          <div class="alert alert-danger" role="alert" v-show="Object.keys(this.form.errors.errors).length">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Warring.!</h4>
            <ul class="list-group">
              <li class="list-group-item" v-for="(err,er) in this.form.errors.errors" :key="er">{{err[0]}}</li>
            </ul>
          </div>

          <div class="d-flex justify-content-between border-bottom">
            <h4>{{ $t('BillItem') }}</h4>
            <button type="button" class="btn btn-success btn-sm" @click="addNew"><i class="fas fa-plus"></i> {{ $t('Add New') }}</button>
          </div>

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>{{ $t('Details') }}</th>
                <th width="35%">{{ $t('amount') }}</th>
                <th width="10%">{{ $t('Action') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in form.items" :key="index">
                <td>
                  <div class="form-group">
                    <custom-select :options="items" v-model="item.bill_item_id" :placeholder="$t('Select_One')" name="bill_item_id"></custom-select>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" step="0.001" v-model="item.amount" class="form-control" :placeholder="$t('amount')" name="amount" id="amount">
                    <div class="input-group-append">
                      <div class="btn btn-outline-danger" type="button">{{ $t('BDT') }}</div>
                    </div>
                  </div>
                </td>
                <td>
                  <button class="btn btn-outline-danger btn-sm" type="button" @click="deleteItem(index)"><i class="fas fa-trash-alt"></i> {{ $t('Delete') }}</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-6">
          <h4>{{ $t('Total') }} : {{ getTotal()|withCurrency }}</h4>
        </div>
      </div>
      <v-button :loading="form.busy">{{ $t('Save') }}</v-button>
    </form>
  </custom-card>
</template>

<script>
  import CustomSelect from "../../globals/CustomSelect.vue";
  import axios from "axios";
  export default {
    name: "Create",
    components: { CustomSelect },
    data() {
      return {
        form: new Form({
          items: [
            {
              bill_item_id: "",
              amount: "",
            },
          ],
          total: "",
        }),
        items: {},
        basic: {},
      };
    },
    methods: {
      expenseSubmit() {
        this.form.post("/api/expenses").then((res) => {
          Toast.fire({
            'icon': 'success',
            'message': this.$t('success_message_create')
          });
          this.$router.push(`/expenses/${res.data.custom}/show`);
        });
      },
      addNew() {
        this.form.items.push({
          bill_item_id: "",
          amount: "",
        });
      },
      deleteItem(index) {
        if (this.form.items.length > 1) {
          this.form.items.splice(index, 1);
        }
      },
      getTotal() {
        let total = 0;
        _.forEach(this.form.items, (value, key) => {
          let amount = value.amount == "" ? 0 : value.amount;
          total = parseInt(total) + parseInt(amount);
        });
        this.form.total = total;
        return total;
      },
      loadBillItems() {
        axios.get("/api/load-office-bill-items").then(({ data }) => {
          this.items = data;
        });
      },
    },
    created() {
      this.loadBillItems();
      this.basic = this.$store.getters.basicData;
    },
  };
</script>

<style lang="scss" scoped>
</style>
