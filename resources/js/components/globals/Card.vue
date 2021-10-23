<template>
  <div class="row">
    <div class="col-12">
      <div class="card card-success card-outline">
        <div v-if="title" class="card-header">
          <h3 class="card-title font-weight-bold"><i class="fa-w" :class="icon"></i> {{ title }}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-3">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Card",
    props: {
      title: {
        type: String, default: null
      },
      icon: {
        type: String, default: ''
      }
    }
  }
</script>

<style scoped>
</style>
