<template>
    <custom-card :title="$t('ReceiveList')" :url="'/bill-receive/new'" :icon="'fas fa-plus'" :text="$t('NewReceive')">

        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>{{ $t("SL") }}</th>
                    <th>{{ $t("Custom") }}</th>
                    <th>{{ $t("StudentName") }}</th>
                    <th>{{ $t("AssignedAt") }}</th>
                    <th>{{ $t("Total") }}</th>
                    <th>{{ $t("Fine") }} (+)</th>
                    <th>{{ $t("Waiver") }} (-)</th>
                    <th>{{ $t("GrandTotal") }}</th>
                    <th>{{ $t("Paid") }}</th>
                    <th>{{ $t("Due") }}/{{ $t("Status") }}/{{$t("Date") }}</th>
                    <th>{{ $t("Action") }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(list,index) in lists" :key="index">
                    <td>{{++index}}</td>
                    <td>{{list.package.custom}}</td>
                    <td>{{list.user.name}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </custom-card>
</template>

<script>
import {myTableDom} from "../../../helpers/myTableDom";
export default {
    name: "Index",
    data(){
        return{
            lists : {}
        }
    },
    methods:{
        myTable(){
            this.$nextTick(()=>{
                $('#myTable').DataTable(myTableDom)
            })
        },
        loadBillPayList(){
            axios.get('/api/load-bill-pay-lists').then((res) =>{
                this.lists = res.data
                this.myTable()
            })
        }
    },
    created(){
        this.loadBillPayList()
    }
}
</script>

<style scoped>

</style>
