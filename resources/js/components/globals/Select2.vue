<template>
    <select :name="name" :id="id" class="form-control is-invalid">
        <option disabled value="">{{$t('Select_One')}}</option>
    </select>
</template>

<script>
export default {
    name: "Select2",
    props: ['options','value','name','placeholder'],
    computed: {
        id() {
            return "select_" + Math.random().toString(36).substring(7);
        }
    },
    mounted: function () {
        var vm = this
        $("#" + this.id)
            // init select2
            .select2({
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
                data: this.options
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
            $("#" + this.id)
                .val(value)
                .trigger('change')
        },
        options: function (options) {
            // update options
            $("#" + this.id).select2({
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
                data: options
            })
        }
    },
    destroyed: function () {
        $("#" + this.id).off().select2('destroy')
    }
}
</script>

<style scoped>

</style>
