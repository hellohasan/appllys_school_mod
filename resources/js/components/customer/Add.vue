<template>
    <form @submit.prevent="addCustomer" class="p-5">
        <div class="form-group">
            <input v-model="form.name" type="text" name="name" placeholder="Name"
                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
            <has-error :form="form" field="name"></has-error>
        </div>

        <div class="form-group">
            <input v-model="form.email" type="email" name="email" placeholder="Email"
                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
            <has-error :form="form" field="email"></has-error>
        </div>

        <div class="form-group">
            <input v-model="form.phone" type="phone" name="phone" placeholder="phone"
                class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
            <has-error :form="form" field="phone"></has-error>
        </div>

        <div class="form-group">
            <input v-model="form.website" type="website" name="website" placeholder="website"
                class="form-control" :class="{ 'is-invalid': form.errors.has('website') }">
            <has-error :form="form" field="website"></has-error>
        </div>

        <v-button :loading="form.busy">Submit</v-button>

    </form>
</template>

<script>

export default {

    data(){
        return{
            form:new Form({
                name:'',
                email:'',
                phone:'',
                website:'',
            }),
        }
    },
    methods:{
        addCustomer(){
            this.form.post('/api/customers')
            .then((response)=>{
                this.$router.push('/customers')
            })
        }
    }
}
</script>

<style>

</style>
