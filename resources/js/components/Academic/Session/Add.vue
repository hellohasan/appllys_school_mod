<template>
    <form @submit.prevent="addAcademicSession" class="p-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">{{$t('SessionTitle')}}</label>
                    <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" id="title" :placeholder="$t('SessionTitle')" class="form-control">
                    <has-error :form="form" field="title"></has-error>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="code">{{$t('CodeForID')}}</label>
                    <input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" :placeholder="$t('CodeForID')" class="form-control">
                    <has-error :form="form" field="code"></has-error>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_year">{{$t('StartYear')}}</label>
                    <input type="number" v-model="form.start_year" :class="{ 'is-invalid': form.errors.has('start_year') }" id="start_year" :placeholder="$t('StartYear')" class="form-control">
                    <has-error :form="form" field="start_year"></has-error>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_year">{{$t('EndYear')}}</label>
                    <input type="number" v-model="form.end_year" :class="{ 'is-invalid': form.errors.has('end_year') }" id="end_year" :placeholder="$t('EndYear')" class="form-control">
                    <has-error :form="form" field="end_year"></has-error>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="duration">{{$t('Duration')}}</label>
                    <input type="text" readonly :value="durationShown" :class="{ 'is-invalid': form.errors.has('duration') }" id="duration" :placeholder="$t('Duration')" class="form-control">
                    <has-error :form="form" field="duration"></has-error>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="off_day">{{$t('WeeklyOffDay')}}</label>
                    <select2 :options="days" v-model="form.off_day" :placeholder="$t('Select_One')" name="type"></select2>
                    <has-error :form="form" field="off_day"></has-error>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">{{$t('Status')}}</label>
                    <v-toggle v-model="form.status" :options="checkOptions" :disabled="false" :class="{ 'is-invalid': form.errors.has('status') }" id="status"/>
                    <has-error :form="form" field="status"></has-error>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="isCurrent">{{$t('CurrentSession')}}</label>
                    <v-toggle v-model="form.isCurrent" :options="checkOptions2" :disabled="false" :class="{ 'is-invalid': form.errors.has('isCurrent') }" id="isCurrent"/>
                    <has-error :form="form" field="isCurrent"></has-error>
                </div>
            </div>
        </div>
        <hr>

        <div class="row" v-for="(c, i) in form.classes" :key="i">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="c_name">{{$t('ClassName')}}</label>
                    <input type="text" v-model="c.text" readonly :class="{ 'is-invalid': form.errors.has('c_name') }" placeholder="Class Name" class="form-control">
                    <has-error :form="form" field="c_name"></has-error>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="admission_fee">{{$t('AdmissionFee')}}</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" v-model="c.admission_fee" :class="{ 'is-invalid': form.errors.has('admission_fee') }" :placeholder="$t('AdmissionFee')" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">BDT</span>
                        </div>
                    </div>
                    <has-error :form="form" field="admission_fee"></has-error>
                </div>
            </div>
        </div>
        <hr>
        <v-button :loading="form.busy">{{$t('Add New')}}</v-button>
    </form>
</template>

<script>
import Select2 from "../../globals/Select2";
import VToggle from "../../globals/VToggle";
export default {
    name: "Add",
    components: {
        Select2, VToggle
    },
    data() {
        return {
            form: new Form({
                title: '',
                code: '',
                start_year: '',
                end_year: '',
                duration: '',
                off_day: '',
                status: false,
                isCurrent: false,
                classes: [],
            }),
            days: [
                {id: 'Saturday', text: 'Saturday'},
                {id: 'Sunday', text: 'Sunday'},
                {id: 'Monday', text: 'Monday'},
                {id: 'Tuesday', text: 'Tuesday'},
                {id: 'Wednesday', text: 'Wednesday'},
                {id: 'Thursday', text: 'Thursday'},
                {id: 'Friday', text: 'Friday'},
            ],
            checkOptions: {
                on: 'ENABLE',
                off: 'DISABLE',
                onstyle: 'success',
                offstyle: 'danger',
                width: '100%'
            },
            checkOptions2: {
                on: 'ACTIVATED',
                off: 'DEACTIVATED',
                onstyle: 'success',
                offstyle: 'danger',
                width: '100%'
            }
        }
    },
    methods: {
        addAcademicSession() {
            this.form.post('/api/store-academic-sessions')
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('success_message')
                    })
                    this.$router.push('/academic-session')
                })
        },
        loadClassList(){
            axios.get('/api/load-only-class-list').then(({data}) => {
                let list = [];
                $.each(data,function (key,value){
                    list.push({
                        id: value.id,
                        text: value.text,
                        admission_fee: '',
                    })
                })
                this.form.classes = list
            })
        }
    },
    computed: {
        durationShown: function () {
            let duration = this.form.start_year + '-' + this.form.end_year;
            this.form.duration = duration
            return duration
        }
    },
    created(){
        this.loadClassList()
    }
}
</script>

<style scoped>

</style>
