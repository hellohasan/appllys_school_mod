<template>
    <custom-card :title="$t('New_admission')" :url="'/admissions'" :text="$t('Admission_list')">

        <div class="alert alert-danger" role="alert" v-show="Object.keys(this.form.errors.errors).length">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Warring.!</h4>
            <ul class="list-group">
                <li class="list-group-item" v-for="err in this.form.errors.errors">{{err[0]}}</li>
            </ul>
        </div>

        <form-wizard @onComplete="onComplete">
            <tab-content title="Selection" :selected="true">
                <div class="form-group">
                    <label for="session_id">Select Session</label>
                    <custom-select :options="sessions" @change="sessionChange" v-model="form.session_id" :placeholder="$t('Select_One')" name="session_id"></custom-select>
                    <has-error :form="form" field="session_id"></has-error>
                </div>
                <div class="form-group" v-show="classes.length > 0">
                    <label for="academic_class_id">Select Class</label>
                    <custom-select-empty :options="classes" @change="classChange" v-model="form.academic_class_id" :placeholder="$t('Select_One')" name="type"></custom-select-empty>
                    <has-error :form="form" field="academic_class_id"></has-error>
                </div>
                <template v-if="form.type === 0">
                    <div class="form-row">
                        <div class="form-group col-md-12" v-show="sections.length > 0">
                            <label for="academic_section_id">Select Section</label>
                            <custom-select-empty :options="sections" v-model="form.academic_section_id" :placeholder="$t('Select_One')" name="type"></custom-select-empty>
                            <has-error :form="form" field="academic_section_id"></has-error>
                        </div>
                    </div>
                </template>
                <template v-if="form.type === 1">
                    <div class="form-row">
                        <div class="form-group col-md-6" v-show="groups.length > 0">
                            <label for="academic_section_id">Select Group</label>
                            <custom-select-empty :options="groups" @change="groupChange" v-model="form.academic_group_id" :placeholder="$t('Select_One')" name="academic_group_id"></custom-select-empty>
                            <has-error :form="form" field="academic_section_id"></has-error>
                        </div>
                        <div class="form-group col-md-6" v-show="groupsSections.length > 0">
                            <label for="academic_group_section_id">Select Section</label>
                            <custom-select-empty :options="groupsSections" v-model="form.academic_group_section_id" :placeholder="$t('Select_One')" name="academic_group_section_id"></custom-select-empty>
                            <has-error :form="form" field="academic_group_section_id"></has-error>
                        </div>
                    </div>
                </template>
                <template v-if="form.type === 2">
                    <div class="form-row">
                        <div class="form-group col-md-6" v-if="groups.length">
                            <label for="academic_department_id">Select Department</label>
                            <custom-select-empty :options="departments" @change="departmentChange" v-model="form.academic_department_id" :placeholder="$t('Select_One')" name="academic_department_id"></custom-select-empty>
                            <has-error :form="form" field="academic_department_id"></has-error>
                        </div>
                        <div class="form-group col-md-6" v-if="departmentsYears.length">
                            <label for="academic_year_id">Select Year</label>
                            <custom-select-empty :options="departmentsYears" v-model="form.academic_year_id" :placeholder="$t('Select_One')" name="academic_year_id"></custom-select-empty>
                            <has-error :form="form" field="academic_year_id"></has-error>
                        </div>
                    </div>
                </template>

                <div class="form-group" v-show="optionalSubjects.length > 0">
                    <label for="optional_subject_id">Select Optional Subject</label>
                    <custom-select-empty :options="optionalSubjects" v-model="form.optional_subject_id" :placeholder="$t('Select_One')" required name="optional_subject_id"></custom-select-empty>
                    <has-error :form="form" field="optional_subject_id"></has-error>
                </div>

            </tab-content>
            <tab-content title="Personal Info">
                <div class="form-row">
                    <form-group-input :form="form" v-model="form.name" col="col-md-6" name="name" :label="$t('Name (English)')"></form-group-input>
                    <form-group-input :form="form" v-model="form.name_bn" col="col-md-6" name="name_bn" :label="$t('Name (Bengali)')"></form-group-input>
                    <form-group-input :form="form" v-model="form.nid" type="number" col="col-md-4" name="nid" :label="$t('NID')"></form-group-input>
                    <form-group-input col="col-md-4" type="date" :form="form" v-model="form.dob" name="dob" :label="$t('Date of Birth')"></form-group-input>
                    <div class="form-group col-md-4">
                        <label for="language">{{$t('language')}}</label>
                        <select2 :options="languages" v-model="form.language" :placeholder="$t('Select_One')" name="language"></select2>
                        <has-error :form="form" field="language"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nationality">{{$t('nationality')}}</label>
                        <select2 :options="nationality" v-model="form.nationality" :placeholder="$t('Select_One')" name="nationality"></select2>
                        <has-error :form="form" field="nationality"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender">{{$t('Gender')}}</label>
                        <select2 :options="genders" v-model="form.gender" :placeholder="$t('Select_One')" name="gender"></select2>
                        <has-error :form="form" field="gender"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="religion_id">{{$t('Religion')}}</label>
                        <select2 :options="religions" v-model="form.religion_id" :placeholder="$t('Select_One')" name="religion_id"></select2>
                        <has-error :form="form" field="religion_id"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="blood">{{$t('Blood Group')}}</label>
                        <select2 :options="bloods" v-model="form.blood" :placeholder="$t('Select_One')" name="blood"></select2>
                        <has-error :form="form" field="blood"></has-error>
                    </div>
                    <form-group-input :form="form" v-model="form.phone" type="text" col="col-md-4" name="phone" :label="$t('Phone')"></form-group-input>
                    <form-group-input :form="form" v-model="form.email" type="email" col="col-md-4" name="email" :label="$t('Email')"></form-group-input>
                </div>
                <h6 class="one"><span>{{$t('Permanent Address')}}&nbsp;</span></h6>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="division_id">{{ $t('Division') }}</label>
                        <custom-select :options="divisions" @change="divisionChange" v-model="form.division_id" :placeholder="$t('Select_One')" name="type"></custom-select>
                        <has-error :form="form" field="division_id"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="district_id">{{ $t('District') }}</label>
                        <custom-select-empty :options="districts" @change="districtChange" v-model="form.district_id" :placeholder="$t('Select_One')" name="type"></custom-select-empty>
                        <has-error :form="form" field="district_id"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="upazila_id">{{ $t('Upazila') }}</label>
                        <custom-select-empty :options="upazilas" v-model="form.upazila_id" :placeholder="$t('Select_One')" name="type"></custom-select-empty>
                        <has-error :form="form" field="upazila"></has-error>
                    </div>
                    <form-group-input col="col-md-4" :form="form" v-model="form.union_name" name="union_name" :label="$t('Union_txt')"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.post_office" name="post_office" :label="$t('Post Office')"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.village" name="village" :label="$t('Village')"></form-group-input>
                </div>
                <h6 class="one"><span>{{$t('Present Address')}}&nbsp;</span></h6>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="address_type">{{ $t('Check_in_msg') }}</label>
                        <custom-select :options="guardian_types" v-model="form.address_type" :placeholder="$t('Select_One')" name="address_type"></custom-select>
                        <has-error :form="form" field="address_type"></has-error>
                    </div>
                </div>

                <template v-if="form.address_type == '0'">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="present_division_id">{{ $t('Division') }}</label>
                            <custom-select :options="divisionsP" @change="divisionChangeP" v-model="form.present_division_id" :placeholder="$t('Select_One')" name="present_division_id"></custom-select>
                            <has-error :form="form" field="present_division_id"></has-error>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="present_district_id">{{ $t('District') }}</label>
                            <custom-select-empty :options="districtsP" @change="districtChangeP" v-model="form.present_district_id" :placeholder="$t('Select_One')" name="present_district_id"></custom-select-empty>
                            <has-error :form="form" field="present_district_id"></has-error>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="present_upazila_id">{{ $t('Upazila') }}</label>
                            <custom-select-empty :options="upazilasP" v-model="form.present_upazila_id" :placeholder="$t('Select_One')" name="present_upazila_id"></custom-select-empty>
                            <has-error :form="form" field="present_upazila_id"></has-error>
                        </div>
                        <form-group-input col="col-md-4" :form="form" v-model="form.present_union_name" name="present_union_name" :label="$t('Union_txt')"></form-group-input>
                        <form-group-input col="col-md-4" :form="form" v-model="form.present_post_office" name="present_post_office" :label="$t('Post Office')"></form-group-input>
                        <form-group-input col="col-md-4" :form="form" v-model="form.present_village" name="present_village" :label="$t('Village')"></form-group-input>
                    </div>
                </template>
            </tab-content>
            <tab-content title="Parent Info">
                <h6 class="one"><span>Father Information&nbsp;</span></h6>
                <div class="form-row">
                    <form-group-input col="col-md-4" :form="form" v-model="form.father_name" name="father_name" label="Father name"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.father_name_bn" name="father_name_bn" label="Father name (Bangla)"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.father_nid" name="father_nid" label="Father NID"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.father_occupation" name="father_occupation" label="Father Occupation"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.father_phone" name="father_phone" label="Father Phone"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.father_email" name="father_email" label="Father Email"></form-group-input>
                </div>

                <h6 class="one"><span>Mother Information&nbsp;</span></h6>
                <div class="form-row">
                    <form-group-input col="col-md-4" :form="form" v-model="form.mother_name" name="mother_name" label="Mother name"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.mother_name_bn" name="mother_name_bn" label="Mother name (Bangla)"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.mother_nid" name="mother_nid" label="Mother NID"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.mother_occupation" name="mother_occupation" label="Mother Occupation"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.mother_phone" name="mother_phone" label="Mother Phone"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.mother_email" name="mother_email" label="Mother Email"></form-group-input>
                </div>
                <h6 class="one"><span>Guardian Information&nbsp;</span></h6>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="guardian_type">{{ $t('sibling_msg') }}</label>
                        <custom-select :options="guardian_types" @change="changeGuardianType" v-model="form.guardian_type" :placeholder="$t('Select_One')" name="guardian_type"></custom-select>
                        <has-error :form="form" field="guardian_type"></has-error>
                    </div>
                </div>

                <template v-if="form.guardian_type === '1'">
                    <form-group-select :options="guardians" label="Select Guardian" id="guardian_id" v-model="form.guardian_id" :form="form"></form-group-select>
                </template>
                <template v-if="form.guardian_type === '0'">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="guardian_choice">{{ $t('guardian_msg') }}</label>
                            <custom-select :options="guardian_choices" v-model="form.guardian_choice" :placeholder="$t('Select_One')" name="guardian_choice"></custom-select>
                            <has-error :form="form" field="guardian_choice"></has-error>
                        </div>
                    </div>
                    <template v-if="form.guardian_choice === '2'">
                        <div class="form-row">
                            <form-group-input col="col-md-4" :form="form" v-model="form.guardian_name" name="guardian_name" label="Guardian name"></form-group-input>
                            <form-group-input col="col-md-4" :form="form" v-model="form.guardian_name_bn" name="guardian_name_bn" label="Guardian name (Bangla)"></form-group-input>
                            <form-group-input col="col-md-4" :form="form" v-model="form.guardian_nid" name="guardian_nid" label="Guardian NID"></form-group-input>
                            <form-group-input col="col-md-3" :form="form" v-model="form.guardian_relation" name="guardian_relation" label="Guardian Relation"></form-group-input>
                            <form-group-input col="col-md-3" :form="form" v-model="form.guardian_occupation" name="guardian_occupation" label="Guardian Occupation"></form-group-input>
                            <form-group-input col="col-md-3" :form="form" v-model="form.guardian_phone" name="guardian_phone" label="Guardian Phone"></form-group-input>
                            <form-group-input col="col-md-3" :form="form" v-model="form.guardian_email" name="guardian_email" label="Guardian Email"></form-group-input>
                        </div>
                    </template>
                </template>

                <h6 class="one"><span>Family Information&nbsp;</span></h6>
                <div class="form-row">
                    <form-group-input col="col-md-4" :form="form" v-model="form.family_total_member" name="family_total_member" type="number" label="Total member"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.family_earnable" name="family_earnable" type="number" label="Total Earnable member"></form-group-input>
                    <form-group-input col="col-md-4" :form="form" v-model="form.yearly_earn" type="number" name="yearly_earn" label="Yearly Earn"></form-group-input>
                </div>

            </tab-content>
            <tab-content title="Photo & Documents">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="image">Student Picture: </label>
                        <v-image v-model="form.image" :custom="`Choice Image`" size="52" width="120px" height="150px" input-name="image" :class="{ 'is-invalid': form.errors.has('image') }"></v-image>
                        <has-error :form="form" field="image"></has-error>
                        <span class="text-red">Image size 50kb | Scale: 120X150 px</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="father_image">Father Image: </label>
                        <v-image v-model="form.father_image" :custom="`Choice Image`" size="52" width="120px" height="150px" input-name="father_image" :class="{ 'is-invalid': form.errors.has('father_image') }"></v-image>
                        <has-error :form="form" field="father_image"></has-error>
                        <span class="text-red">Image size 50kb | Scale: 120X150 px</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="mother_image">Mother Image: </label>
                        <v-image v-model="form.mother_image" :custom="`Choice Image`" size="52" width="120px" height="150px" input-name="mother_image" :class="{ 'is-invalid': form.errors.has('mother_image') }"></v-image>
                        <has-error :form="form" field="mother_image"></has-error>
                        <span class="text-red">Image size 50kb | Scale: 120X150 px</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="guardian_image">Guardian Image: </label>
                        <v-image v-model="form.guardian_image" :custom="`Choice Image`" size="52" width="120px" height="150px" input-name="guardian_image" :class="{ 'is-invalid': form.errors.has('guardian_image') }"></v-image>
                        <has-error :form="form" field="guardian_image"></has-error>
                        <span class="text-red">Image size 50kb | Scale: 120X150 px</span>
                    </div>
                </div><hr>
                <div class="form-row">
                    <custom-image col="col-md-3" size="2048" v-model="form.student_nid_image" :form="form" name="student_nid_image" label="Student NID/Birth Certificate" msg="Maximum Image size 2MB"></custom-image>
                    <custom-image col="col-md-3" size="2048" v-model="form.father_nid_image" :form="form" name="father_nid_image" label="Father NID" msg="Maximum Image size 2MB"></custom-image>
                    <custom-image col="col-md-3" size="2048" v-model="form.mother_nid_image" :form="form" name="mother_nid_image" label="Mother NID" msg="Maximum Image size 2MB"></custom-image>
                    <custom-image col="col-md-3" size="2048" v-model="form.guardian_nid_image" :form="form" name="guardian_nid_image" label="Guardian NID" msg="Maximum Image size 2MB"></custom-image>
                </div><hr>
                <div class="form-row">
                    <div class="d-flex justify-content-between border-bottom col-md-12">
                        <h5>Attach requirement documents here</h5>
                        <button type="button" class="btn btn-success btn-sm" @click="addNewDocument">
                            <i class="fas fa-plus"></i> Add More Document
                        </button>
                    </div>
                </div>
                <template v-for="(doc,index) in form.documents">
                    <div class="form-row group-markup">
                        <div class="form-group col-md-6">
                            <label for="type_id">Document Type</label>
                            <custom-select :options="documents_types" v-model="doc.type" :placeholder="$t('Select_One')" name="guardian_choice"></custom-select>
                            <has-error :form="form" field="type"></has-error>
                        </div>
                        <custom-image col="col-md-6" v-model="doc.file" size="2048" :form="form" name="file" label="Select Document - Maximum Image size 2MB"></custom-image>
                        <button type="button" @click="deleteNewDocument(index)" class="btn btn-danger btn-sm delete_group cursor-pointer" v-tooltip="'Remove Document'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </template>
            </tab-content>
            <tab-content title="Previous Academic">
                <div class="form-row">
                    <form-group-select col="col-md-12" :form="form" :options="guardian_types" v-model="form.previous_academic" :placeholder="$t('Select_One')" label="Have any previous institute?" id="previous_academic"></form-group-select>
                </div>
                <template v-if="form.previous_academic === '1'">
                    <div class="form-row">
                        <form-group-input col="col-md-6" :form="form" v-model="form.old_institute_name" name="old_institute_name" label="Previous Institute Name"></form-group-input>
                        <form-group-input col="col-md-6" :form="form" v-model="form.old_institute_address" name="old_institute_address" label="Previous Institute Address"></form-group-input>
                        <form-group-input col="col-md-4" :form="form" v-model="form.old_institute_class" name="old_institute_class" label="Previous Class"></form-group-input>
                        <form-group-input col="col-md-4" :form="form" v-model="form.old_institute_roll" type="number" name="old_institute_roll" label="Previous Roll"></form-group-input>
                        <form-group-input col="col-md-4" :form="form" v-model="form.old_institute_group" name="old_institute_group" label="Previous Group"></form-group-input>
                    </div>
                </template>
            </tab-content>
            <tab-content title="Payment">
                <h4>Admission Fee: {{admission_fee}}</h4>
                <div class="form-row">
                    <form-group-input col="col-md-12" type="number" :form="form" v-model="form.admission_fee" name="admission_fee" label="Admission Fee"></form-group-input>
                </div>
            </tab-content>
            <tab-content title="Submission">
                <div class="form-row" id="printMe">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td colspan="4" class="text-center">Selection Information</td>
                        </tr>
                        <tr>
                            <td>Session</td>
                            <td>{{formShow.session_name}}</td>
                            <td>Class</td>
                            <td>{{formShow.academic_class_name}}</td>
                        </tr>
                        <template v-if="form.type == '1'">
                            <tr>
                                <td>Group</td>
                                <td>{{formShow.academic_group_name}}</td>
                                <td>Section</td>
                                <td>{{formShow.academic_group_section_name}}</td>
                            </tr>
                        </template>
                        <template v-if="form.type == '2'">
                            <tr>
                                <td>Department</td>
                                <td>{{formShow.academic_department_name}}</td>
                                <td>Year</td>
                                <td>{{formShow.academic_year_name}}</td>
                            </tr>
                        </template>
                        <template v-show="formShow.optional_subject_name">
                            <tr>
                                <td>Optional Subject</td>
                                <td colspan="3">{{formShow.optional_subject_name}}</td>
                            </tr>
                        </template>
                        <tr>
                            <td colspan="4" class="text-center">Student Information</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{form.name}}</td>
                            <td>Name (Bengali)</td>
                            <td>{{form.name_bn}}</td>
                        </tr>
                        <tr>
                            <td>NID</td>
                            <td>{{form.nid}}</td>
                            <td>Date of Birth</td>
                            <td>{{form.dob}}</td>
                        </tr>
                        <tr>
                            <td>Blood Group</td>
                            <td>{{form.blood}}</td>
                            <td>Nationality</td>
                            <td>{{form.nationality}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{form.gender}}</td>
                            <td>Religious</td>
                            <td>{{formShow.religion_name}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{form.phone}}</td>
                            <td>Email</td>
                            <td>{{form.email}}</td>
                        </tr>


                        <template v-if="form.guardian_type === '0'">
                        <tr>
                            <td>Father Name</td>
                            <td>{{form.father_name}}</td>
                            <td>Father Name (BN)</td>
                            <td>{{form.father_name_bn}}</td>
                        </tr>
                        <tr>
                            <td>Father NID</td>
                            <td>{{form.father_nid}}</td>
                            <td>Father Occupation</td>
                            <td>{{form.father_occupation}}</td>
                        </tr>
                        <tr>
                            <td>Father Phone</td>
                            <td>{{form.father_phone}}</td>
                            <td>Father Email</td>
                            <td>{{form.father_email}}</td>
                        </tr>
                        <tr>
                            <td>Mother Name</td>
                            <td>{{ form.mother_name }}</td>
                            <td>Mother Name (BN)</td>
                            <td>{{ form.mother_name_bn }}</td>
                        </tr>
                        <tr>
                            <td>Mother NID</td>
                            <td>{{ form.mother_nid }}</td>
                            <td>Mother Occupation</td>
                            <td>{{ form.mother_occupation }}</td>
                        </tr>
                        <tr>
                            <td>Mother Phone</td>
                            <td>{{ form.mother_phone }}</td>
                            <td>Mother Email</td>
                            <td>{{ form.mother_email }}</td>
                        </tr>
                        </template>

                        <template v-if="form.guardian_type === '1'">
                            <tr>
                                <td colspan="4">show from database</td>
                            </tr>
                        </template>

                        <tr>
                            <td colspan="4" class="text-center">Permanent Address</td>
                        </tr>
                        <tr>
                            <td>Division</td>
                            <td>{{formShow.division_name}}</td>
                            <td>District</td>
                            <td>{{ formShow.district_name }}</td>
                        </tr>
                        <tr>
                            <td>Upazila</td>
                            <td>{{formShow.upazila_name}}</td>
                            <td>Union/Pourosova</td>
                            <td>{{form.union_name}}</td>
                        </tr>
                        <tr>
                            <td>Post Office</td>
                            <td>{{form.post_office}}</td>
                            <td>Village/House</td>
                            <td>{{form.village}}</td>
                        </tr>

                        <tr><td colspan="4" class="text-center">Present Address</td></tr>
                        <template v-if="form.address_type">
                            <tr>
                                <td colspan="4" class="text-center">Permanent & Present Address is same</td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td>Division</td>
                                <td>{{formShow.present_division_name}}</td>
                                <td>District</td>
                                <td>{{ formShow.present_district_name }}</td>
                            </tr>
                            <tr>
                                <td>Upazila</td>
                                <td>{{formShow.present_upazila_name}}</td>
                                <td>Union/Pourosova</td>
                                <td>{{form.present_union_name}}</td>
                            </tr>
                            <tr>
                                <td>Post Office</td>
                                <td>{{form.present_post_office}}</td>
                                <td>Village/House</td>
                                <td>{{form.present_village}}</td>
                            </tr>
                        </template>
                        <tr>
                            <td colspan="4" class="text-center">Previous Institute</td>
                        </tr>
                        <tr>
                            <td>Institute Name</td>
                            <td>{{form.old_institute_name}}</td>
                            <td>Class</td>
                            <td>{{form.old_institute_class}}</td>
                        </tr>
                        <tr>
                            <td>Roll</td>
                            <td>{{form.old_institute_roll}}</td>
                            <td>Group</td>
                            <td>{{form.old_institute_group}}</td>
                        </tr>
                    </table>

                    <div class="form-group col-md-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" v-model="form.checkUp" id="exampleCheck2">
                            <label class="form-check-label font-weight-bold" for="exampleCheck2">Check out, If all fields are filled up correctly.</label>
                        </div>
                    </div>
                </div>
                <button type="button" @click="print">Print me</button>
            </tab-content>
        </form-wizard>

    </custom-card>
