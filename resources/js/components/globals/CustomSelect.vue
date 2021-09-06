<template>
    <select :name="name" :id="id" class="form-control is-invalid">
        <option></option>
    </select>
</template>

<script>
export default {
    name: "CustomSelect",
    props: ['options', 'value', 'name', 'id', 'placeholder'],
    mounted: function () {
        var vm = this
        $(this.$el)
            // init select2
            .select2({
                data: this.options,
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
            })
            .val(this.value)
            .trigger('change')
            // emit event on change.
            .on('change', function () {
                vm.$emit('input', this.value)
            })

    },
    watch: {
        value: function (value) {
            // update value
            $(this.$el)
                .val(value)
                .trigger('change');
            this.$emit('change', value);
        },
        options: function (options) {
            // update options
            $(this.$el).select2({
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
                data: options,
            })
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
}
</script>

<style scoped>

</style>
