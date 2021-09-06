<template>
    <div class="form-group" :class="col">
        <label :for="id">{{label}}:</label>
        <select
            :name="id"
            :id="id"
            :class="{ 'is-invalid': form.errors.has(id) }"
            class="form-control">
            <option></option>
        </select>
        <has-error :form="form" :field="id"></has-error>
    </div>
</template>

<script>
export default {
    name: "FormGroupSelect",
    props:{
        options:{
            required: true
        },
        value:{
            default: ''
        },
        id:{
            type: String,
            required: true,
        },
        placeholder:{
            type: String,
            default: function () {
                return this.$t("Select_One")
            }
        },
        form:{
            type: Object,
            required: true
        },
        col: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            required: true,
        }

    },
    mounted: function () {
        var vm = this
        $("#"+this.id)
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
            $("#"+this.id)
                .val(value)
                .trigger('change');
            this.$emit('change', value);
        },
        options: function (options) {
            // update options
            $("#"+this.id).select2({
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
                data: options,
            })
        }
    },
    destroyed: function () {
        $("#"+this.id).off().select2('destroy')
    }
}
</script>

<style scoped>

</style>
