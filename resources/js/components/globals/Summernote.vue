<template>
    <textarea :id="id" :value="value" @change="onChange"></textarea>
</template>

<script>
export default {
    name: "Summernote",
    props: {
        value: {
            default : ''
        },
        autofocus:{},
        placeholder:{
            type: String,
            default: null
        },
        height:{
            type: Number,
            default: 100
        }
    },
    data() {
        return {
            minHeight: false
        }
    },
    watch: {
        value(val) {
            if (this.summernote.summernote('code') !== val) {
                //this.summernote.summernote("editor.rewind")
                this.summernote.summernote('code', val)
            }
        }
    },
    computed: {
        id() {
            return "sn_" + Date.now()
        }
    },
    beforeDestroy() {
        $("#" + this.id).summernote("destroy")
    },
    mounted() {
        this.summernote = $("#" + this.id).summernote({
            height: this.height,
            minHeight: "100px",
            focus: typeof this.autofocus !== 'undefined',
            placeholder: this.placeholder,
            lineHeight: 20,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold',  'italic', 'underline', 'clear','strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['picture','video']],
                ['view', ['fullscreen','codeview', 'help']],
            ],
        })
        this.summernote.on('summernote.change', this.onChange)
        $("#" + this.id).next().find(".note-toolbar").find("[data-toggle=dropdown]").attr('onclick', '$(this).next().toggle()')
            .next().attr('onclick', '$(this).toggle()')
    },
    methods: {
        onChange(we) {
            this.$emit('input', we.target.value)
        }
    }
}
</script>

<style scoped>

</style>
