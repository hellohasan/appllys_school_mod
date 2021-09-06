<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{$t('TeacherSubject')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>
