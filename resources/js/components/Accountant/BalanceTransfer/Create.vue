<template>
  <custom-card :title="$t('NewBalanceTransfer')" :url="'/balance-transfer'" :text="$t('BalanceTransferList')">
    <form @submit.prevent="submitTransfer">
      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-header font-weight-bold">{{ $t('SenderAccount') }}</div>
            <div class="card-body">
              <div class="form-group">
                <label for="from_account_id">{{ $t('SenderAccount') }}</label>
                <custom-select :options="accounts" v-model="form.from_account_id" :placeholder="$t('Select_One')" name="from_account_id"></custom-select>
              </div>
              <div class="form-group">
                <label for="amount">{{ $t('SendingAmount') }}</label>
                <div class="input-group">
                  <input type="number" step="0.001" v-model="form.amount" :class="{ 'is-invalid': form.errors.has('amount') }" id="amount" :placeholder="$t('SendingAmount')" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $t('BDT') }}</span>
                  </div>
                </div>
                <has-error :form="form" field="amount"></has-error>
              </div>
              <div class="form-group">
                <label for="from_charge">{{ $t('TransferCharge') }}</label>
                <div class="input-group">
                  <input type="number" step="0.001" v-model="form.from_charge" :class="{ 'is-invalid': form.errors.has('from_charge') }" id="from_charge" :placeholder="$t('TransferCharge')" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $t('BDT') }}</span>
                  </div>
                </div>
                <has-error :form="form" field="from_charge"></has-error>
              </div>
              <div class="form-group">
                <label for="from_total">{{ $t('TotalSend') }}</label>
                <div class="input-group">
                  <input type="number" step="0.001" readonly v-model="form.from_total" :class="{ 'is-invalid': form.errors.has('from_total') }" id="from_total" :placeholder="$t('TotalSend')" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $t('BDT') }}</span>
                  </div>
                </div>
                <has-error :form="form" field="from_total"></has-error>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6">
          <div class="card">
            <div class="card-header font-weight-bold">{{ $t('ReceiveAccount') }}</div>
            <div class="card-body">
              <div class="form-group">
                <label for="to_account_id">{{ $t('ReceiveAccount') }}</label>
                <custom-select :options="accounts" v-model="form.to_account_id" :placeholder="$t('Select_One')" name="to_account_id"></custom-select>
              </div>
              <div class="form-group">
                <label for="to_amount">{{ $t('ReceivingAmount') }}</label>
                <div class="input-group">
                  <input type="text" v-model="form.amount" readonly :class="{ 'is-invalid': form.errors.has('to_amount') }" id="to_amount" :placeholder="$t('ReceivingAmount')" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $t('BDT') }}</span>
                  </div>
                </div>
                <has-error :form="form" field="to_amount"></has-error>
              </div>
              <div class="form-group">
                <label for="to_charge">{{ $t('ReceivingCharge') }}</label>
                <div class="input-group">
                  <input type="number" step="0.001" v-model="form.to_charge" :class="{ 'is-invalid': form.errors.has('to_charge') }" id="to_charge" :placeholder="$t('ReceivingCharge')" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $t('BDT') }}</span>
                  </div>
                </div>
                <has-error :form="form" field="to_charge"></has-error>
              </div>
              <div class="form-group">
                <label for="to_total">{{ $t('TotalReceive') }}</label>
                <div class="input-group">
                  <input type="number" step="0.001" readonly v-model="form.to_total" :class="{ 'is-invalid': form.errors.has('to_total') }" id="to_total" :placeholder="$t('TotalReceive')" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $t('BDT') }}</span>
                  </div>
                </div>
                <has-error :form="form" field="to_total"></has-error>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <v-button id="btn" :large='true' :loading="form.busy"><i class="fas fa-paper-plane"></i> {{ $t('Submit') }}</v-button>
        </div>
      </div>
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
          from_account_id: "",
          amount: "",
          from_charge: "",
          from_total: "",
          to_account_id: "",
          to_charge: "",
          to_total: "",
        }),
        accounts: [],
      };
    },
    watch: {
      "form.amount": function (val) {
        this.countSendTotal();
      },
      "form.from_charge": function (val) {
        this.countSendTotal();
      },
      "form.to_charge": function (val) {
        this.countReceiveTotal();
      },
    },
    methods: {
      countSendTotal() {
        let amount = this.form.amount == "" ? 0 : this.form.amount;
        let charge = this.form.from_charge == "" ? 0 : this.form.from_charge;
        let total = parseFloat(amount) + parseFloat(charge);
        this.form.from_total = total;
      },
      countReceiveTotal() {
        let amount = this.form.amount == "" ? 0 : this.form.amount;
        let charge = this.form.to_charge == "" ? 0 : this.form.to_charge;
        let total = parseFloat(amount) - parseFloat(charge);
        this.form.to_total = total;
      },
      submitTransfer() {
        this.form.post("/api/balance-transfer").then((res) => {
          Toast.fire({
            icon: "success",
            text: this.$t("success_message_create"),
          });

          this.$router.push(`/balance-transfer/${res.data.custom}/show`);
        });
      },
      loadAccounts() {
        axios
          .get("/api/load-account-list")
          .then(({ data }) => (this.accounts = data));
      },
    },
    created() {
      this.loadAccounts();
    },
  };
</script>

<style lang="scss" scoped>
</style>
