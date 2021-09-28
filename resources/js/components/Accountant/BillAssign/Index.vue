<template>
    <custom-card :title="$t('AssignList')" :url="'/bill-assigns/add'" :icon="'fas fa-plus'" :text="$t('NewAssign')">

        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>{{$t('SL')}}</th>
                    <th>{{$t('Academic_Session')}}</th>
                    <th>{{$t('Academic_Class')}}</th>
                    <th>{{$t('ClassDetails')}}</th>
                    <th>{{$t('TotalStudent')}}</th>
                    <th>{{$t('Total')}}</th>
                    <th>{{$t('Action')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in lists" :key="index">
                    <td>{{++index}}</td>
                    <td>{{item.academic_session.duration}}</td>
                    <td>{{item.academic_class.name}}</td>
                    <td>
                        <template v-if="item.academic_class_type == 0">N/A</template>
                        <template v-else-if="item.academic_class_type == 1">
                            {{item.academic_group.name}}
                        </template>
                        <template v-else>
                            {{item.academic_department.name}} - {{item.academic_year.name}}
                        </template>
                    </td>
                    <td>{{item.bill_students_count | students}}</td>
                    <td>{{item.total|withCurrency}}</td>
                    <td>
                        <router-link :to="`/bill-assigns/${item.custom}/view`" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></router-link>
                        <button class="btn btn-danger btn-sm" @click="deletePackage(item.custom)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </custom-card>
</template>

<script>
require('../../../helpers/datatable')
import $ from "jquery";
export default {
    name: "Index",
    data(){
        return{
            lists:{}
        }
    },
    methods:{
        deletePackage(custom){
            Swal.fire({
                title: this.$t('confirm_title'),
                text: this.$t('confirm_delete_message'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: this.$t('confirm'),
                cancelButtonText: this.$t('cancel'),
            }).then((result) => {
                if (result.isConfirmed){
                    axios.delete('/api/bill-assign-delete',{data:{'custom': custom}})
                        .then(() => {
                            this.lists = this.lists.filter( function(list_item) {
                                return list_item.custom !== custom;
                            })
                            this.myTable();
                            Toast.fire({
                                icon: 'success',
                                title: this.$t('success_message_delete')
                            })
                        }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: this.$t('error_alert_title'),
                            text: this.$t('error_alert_text')
                        })
                    })
                }
            })
        },
        myTable() {
            this.$nextTick(() => {
                $('#myTable').DataTable({
                    responsive: true,
                    retrieve: true,
                })
            })
        },
        loadAssignList(){
            axios.get('/api/bill-assign-list').then((res) => {
                this.lists = res.data
                this.myTable();
            })
        }
    },
    created() {
        this.loadAssignList();
    }
}
</script>

