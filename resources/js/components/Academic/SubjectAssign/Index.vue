<template>
    <div>

    </div>
</template>

<script>
    export default {
        "name" : "Index",
        data(){
            return{
                teachers : []
            }
        },
        methods:{
            loadTeacherList(){
                axios.get('/api/load-teacher-list').then(({data}) => this.teachers = data)
            }
        },
        created() {
            this.loadTeacherList();
        }
    }
</script>

<style lang="scss" scoped>

</style>
