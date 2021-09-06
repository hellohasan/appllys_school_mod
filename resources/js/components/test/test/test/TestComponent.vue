<template>
    <card :title="$t('app_title')">

<!--        <div class="form-group">
            <label for="select">Vue Select</label>
            <v-select :options="options" v-model="selected">
                <option disabled value="0">Select one</option>
            </v-select>
        </div>-->

        <div class="form-group">
            <label for="select">Vue Select</label>
            <select2 :options="customs" v-model="selected"></select2>
        </div>
        <div class="form-group">
            <label for="select">Vue Select</label>
            <select2 :options="customs" v-model="selected2"></select2>
        </div>
        <div class="form-group">
            <label for="select">Vue Select</label>
            <select2 :options="customs" v-model="selected3"></select2>
        </div>

        <bootstrap-toggle v-model="checked" :options="checkOptions" :disabled="false" />
        <bootstrap-toggle v-model="checked2" id="custum2" :disabled="false" />


<!--        <v-select :options="customs" name="hasan" v-model="selected"></v-select>

 :options="{ on: 'ENABLE', off: 'DISABLE',onstyle:'success',offstyle:'danger',width:'50%' }"

-->

        <pre class="code">
            <span v-text="selected"></span>
            <span v-text="selected2"></span>
            <span v-text="selected3"></span>
        </pre>

<!--        <pre class="code">
            <span v-text="selected"></span>
        </pre>-->

    </card>
</template>

<script>
import Select2 from "../../../globals/Select2";
import VSelect from "../../../globals/VSelect";
import BootstrapToggle from 'vue-bootstrap-toggle'
export default {
    name: "TestComponent",
    components:{
        VSelect,Select2,BootstrapToggle
    },
    data(){
        return {
            selected: '',
            selected2: '',
            selected3: '',
            /*customs:[
                {id:1, text: 'Primary'},
                {id:2, text: 'Lower Secondary'},
                {id:3, text: 'Secondary'},
                {id:4, text: 'Higher Secondary'},
                {id:5, text: 'Higher & Graduation'},
                {id:6, text: 'Graduation'},
            ],*/
            customs: [],
            checked: false,
            checked2: true,
            checkOptions:{
                on: 'ENABLEr',
                off: 'DISABLEgg',
                onstyle: 'success',
                offstyle: 'danger',
                width:'50%'
            }
        }
    },
    methods:{
        loadCustoms(){
            axios.get('/api/roles').then(res => {
                //this.customs = data.map(x => ({id:x.id, text: x.name}))
                //this.customs = res.data;
                this.customs = res.data.map(x => ({id: x.id, text: x.name}))
            })
        }
    },
    created() {
        this.loadCustoms()
    }
}
</script>

<style scoped>

</style>
