<template>
    <div>
        <template v-if="!isLoggedIn">
            <auth></auth>
        </template>

        <template v-else>
            <dashboard></dashboard>
        </template>
    </div>

</template>

<script>
    import Auth from './Auth'
    import Dashboard from './Dashboard'
    export default {
        components:{
            Auth,Dashboard
        },
        computed:{
            isLoggedIn(){
                return this.$store.getters.isLoggedIn;
            }
        }

    }
</script>
