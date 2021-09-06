<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{$t('Academic_Grading')}}</h3>
                    <div class="card-tools">
                        <router-link class="btn btn-success" to="/academic-grading/add">
                            <i class="fas fa-plus fa-w"></i> {{$t('Add New')}}
                        </router-link>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Grading"
}
</script>

<style scoped>

</style>
