<template>
    <custom-card :title="$t('NewExpense')" :url="'/expenses'" :text="$t('ExpenseList')">
        <form @submit.prevent="assignSubmit">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between border-bottom">
                        <h4>{{ $t('BillItem') }}</h4>
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
    import axios from "axios";
    export default {
        name: "Create",
        data() {
            return {
                form: new Form({
                    items: "",
                    total: "",
                }),
                items: {},
            };
        },
        methods: {
            deleteItem(index) {
                if (this.form.items.length > 1) {
                    this.form.items.splice(index, 1);
                }
            },
            getTotal() {
                let total = 0;
                _.forEach(this.form.items, (value, key) => {
                    total = parseInt(total) + parseInt(value.default_amount);
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
        },
    };
</script>

<style lang="scss" scoped>
</style>
