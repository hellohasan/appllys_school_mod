<template>

    <div>
        <div class="ph-item" v-if="!customers.length">
            <div class="ph-col-12">
                <div class="ph-row">
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                    <div class="ph-col-12 big"></div>
                </div>
            </div>
        </div>

        <table class="table table-hover" v-else>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Modify</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!customers.length">
                <tr>
                    <td colspan="5" class="text-center">No Customer available</td>
                </tr>
            </template>
            <template v-else>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>
                        <router-link :to="`/customers/${customer.id}`" class="btn btn-success btn-sm">view</router-link>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    mounted(){
        if(this.customers.length){
            return;
        }
        this.$store.dispatch('getCustomer');
    },
    computed:{
        customers(){
            return this.$store.getters.customers;
        }
    }
}
</script>

<style>

</style>
