<template>
    <custom-card :title="$t('ExpenseMemo')" :url="'/expenses'" :text="$t('ExpenseList')">
        <div id="printAble">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h3>{{basic.name}}</h3>
                        <h5>{{basic.address}}</h5>
                        <h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
                        <span class="border rounded p-2">{{ $t('ShowExpense') }}</span>
                    </div>
                </div>
                <div class="col-12 border-bottom">
                    <div class="d-flex justify-content-between">
                        <p>{{ $t('Custom') }}: {{expense.custom}}</p>
                        <p>{{ $t('Date') }}: {{expense.updated_at|myDate}}</p>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>{{ $t('Details') }}</td>
                                <td>{{ $t('amount') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, i) in expense.items" :key="i">
                                <td>{{ item.item.title }}</td>
                                <td>{{ item.amount | withCurrency }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right">{{ $t('GrandTotal') }}</td>
                                <td>{{ expense.total | withCurrency }}</td>
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
                expense: {},
                basic: {},
            };
        },
        methods: {
            async printMe(divName) {
                await this.$htmlToPaper(divName);
            },
            showExpense(custom) {
                axios.get(`/api/expenses/${custom}`).then((res) => {
                    this.expense = res.data;
                });
            },
        },
        created() {
            this.showExpense(this.$route.params.custom);
            this.basic = this.$store.getters.basicData;
        },
    };
</script>

<style lang="scss" scoped>
</style>
