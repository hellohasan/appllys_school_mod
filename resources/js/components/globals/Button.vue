<template>
    <button :type="nativeType" :disabled="loading" :class="{
    [`btn-${type}`]: true,
    'btn-block': block,
    'btn-lg': large,
    'btn-loading': loading,
    'font-weight-bold': bold,
    'text-uppercase': uppercase,
  }" class="btn"
    >
        <slot/>
    </button>
</template>

<script>
export default {
    name: 'VButton',

    props: {
        type: {
            type: String,
            default: 'primary'
        },

        nativeType: {
            type: String,
            default: 'submit'
        },

        loading: {
            type: Boolean,
            default: false
        },

        block: {
            type: Boolean,
            default: true
        },

        large: {
            type: Boolean,
            default: true
        },

        bold: {
            type: Boolean,
            default: true
        },

        uppercase: {
            type: Boolean,
            default: true
        }
    }
}
</script>
