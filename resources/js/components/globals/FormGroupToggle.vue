<template>
    <div class="form-group" :class="col">
        <label :for="id">{{label}}:</label>
        <input :id="id" :ref="id" type="checkbox"/>
    </div>
</template>

<script>
import merge from 'merge'
const defaults = {}

export default {
    defaults,
    name: "FormGroupToggle",
    props: {
        value: {
            default: false
        },
        options: {
            type: Object,
            default: function () {
                return {
                    on: this.$i18n.t('Activated'),
                    off: this.$i18n.t('Deactivated'),
                    onstyle: 'success',
                    offstyle: 'danger',
                    width: '100%'
                }
            }
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        id:{
            type: String,
            required: true,
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
    data() {
        return { updating: false, };
    },
    computed: {
        $$el() {
            return jQuery(this.$refs[this.id])
        }
    },
    watch: {
        value(newValue) {
            if(this.updating) {
                return;
            }
            this.$$el.bootstrapToggle(newValue ? 'on' : 'off');
        },
        disabled(newValue) {
            this.$$el.bootstrapToggle(newValue ? 'disable' : 'enable');
        }
    },
    mounted() {
        if (this.value) {
            this.$el.checked = true
        }
        this.$$el.bootstrapToggle(merge.recursive(true, defaults, this.options))
        if (this.disabled) { this.$$el.bootstrapToggle('disable') }
        this.$$el.change(() => {
            this.updating = true;
            this.$emit('input', this.$$el.prop('checked'));
            this.$nextTick( () => this.updating = false );
        })
    },
    beforeDestroy() {
        this.$$el.bootstrapToggle('destroy')
        this.$$el.off('change')
    }

}
</script>

<style scoped>

</style>
