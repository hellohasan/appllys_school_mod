<template>
    <div class="form-group" :class="col">
        <label :for="name">{{ label }}:</label>
        <textarea
            :class="{ 'is-invalid': form.errors.has(name) }"
            :id="name"
            :name="name"
            :placeholder="label"
            :value="value"
            :required="required"
            :readonly="readonly"
            :rows="rows"
            :cols="cols"
            @input="updateValue($event.target.value)"
            class="form-control"></textarea>
        <has-error :form="form" :field="name"></has-error>
    </div>
</template>

<script>
export default {
    name: "FormGroupTextarea",
    props: {
        value:{
            default: null
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
        },
        rows:{
            type: Number,
            default: 2
        },
        cols:{
            type: Number,
            default: 20
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
