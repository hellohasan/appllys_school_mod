<template>
    <select :name="name" :id="id" class="form-control is-invalid" multiple>
        <option></option>
    </select>
</template>

<script>
export default {
    name: "FormGroupSelectMultiple",
    twoWay: true,
    priority: 1000,
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
                vm.$emit('input', $(this).val())
            })
    },
    watch: {
        value: function (value) {
            if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(","))
                $(this.$el).val(value).trigger('change');
        },
        options: function (options) {
            // update options
            $(this.$el).select2({
                data: options,
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
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
