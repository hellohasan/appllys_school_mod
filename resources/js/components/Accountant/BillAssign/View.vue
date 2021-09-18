<template>
    <custom-card :title="$t('ViewAssign')" :url="'/bill-assigns'" :text="$t('AssignList')">

        <div class="ph-item" v-if="isLoading">
            <div class="ph-col-12">
                <div class="ph-row">
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-success" v-else>
            <tbody>
            <tr>
                <td class="text-right">{{$t('SerialNumbers')}}</td>
                <td class="text-left">{{bill.custom}}</td>
            </tr>
            <tr>
                <td class="text-right">{{$t('Academic_Session')}}</td>
                <td class="text-left">{{bill.academic_session.duration}}</td>
            </tr>
            <tr>
                <td class="text-right">{{$t('Academic_Class')}}</td>
                <td class="text-left">{{bill.academic_class.name}}</td>
            </tr>
            <template v-if="bill.academic_class_type == 1">
                <tr>
                    <td class="text-right">{{$t('Academic_Group')}}</td>
                    <td class="text-left">{{bill.academic_group.name}}</td>
                </tr>
            </template>
            <template v-else-if="bill.academic_class_type == 2">
                <tr>
                    <td class="text-right">{{$t('Academic_Department')}}</td>
                    <td class="text-left">{{bill.academic_department.name}}</td>
                </tr>
                <tr>
                    <td class="text-right">{{$t('Department_year')}}</td>
                    <td class="text-left">{{bill.academic_year.name}}</td>
                </tr>
            </template>
            <tr>
                <td class="text-right">{{$t('SelectType')}}</td>
                <td class="text-left" v-if="bill.bill_type === 'All'">{{$t('AllStudent')}}</td>
                <td class="text-left" v-else>{{$t('SpecificStudent')}}</td>
            </tr>
            <tr>
                <td class="text-right">{{$t('TotalStudent')}}</td>
                <td class="text-left">{{bill.bill_students_count | students}}</td>
            </tr>
            <tr>
                <td class="text-right">{{$t('Total')}}</td>
                <td class="text-left">{{bill.total|withCurrency}}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <img :src="'/img/pad.png'" alt="" style="width: 100%;margin: 0 auto">
                    <table class="table table-bordered table-secondary">
                        <thead>
                        <tr>
                            <th class="text-right">{{$t('Details')}}</th>
                            <th class="text-left">{{$t('amount')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(b, index) in bill.items" :key="index">
                            <td class="text-right">{{b.text}}</td>
                            <td class="text-left">{{b.amount|withCurrency}}</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="bg-secondary white">
                            <td class="text-right">{{$t('Total')}}</td>
                            <td class="text-left">{{bill.total|withCurrency}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

    </custom-card>
</template>

<script>
export default {
    name: "BillView",
    data(){
        return{
            isLoading: true,
            custom : '',
            bill : {}
        }
    },
    methods:{
        loadBillStudent(){
            axios.get(`/api/bill-assign-view/${this.$route.params.custom}`).then((res)=>{
                this.bill = res.data
                this.isLoading = false
            }).catch((error)=>{
                Swal.fire({
                    icon: 'error',
                    title: this.$t('error_alert_title'),
                    text: this.$t('error_alert_text')
                })
            })
        }
    },
    created() {
        this.loadBillStudent()
    },
    mounted() {
        this.custom = this.$route.params.custom
    }
}
</script>

<style scoped>

</style>
