<template>
    <div
        class="base-image-input"
        :style="{ 'background-image': `url(${getSetImage})`,'background-repeat':'no-repeat','background-size':'cover','width':`${width}`,'height':`${height}` }"
        @click="chooseImage"
    >
    <span
        v-if="!haveImage"
        class="placeholder"
    >
        {{custom}}
    </span>
        <input
            class="file-input"
            ref="fileInput"
            type="file"
            :name=inputName
            @input="onSelectFile"
        >
        <slot/>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "VImage",
    props:{
        width:{
            type: String,
            default: "200px",
        },
        height:{
            type: String,
            default: "200px",
        },
        size:{
            default: 0,
        },
        custom:{
            type: String,
            default: 'Choice One'
        },
        defaultImage: {
            type: String,
            default: "",
        },
        inputName: {
            type: String,
            default: "file",
        },
    },
    data () {
        return {
            setImage: null,
        }
    },
    computed:{
        getSetImage () {
            return this.setImage !== null ? this.setImage : this.defaultImage
        },
        haveImage(){
            return !!this.defaultImage;
        }
    },
    methods: {
        chooseImage () {
            this.$refs.fileInput.click()
        },
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
.base-image-input {
    display: block;
    cursor: pointer;
    background-size: cover;
    background: #ddd;
    position: relative;
}
.placeholder {
    background: #F0F0F0;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    font-size: 18px;
    position: absolute;
    bottom: 0;
}
.placeholder:hover {
    background: #E0E0E0;
}
.file-input {
    display: none;
}
</style>