</template>

<script>
import {FormWizard, TabContent} from 'vue-step-wizard'
import 'vue-step-wizard/dist/vue-step-wizard.css'
import Select2 from "../../globals/Select2";
import CustomSelect from "../../globals/CustomSelect";
import CustomSelectEmpty from "../../globals/CustomSelectEmpty";
import CustomImage from "../../globals/CustomImage";

export default {
    name: "Add",
    components: {
        FormWizard, TabContent, Select2, CustomSelect, CustomSelectEmpty,CustomImage
    },
    data() {
        return {
            form: new Form({
                session_id: '',
                academic_class_id: '',
                type:'',
                academic_section_id: '',
                academic_group_id: '',
                academic_group_section_id: '',
                academic_department_id: '',
                academic_year_id: '',
                optional_subject_id: '',
                name:'',
                name_bn:'',
                nid:'',
                dob:'',
                language:'',
                nationality:'',
                gender:'',
                religion_id:'',
                blood:'',
                phone:'',
                email:'',
                division_id: '',
                district_id: '',
                upazila_id: '',
                union_name: '',
                post_office: '',
                village: '',
                address_type: '',
                present_division_name: '',
                present_district_name: '',
                present_upazila_name: '',
                present_union_name: '',
                present_post_office: '',
                present_village: '',
                guardian_type: '',

                guardian_id: '',
                father_name: '',
                father_name_bn: '',
                father_nid: '',
                father_occupation: '',
                father_phone: '',
                father_email: '',
                mother_name: '',
                mother_nid: '',
                mother_occupation: '',
                mother_phone: '',
                mother_email: '',
                guardian_choice: '',
                guardian_name:'',
                guardian_name_bn:'',
                guardian_nid:'',
                guardian_relation:'',
                guardian_occupation:'',
                guardian_phone:'',
                guardian_email:'',
                family_total_member:'',
                family_earnable:'',
                yearly_earn:'',
                image: '',
                guardian_image: '',
                father_image: '',
                mother_image: '',
                student_nid_image:'',
                father_nid_image:'',
                mother_nid_image:'',
                guardian_nid_image:'',
                documents: [],
                previous_academic:'',
                old_institute_name:'',
                old_institute_address:'',
                old_institute_class:'',
                old_institute_roll:'',
                old_institute_group:'',
                admission_fee:'',
                checkUp:'',
            }),

            formShow: {
                session_name: '',
                academic_class_name: '',
                academic_section_name: '',
                academic_group_name: '',
                academic_group_section_name: '',
                academic_department_name: '',
                academic_year_name: '',
                optional_subject_name: '',
                religion_name:'',
                division_name: '',
                district_nam: '',
                upazila_name:'',
                present_division_name: '',
                present_district_name: '',
                present_upazila_name: '',
            },
            sessions: [],
            classes: {},
            admission_fee:'',
            type: '',
            sections: {},
            groups: {},
            optionalSubjects: {},
            groupsSections: {},
            departments: {},
            departmentsYears: {},
            languages: ['Bengali'],
            nationality: ['Bangladeshi'],
            religions: {},
            bloods: [],
            genders: ["Male", "Female", "Others"],
            divisions: {},
            districts: {},
            upazilas: {},
            divisionsP: {},
            districtsP: {},
            upazilasP: {},
            guardian_types: [
                {id: 1, text: this.$i18n.t('Yes')},
                {id: 0, text: this.$i18n.t('No')}
            ],
            guardians:{},
            guardian_choices: [
                {id: 0, text: this.$i18n.t('Father')},
                {id: 1, text: this.$i18n.t('Mother')},
                {id: 2, text: this.$i18n.t('Other')},
            ],
            documents_types: [
                {id: 'Testimonial', text: this.$i18n.t('Testimonial')},
                {id: 'Mark Sheet', text: this.$i18n.t('Mark Sheet')},
                {id: 'Certificate', text: this.$i18n.t('Certificate')},
                {id: 'Others', text: this.$i18n.t('Others')},
            ]
        }
    },
    watch: {
        'form.session_id': function (val) {
            this.formShow.session_name = this.sessions.find(list => list.id == val).text
        },
        'form.academic_class_id': function (val) {
            this.formShow.academic_class_name = this.classes.find(list => list.id == val).text
        },
        'form.academic_section_id': function (val) {
            this.formShow.academic_section_name = this.sessions.find(list => list.id == val).text
        },
        'form.academic_group_id': function (val) {
            this.formShow.academic_group_name = this.groups.find(list => list.id == val).text
        },
        'form.academic_group_section_id': function (val) {
            this.formShow.academic_group_section_name = this.groupsSections.find(list => list.id == val).text
        },
        'form.academic_department_id': function (val) {
            this.formShow.academic_department_name = this.departments.find(list => list.id == val).text
        },
        'form.academic_year_id': function (val) {
            this.formShow.academic_year_name = this.departmentsYears.find(list => list.id == val).text
        },
        'form.optional_subject_id': function (val) {
            this.formShow.optional_subject_name = this.optionalSubjects.find(list => list.id == val).text
        },
        'form.religion_is': function (val) {
            this.formShow.religion_name = this.religions.find(list => list.id == val).text
        },
        'form.division_id': function (val) {
            this.formShow.division_name = this.divisions.find(list => list.id == val).text
        },
        'form.district_id': function (val) {
            this.formShow.district_name = this.districts.find(list => list.id == val).text
        },
        'form.upazila_id': function (val) {
            this.formShow.upazila_name = this.upazilas.find(list => list.id == val).text
        },
        'form.present_division_id': function (val) {
            this.formShow.present_division_name = this.divisions.find(list => list.id == val).text
        },
        'form.present_district_id': function (val) {
            this.formShow.present_district_name = this.districts.find(list => list.id == val).text
        },
        'form.present_upazila_id': function (val) {
            this.formShow.present_upazila_name = this.upazilas.find(list => list.id == val).text
        },
    },
    methods: {

        print () {
            // Pass the element id here
            this.$htmlToPaper('printMe');
        },
        onComplete() {
            alert('yes lets submit');
            this.form.post('/api/submit-admission-form')
                    .then((res) => {
                        this.$router.push(`/admissions/view/${res.data}`)
                    })
        },
        sessionChange: function (e) {
            axios.get('/api/load-class-with-session/' + e).then(({data}) => {
                this.classes = data.academic_classes
            })
        },
        classChange: function (e) {
            axios.get('/api/load-class-section-group-department', {
                params: {
                    id: e,
                    session_id:this.form.session_id
                }}).then(({data}) => {

                this.form.type = data.class.type
                this.admission_fee = data.fee
                this.optionalSubjects = {}

                if (data.class.type === 1) {
                    this.groups = data.class.academic_groups
                } else if (data.class.type === 2) {
                    this.departments = data.class.academic_departments
                } else {
                    this.sections = data.class.sections
                }
            })
        },
        addNewDocument(){
            this.form.documents.push({
                type: '',
                file: '',
            })
        },
        deleteNewDocument(i){
            this.form.documents.splice(i, 1)
        },
        groupChange: function (e) {
            axios.get('/api/load-group-section', {params: {id: e,classId:this.form.academic_class_id}}).then((res) => {
                this.groupsSections = res.data.groups.sections
                this.optionalSubjects = res.data.optionals
            });
        },
        departmentChange: function (e) {
            axios.get('/api/load-department-years', {params: {id: e}}).then((res) => {
                this.departmentsYears = res.data.sections
            });
        },
        loadOnlySessionList() {
            axios.get('/api/load-only-session-list').then(({data}) => this.sessions = data)
        },
        loadReligionList() {
            axios.get('/api/load-religion-list').then((res) => this.religions = res.data);
        },
        loadBloodList() {
            axios.get('/api/load-blood-list').then((res) => this.bloods = res.data);
        },
        divisionChange: function (e) {
            axios.get('/api/load-districts', {params: {id: e}}).then((res) => {
                this.districts = res.data
            })
        },
        districtChange: function (e) {
            axios.get('/api/load-upazilas', {params: {id: e}}).then((res) => {
                this.upazilas = res.data
            })
        },
        divisionChangeP: function (e) {
            axios.get('/api/load-districts', {params: {id: e}}).then((res) => {
                this.districtsP = res.data
            })
        },
        districtChangeP: function (e) {
            axios.get('/api/load-upazilas', {params: {id: e}}).then((res) => {
                this.upazilasP = res.data
            })
        },
        loadDivision() {
            axios.get('/api/load-divisions').then((res) => {
                this.divisions = res.data
                this.divisionsP = res.data
            })
        },
        changeGuardianType(e){
            if (e){
                axios.get('/api/load-guardians').then((res) => {
                    this.guardians = res.data
                })
            }
        }
    },
    created() {
        this.loadOnlySessionList()
        this.loadReligionList()
        this.loadBloodList()
        this.loadDivision()
    }
}
</script>

<style scoped>
.vue-step-wizard {
    width: 100% !important;
    padding: 10px !important;
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
.group-markup {
    border: 1px solid #ddd;
    padding: 10px 0 0 0;
    border-radius: 5px 5px 0 5px;
    margin: 0;
    position: relative;
}

.delete_group {
    position: absolute;
    right: 0;
    top: 0;
}
</style>
