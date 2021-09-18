<template>
    <custom-card
        :title="$t('Admission_list')"
        :url="'/admissions/add'"
        :text="$t('New_admission')"
        :icon="'fas fa-plus'">

        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                </tbody>
            </table>
        </div>

    </custom-card>
</template>

<script>
require("../../helpers/datatable")
import $ from "jquery";
export default {
    name: "Datatable",
    mounted() {
        this.myTable();
    },
    methods: {
        myTable() {
            $("#myTable").DataTable({
                responsive: true
            });
        }
    }

}
</script>

<style scoped>

</style>
