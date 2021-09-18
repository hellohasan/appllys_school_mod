<template>
    <custom-card
        :title="$t('Admission_details')"
        :url="'/admissions/add'"
        :text="$t('New_admission')"
        :icon="'fas fa-plus'">

        <div id="printMe">
            <div class="form-row">
                <div class="col-md-12">
                    <img :src="padImg" alt="" style="width: 100%">
                    <hr>
                </div>
            </div>

            <template v-if="!loading">

                <div class="form-row">
                    <div class="col-md-9">
                        <div class=form-row>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="name_bn">Session: {{academic.session.duration}}</label>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="name_bn">Academic ID: {{custom}}</label>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="name_en">Date: {{ created_at | myDate }}</label>
                            </div>

                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="name_bn">ছাত্র/ছাত্রীর নাম (বাংলা) </label>
                                <h6>{{ information.name_bn }}</h6>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="name_en">ছাত্র/ছাত্রীর নাম (ইংরেজি অক্ষরে) </label>
                                <h6 class="text-uppercase">{{name}}</h6>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="name_en">NID/Birth Certificate: </label>
                                <h6 class="text-uppercase">{{information.nid}}</h6>
                            </div>
                        </div>

                        <div class=form-row>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="father_bn">পিতার নাম (বাংলা) </label>
                                <h6>{{ father.name_bn }}</h6>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="father_en">পিতার নাম (ইংরেজি অক্ষরে) </label>
                                <h6 class="text-uppercase">{{ father.name }}</h6>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="father_en">পিতার NID </label>
                                <h6 class="text-uppercase">{{ father.nid }}</h6>
                            </div>
                        </div>

                       <div class=form-row>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="mother_bn">মাতার নাম (বাংলা) </label>
                                <h6>{{ mother.name_bn }}</h6>
                            </div>
                            <div class="form-group col-md-4 form-group-mb-0">
                                <label for="mother_en">মাতার নাম (ইংরেজি অক্ষরে) </label>
                                <h6 class="text-uppercase">{{ mother.name }}</h6>
                            </div>
                           <div class="form-group col-md-4 form-group-mb-0">
                                <label for="mother_en">মাতার NID: </label>
                                <h6 class="text-uppercase">{{ mother.nid }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">ছাত্র/ছাত্রীর ছবিঃ </label><br>
                                <img :src="`/`+photo" class="thumbnail" alt="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">অভিভাবকের ছবিঃ </label><br>
                                <img :src="`/`+guardian.image" class="thumbnail" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="one"><span>সাধারণ তথ্যঃ  </span></h6>
                <div class="form-row">
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="dob">জন্ম তারিখঃ {{information.dob}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="lang">NID: {{information.nid}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="nationality">জাতীয়তাঃ {{information.nationality}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="lang">মাতৃভাষাঃ {{information.language}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="gender">লিঙ্গঃ {{information.gender}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="religion">ধর্মঃ {{information.religion.name}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="blood_group">রক্তের গ্রুপঃ {{information.blood}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="blood_group">Phone: {{phone}}</label>
                    </div>
                </div>

                <h6 class="one"><span>স্থায়ী ঠিকানাঃ  </span></h6>
                <div class="form-row">
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="permanent_village">গ্রামঃ {{ address.village}}</label>
                    </div>
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="permanent_post">পোস্ট অফিসঃ {{address.post_office}}</label>
                    </div>
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="permanent_union">ইউনিয়নঃ {{address.union_name}}</label>
                    </div>
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="permanent_subdistrict">উপজেলাঃ {{address.upazila.name}} </label>
                    </div>
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="permanent_district">জেলাঃ {{ address.district.name}}</label>
                    </div>
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="permanent_district">বিভাগঃ {{ address.division.name}}</label>
                    </div>
                </div>

                <h6 class="one"><span>বর্তমান ঠিকানাঃ  </span></h6>
                <template v-if="!address.address_type">
                    <div class="form-row">
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="present_village">গ্রামঃ {{ address.present_village}}</label>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="present_post">পোস্ট অফিসঃ {{address.present_post_office}}</label>
                            <h6></h6>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="present_union">ইউনিয়নঃ {{address.present_union_name}} </label>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="present_subdistrict">উপজেলাঃ {{address.present_upazila.name}} </label>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="present_district">জেলাঃ {{address.present_district.name}}</label>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="present_district">বিভাগঃ {{address.present_division.name}}</label>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="form-row">
                        <div class="form-group col-md-12 form-group-mb-0">
                            <label for="permanent_district">Present and Permanent address is same</label>
                        </div>
                    </div>
                </template>

                <h6 class="one"><span>একাডেমী তথ্যঃ  </span></h6>
                <div class="form-row">
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="data">Session: {{academic.session.duration}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="data">Class: {{academic.class.name}} - ({{academic.class.code}})</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="data">
                            <template v-if="academic.group_department">
                                <template v-if="academic.type == 1">Group:</template>
                                <template v-if="academic.type == 2">Department:</template>
                                {{academic.group_department.name}}
                            </template>
                            <template v-else>
                                Group: N/A
                            </template>
                        </label>
                    </div>

                    <div class="form-group col-md-3 form-group-mb-0">
                        <template v-if="academic.type == 2">
                            <label for="data">Year: {{academic.year.name}}</label>
                        </template>
                        <template v-else>
                            <label for="data">Section: {{academic.section.name}}</label>
                        </template>
                    </div>

                    <template v-if="optional.length">
                        <div class="form-group col-md-12 form-group-mb-0">
                            <label for="data">Optional Subject: {{optional[0].academic_subject.name}}</label>
                        </div>
                    </template>
                </div>
                <template v-if="previous_institute != null">
                    <h6 class="one"><span>পূর্ববর্তী একাডেমী তথ্যঃ  </span></h6>
                    <div class="form-row">
                        <div class="form-group col-md-6 form-group-mb-0">
                            <label for="data">Institute Name: {{previous_institute.old_institute_name}}</label>
                        </div>
                        <div class="form-group col-md-6 form-group-mb-0">
                            <label for="data">Institute Address: {{previous_institute.old_institute_address}}</label>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="data">Class: {{previous_institute.old_institute_class}}</label>
                        </div>
                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="data">Group: {{previous_institute.old_institute_group}}</label>
                        </div>

                        <div class="form-group col-md-4 form-group-mb-0">
                            <label for="data">Roll: {{previous_institute.old_institute_roll}}</label>
                        </div>
                    </div>
                </template>
                <h6 class="one"><span>অভিভাবকের তথ্যঃ  </span></h6>
                <div class="form-row">
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="guardian_name">অভিভাবকের নামঃ {{guardian.name}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="guardian_relation">সম্পর্কঃ {{guardian.relation}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="guardian_occupation">পেশাঃ {{guardian.occupation}}</label>
                    </div>
                    <div class="form-group col-md-3 form-group-mb-0">
                        <label for="guardian_phone">মোবাইল নাম্বারঃ {{guardian.phone}}</label>
                    </div>
                </div>
                <h6 class="one"><span>পারিবারিক তথ্যঃ  </span></h6>
                <div class="form-row">
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="family_earn">মোট উপার্জনরত সদস্য সংখ্যাঃ {{family_info.total_member}} জন</label>
                    </div>

                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="family_member">মোট সদস্য সংখ্যাঃ {{family_info.earnable_member}} জন</label>
                    </div>
                    <div class="form-group col-md-4 form-group-mb-0">
                        <label for="family_earning">বাৎসরিক আয়ঃ {{family_info.yearly_earn}} টাকা</label>
                    </div>
                </div>
                <h6 class="one"><span>সংযুক্তঃ  </span></h6>
                <div class="form-row">

                    <div class="form-group col-md-3 form-group-mb-0" v-for="doc in documents">
                        <label for="birth_certificate">{{doc.type}}: সংযুক্ত</label>
                    </div>
                </div>
                <h6 class="one"><span>অজ্ঞিকারনামাঃ  </span></h6>
                <div class="form-group" style="margin-bottom: 55px;">
                    <label class="form-check-label" for="exampleCheck1">আমি <span class="font-weight-bold text-italic">{{guardian.name}}</span> আমার ছেলে/মেয়ে/অনুগত <strong class="text-italic">{{name}}</strong> কে অদ্য {{academic.session.duration}} ইং শিক্ষাবর্ষের অত্র বিদ্যালয়ের ভর্তি পূর্বক অঙ্গীকার করিতেছি যে, বিদ্যালয়ের আরোপিত সকল শর্তাবলি মানিয়া চলিতে বাধ্য থাকিব। </label>
                </div>

                <div class="row bottom-align-text" style="margin-top: 20px;">
                    <div class="col-md-6">
                        <div class="text-center displayHide">
                            <h6>____________________________</h6>
                            <h6>তারিখসহ অভিভাবকের স্বাক্ষর</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center displayHide">
                            <h6>____________________________</h6>
                            <h6>তারিখসহ ছাত্র/ছাত্রীর স্বাক্ষর</h6>
                        </div>
                    </div>
                </div>

            </template>
        </div>
        <button type="button" v-on:click="print('printMe')">Print me</button>


    </custom-card>
</template>

<script>
export default {
    name: "AdmissionView",
    data(){
        return{
            loading:true,
            name: '',
            custom: '',
            phone: '',
            created_at: '',
            photo: '',
            father: {},
            mother: {},
            guardian: {},
            information: [],
            address: {},
            academic: {},
            previous_institute: {},
            family_info: {},
            documents: {},
            optional: {},
            padImg: process.env.MIX_APP_URL+'img/pad.png'
        }
    },
    methods:{
        print(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        },
        loadAdmissionDetails(){
            axios.get('/api/load-admission-details',{params:{custom:this.$route.params.custom}}).then(({data}) => {
                this.custom = data.custom
                this.name = data.name
                this.phone = data.phone
                this.photo = data.photo
                this.created_at = data.created_at
                this.father = data.father[0]
                this.mother = data.mother[0]
                this.guardian = data.guardian.guardian_information
                this.information = data.information
                this.address = data.address
                this.academic = data.admission.academic
                this.previous_institute = data.previous_institute
                this.family_info = data.family_info
                this.documents = data.documents
                this.optional = data.admission.academic.optional_subject
                this.loading = false
            } )
        }
    },
    created() {
        this.loadAdmissionDetails();
    }
}
</script>

<style scoped>
.form-group-mb-0{
    margin-bottom: 0!important;
}
h6 {
    position: relative;
}
h6.one {
    background: -moz-linear-gradient(#ffffff 0%, #ffffff 49%, #ced4da 50%, #ced4da 51%, #ffffff 52%, #ffffff 100%);
    background: -ms-linear-gradient(#ffffff 0%, #ffffff 49%, #ced4da 50%, #ced4da 51%, #ffffff 52%, #ffffff 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(49%, #ffffff), color-stop(50%, #ced4da), color-stop(51%, #ced4da), color-stop(52%, #ffffff), color-stop(100%, #ffffff));
    background: -webkit-linear-gradient(#ffffff 0%, #ffffff 49%, #ced4da 50%, #ced4da 51%, #ffffff 52%, #ffffff 100%);
    background: -o-linear-gradient(#ffffff 0%, #ffffff 49%, #ced4da 50%, #ced4da 51%, #ffffff 52%, #ffffff 100%);
    background: linear-gradient(#ffffff 0%, #ffffff 49%, #ced4da 50%, #ced4da 51%, #ffffff 52%, #ffffff 100%);
    font-weight: bold;
}
h6.one span {
    background: #fff;
    padding: 0;
    position: relative;
    z-index: 5;
}
@media print {
    #printMe {
        padding: 0 20px !important;
    }
}
</style>
