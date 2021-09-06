<template>
    <div class="form-group" :class="col">
        <label :for="name">{{label}}</label>
        <input
            type="file"
            :class="{ 'is-invalid': form.errors.has(name) }"
            :id="name"
            :name="name"
            :required="required"
            @input="onSelectFile"
            class="form-control">
        <has-error :form="form" :field="name"></has-error>
        <span v-show="msg" class="text-red">{{msg}}</span>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "CustomImage",
    props: {
        msg:{
            type:String,
            default: null,
        },
        size:{
            default: 0,
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
        }
    },
    data () {
        return {
            setImage: null,
        }
    },
    methods: {
        onSelectFile (e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if (this.size){
                if (file['size'] < (this.size * 1000)){
                    reader.onloadend = (file) => {
                        this.setImage = reader.result
                        this.$emit('input', reader.result)
                    }
                    reader.readAsDataURL(file)
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning.!',
                        text: 'Please select a image which size less then '+this.size+'kb.'
                    })
                }
            }else{
                reader.onloadend = (file) => {
                    this.setImage = reader.result
                    this.$emit('input', reader.result)
                }
                reader.readAsDataURL(file)
            }
        }
    }
}
</script>

<style scoped>

</style>
