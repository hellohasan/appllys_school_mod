<template>
  <custom-card :title="$t('ShowBalanceTransfer')" :url="`/balance-transfer`" :text="$t('BalanceTransferList')">
    <div id="printAble">
      <div class="row">
        <div class="col-12">
          <div class="text-center">
            <h3>{{basic.name}}</h3>
            <h5>{{basic.address}}</h5>
            <h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
            <span class="border rounded p-2">{{ $t('ShowBalanceTransfer') }}</span>
          </div>
        </div>
        <div class="col-12 border-bottom mt-3">
          <div class="d-flex justify-content-between">
            <p>{{ $t('Custom') }}: {{transfer.custom}}</p>
            <p>{{ $t('CreateBy') }}: {{transfer.creator.name}}</p>
            <p>{{ $t('Date') }}: {{transfer.updated_at|myDateTime}}</p>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <div class="card">
            <div class="card-header font-weight-bold">{{ $t('SenderAccount') }}</div>
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="text-right">{{ $t('Details') }}</th>
                    <th>{{ $t('amount') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-right">{{ $t('SenderAccount') }}</td>
                    <td>{{ transfer.sender_account.name }}</td>
                  </tr>
                  <tr>
                    <td class="text-right">{{ $t('SendingAmount') }}</td>
                    <td>{{ transfer.amount | withCurrency }}</td>
                  </tr>
                  <tr>
                    <td class="text-right">{{ $t('TransferCharge') }}</td>
                    <td>{{ transfer.from_charge | withCurrency }}</td>
                  </tr>
                  <tr>
                    <td class="text-right">{{ $t('TotalSend') }}</td>
                    <td>{{ transfer.from_total | withCurrency }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-header font-weight-bold">{{ $t('ReceiveAccount') }}</div>
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="text-right">{{ $t('Details') }}</th>
                    <th>{{ $t('amount') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-right">{{ $t('ReceiveAccount') }}</td>
                    <td>{{ transfer.receive_account.name }}</td>
                  </tr>
                  <tr>
                    <td class="text-right">{{ $t('ReceivingAmount') }}</td>
                    <td>{{ transfer.amount | withCurrency }}</td>
                  </tr>
                  <tr>
                    <td class="text-right">{{ $t('ReceivingCharge') }}</td>
                    <td>{{ transfer.to_charge | withCurrency }}</td>
                  </tr>
                  <tr>
                    <td class="text-right">{{ $t('TotalReceive') }}</td>
                    <td>{{ transfer.to_total | withCurrency }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
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
    <button type="button" @click="deleteTransfer(transfer.custom)" class="btn btn-danger"><i class="fas fa-trash"></i> {{ $t('Delete') }}</button>
  </custom-card>
</template>

<script>
  export default {
    name: "Show",
    data() {
      return {
        transfer: {},
        basic: {},
      };
    },
    methods: {
      async printMe(divName) {
        await this.$htmlToPaper(divName);
      },
      deleteTransfer(custom) {
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
            axios.delete(`/api/balance-transfer/${custom}`).then((res) => {
              Toast.fire({
                icon: "success",
                title: this.$t("delete_message"),
              });
              this.$router.push("/balance-transfer");
            });
          }
        });
      },
      showBalanceTransfer(custom) {
        axios.get(`/api/balance-transfer/${custom}`).then((res) => {
          this.transfer = res.data;
        });
      },
    },
    created() {
      this.showBalanceTransfer(this.$route.params.custom);
      this.basic = this.$store.getters.basicData;
    },
  };
</script>

<style lang="scss" scoped>
</style>
