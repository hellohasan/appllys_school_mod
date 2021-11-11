<template>
  <select v-bind:name="name" :id="name" class="form-control" style="width: 100%" :multiple="multiple"></select>
</template>

<script>
  export default {
    name: "VSelect",
    props: ['name', 'options', 'value', 'multiple'],
    mounted() {
      let vm = this
      let select = $("#" + this.name)
      select
        .select2({
          placeholder: this.$i18n.tc('SelectMultiple'),
          width: '100%',
          allowClear: true,
          data: this.options
        })
        .val(this.value).trigger('change')
        .on('change', function () {
          vm.$emit('input', select.val())
        })
    },
    watch: {
      value: function (value) {
        if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(","))
          $("#" + this.name).val(value).trigger('change');
      },
      options: function (options) {
        // update options
        $("#" + this.name).select2({
          data: options,
          placeholder: this.$i18n.tc('SelectMultiple'),
          width: '100%',
          allowClear: true,
        })
      }
    },

    destroyed: function () {
      $("#" + this.name).off().select2('destroy')
    }
  }
</script>

<style scoped>
</style>
