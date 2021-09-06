<template>
    <select v-bind:name="name" :id="id" class="form-control" multiple="multiple"></select>
</template>

<script>
export default {
    name: "SelectMulti",
    props: {
        name: '',
        options: {

        },
        placeholder:{
            String,
            default: 'Select Multiple'
        },
        value: null,
    },
    computed: {
        id() {
            return "select_multi_" + Date.now()
        }
    },
    data() {
        return {
            select2data: []
        }
    },
    mounted() {
        this.formatOptions()
        let vm = this
        let select = $(this.$el)
        select
            .select2({
                placeholder: this.placeholder,
                width: '100%',
                allowClear: true,
                data: this.select2data
            })
            .on('change', function () {
                vm.$emit('input', select.val())
            })
        select.val(this.value).trigger('change')
    },
    methods: {
        formatOptions() {
            this.select2data.push({ id: '', text: 'Select' }) // you can remove if it does not work correctly
            for (let opt of this.options) {
                this.select2data.push({ id: opt.id, text: opt.text })
            }
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
}
</script>

<style scoped>

</style>
