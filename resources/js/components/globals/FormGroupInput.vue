<template>
    <div class="form-group" :class="col">
        <label :for="name">{{label}}:</label>
        <input
            :type="type"
            :class="{ 'is-invalid': form.errors.has(name) }"
            :id="name"
            :name="name"
            :placeholder="label"
            :value="value"
            :required="required"
            :readonly="readonly"
            @input="updateValue($event.target.value)"
            class="form-control">
        <has-error :form="form" :field="name"></has-error>
    </div>
</template>

<script>
export default {
    name: "FormGroupInput",
    props: {
        value:{
            default: null
        },
        type: {
            type: String,
            default: 'text'
        },
        name: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        form:{
            type: Object,
            required: true
        },
        col:{
            type: String,
            default: null
        },
        required:{
            required: false,
            type: Boolean,
            default: false
        },
        readonly:{
            required: false,
            type: Boolean,
            default: false
        }
    },
    methods: {
        updateValue: function (value) {
            this.$emit('input', value)
        }
    }
}
</script>

<style scoped>

</style>
