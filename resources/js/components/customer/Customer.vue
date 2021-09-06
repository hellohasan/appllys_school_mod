<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manage Customer</h3>
                    <div class="card-tools">
                        <router-link class="btn btn-success" to='/customers/add'><i class="fas fa-user-plus fa-w"></i> Add Customer</router-link>
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

}
</script>

<style>

</style>
