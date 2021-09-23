<template>
    <custom-card
        :title="$t('NewReceive')"
        :url="'/bill-receive'"
        :text="$t('ReceiveList')"
    >
        <form @submit.prevent="assignSubmit">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="academic_class_id">{{ $t("Academic_Class") }}</label>
                                <custom-select @change="classChange" :options="classes" v-model="form.academic_class_id" :placeholder="$t('Select_One')"></custom-select>
                                <has-error :form="form" field="academic_class_id"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <template v-if="this.form.academic_class_type === 0">
                                <div class="form-group">
                                    <label for="academic_section_id">{{$t("Group_section") }}</label>
                                    <custom-select-empty :options="sections" @change="changeSection" v-model="form.academic_section_id" :placeholder="$t('Select_One')"></custom-select-empty>
                                    <has-error :form="form" field="academic_section_id"></has-error>
                                </div>
                            </template>
                            <template v-if="this.form.academic_class_type === 1">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="academic_group_id">{{$t("Academic_Group") }}</label>
                                        <custom-select :options="groups" @change="changeGroup" v-model="form.academic_group_id" :placeholder="$t('Select_One')"></custom-select>
                                        <has-error :form="form" field="academic_group_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="academic_section_id">{{$t("Group_section") }}</label>
                                        <custom-select-empty :options="sections" @change="changeSection" v-model="form.academic_section_id" :placeholder="$t('Select_One')"></custom-select-empty>
                                        <has-error :form="form" field="academic_section_id"></has-error>
                                    </div>
                                </div>
                            </template>
                            <template v-if="this.form.academic_class_type === 2">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="academic_department_id">{{$t("Academic_Department") }}</label>
                                        <custom-select @change="changeDepartment" :options="departments" v-model="form.academic_department_id" :placeholder="$t('Select_One')"></custom-select>
                                        <has-error :form="form" field="academic_department_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="academic_year_id">{{$t("Department_year") }}</label>
                                        <custom-select-empty :options="years" @change="changeYear" v-model="form.academic_year_id" :placeholder="$t('Select_One')"></custom-select-empty>
                                        <has-error :form="form" field="academic_year_id"></has-error>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="student_id">{{$t("SelectStudent") }}</label>
                                <custom-select-empty :options="students" @change="selectStudent" v-model="form.student_id" :placeholder="$t('Select_One')"></custom-select-empty>
                                <has-error :form="form" field="student_id"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="custom">Student ID</label>
                        <textarea v-model="form.custom" :class="{ 'is-invalid': form.errors.has('custom') }" rows="1" id="custom" placeholder="Student ID" class="form-control"></textarea>
                        <has-error :form="form" field="custom"></has-error>
                    </div>
                </div>
                <div class="col-md-12" v-if="student !== ''">
                    <hr/>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 offset-md-3 offset-lg-3">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="text-center">
                                    {{ student.student_data.name }}
                                </h3>
                            </div>
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 text-center">
                                        <img alt="User Pic" :src="student.student_data.photo" class="img-bordered img-responsive"/><br/>
                                        <img alt="User Pic" :src="student.guardian_data.guardian_image" class="img-bordered img-responsive"/>
                                    </div>
                                    <div class="col-md-9 col-lg-9">
                                        <table class="table table-user-information table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>{{ $t("AcademicID") }}</td>
                                                <td>{{student.academic_data.academic_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{$t("Academic_Class") }}:</td>
                                                <td>{{student.academic_data.class }}</td>
                                            </tr>

                                            <template v-if="type == 1">
                                                <tr>
                                                    <td>{{$t("Academic_Group") }}</td>
                                                    <td>{{student.academic_data.group }}</td>
                                                </tr>
                                            </template>

                                            <template v-if="type == 1 || type == 0">
                                                <tr>
                                                    <td>{{$t("Group_section") }}</td>
                                                    <td>{{student.academic_data.section }}</td>
                                                </tr>
                                            </template>

                                            <template v-if="type == 2">
                                                <tr>
                                                    <td>{{$t("Academic_Department") }}</td>
                                                    <td>{{student.academic_data.department }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{$t("Department_year") }}</td>
                                                    <td>{{student.academic_data.year }}</td>
                                                </tr>
                                            </template>
                                            <tr>
                                                <td>{{ $t("FatherName") }} - {{ $t("Phone") }}</td>
                                                <td>{{student.guardian_data.father_name }} - {{student.guardian_data.father_phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $t("MotherName") }} - {{ $t("Phone") }}</td>
                                                <td>{{student.guardian_data.mother_name }} - {{student.guardian_data.mother_phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{$t("GuardianName") }} - {{ $t("Phone") }}</td>
                                                <td>{{student.guardian_data.guardian_name }} - {{student.guardian_data.guardian_phone }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-user-information table-striped table-bordered">
                                            <tbody>
                                            <tr class="bg-indigo">
                                                <td>
                                                    {{ $t("TotalBill") }}: {{student.bills.total_bill| items }}
                                                </td>
                                                <td>
                                                    {{ $t("PaidBill") }}: {{student.bills.complete_bill| items }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary">
                                                    {{ $t("TotalDemand") }}: {{student.bills.total_demand| withCurrency }}
                                                </td>
                                                <td class="bg-success">
                                                    {{ $t("TotalPaid") }}: {{student.bills.total_paid| withCurrency }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-danger">
                                                    {{ $t("TotalFine") }}: {{student.bills.total_fine| withCurrency }}
                                                </td>
                                                <td class="bg-green">
                                                    {{$t("TotalDiscount") }}: {{student.bills.total_discount| withCurrency }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-info">
                                                    {{ $t("LastPay") }}: {{student.bills.last_paid_at| myDate }}
                                                </td>
                                                <td class="bg-warning">
                                                    {{ $t("StillDue") }}: {{student.bills.total_due| withCurrency }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" v-if="bills !== ''">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ $t("SL") }}</th>
                                <th>{{ $t("Custom") }}</th>
                                <th>{{ $t("AssignedAt") }}</th>
                                <th>{{ $t("Total") }}</th>
                                <th>{{ $t("Fine") }} (+)</th>
                                <th>{{ $t("Waiver") }} (-)</th>
                                <th>{{ $t("GrandTotal") }}</th>
                                <th>{{ $t("Paid") }}</th>
                                <th>{{ $t("Due") }}/{{ $t("Status") }}/{{$t("Date") }}</th>
                                <th>{{ $t("Action") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(bill, index) in bills" :key="index">
                                <td>{{ ++index }}</td>
                                <td>{{ bill.package.custom }}</td>
                                <td>{{ bill.created_at | myDate }}</td>
                                <td>{{ bill.total | withCurrency }}</td>
                                <td>{{ bill.fine | withCurrency }}</td>
                                <td>{{ bill.waiver | withCurrency }}</td>
                                <td>
                                    {{(bill.total + bill.fine - bill.waiver)| withCurrency }}
                                </td>
                                <td>{{ bill.pay | withCurrency }}</td>
                                <td>
                                    <template v-if="bill.isPaid">
                                        <span class="badge badge-success">Paid</span>{{ bill.updated_at | date }}
                                    </template>
                                    <template v-else>
                                        {{ bill.due | withCurrency }}
                                    </template>
                                </td>
                                <td>
                                    <template v-if="bill.isPaid">
                                        <button class="btn btn-success btn-sm" @click.prevent="printReceipt(bill.id)">Print</button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-success btn-sm" @click="receiveNow(bill)">Receive Now</button>
                                    </template>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">{{ $t("ReceiveNewPayment") }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--                        <img :src="'/img/pad.png'" alt="" style="width: 100%;margin: 0 auto">-->
                        <table class="table table-bordered table-secondary">
                            <thead>
                            <tr>
                                <th class="text-right" width="50%">{{ $t("Details") }}</th>
                                <th class="text-left">{{ $t("amount") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(b, rr) in receiveItems" :key="rr">
                                <td class="text-right">{{ b.text }}</td>
                                <td class="text-left">{{ b.amount | withCurrency }}</td>
                            </tr>
                            <tr class="bg-secondary white">
                                <td class="text-right">{{ $t("Total") }}</td>
                                <td class="text-left">{{ billForm.itemTotal | withCurrency }}</td>
                            </tr>
                            <tr class="bg-secondary white">
                                <td class="text-right">{{ $t("Fine") }} (+)</td>
                                <td class="text-left">
                                    <input type="number" step="0.001" v-model="billForm.fine" :readonly="billForm.isAttempt == true" :class="{'is-invalid': billForm.errors.has('fine')}" id="fine" placeholder="জরিমানা" class="form-control"/>
                                    <has-error :form="billForm" field="fine"></has-error>
                                </td>
                            </tr>
                            <tr class="bg-secondary white">
                                <td class="text-right">{{ $t("Waiver") }} (-)</td>
                                <td class="text-left">
                                    <input type="number" step="0.001" v-model="billForm.waiver" :readonly="billForm.isAttempt == true" :class="{'is-invalid': billForm.errors.has('waiver')}" id="waiver" placeholder="waiver" class="form-control"/>
                                    <has-error :form="billForm" field="waiver"></has-error>
                                </td>
                            </tr>
                            <tr class="bg-secondary white">
                                <td class="text-right">{{ $t("GrandTotal") }}</td>
                                <td class="text-left">{{ billForm.total | withCurrency }}</td>
                            </tr>
                            <tr class="bg-secondary white" v-if="billForm.isAttempt == true">
                                <td class="text-right">{{ $t("PreviousPay") }}</td>
                                <td class="text-left">{{ billForm.oldPay | withCurrency }}</td>
                            </tr>
                            <tr class="bg-success white">
                                <td class="text-right">{{ $t("PayNow") }}</td>
                                <td class="text-left">
                                    <input type="number" step="0.001" v-model="billForm.pay" :class="{'is-invalid': billForm.errors.has('pay')}" id="pay" placeholder="Pay Now" class="form-control"/>
                                    <has-error :form="billForm" field="pay"></has-error>
                                </td>
                            </tr>
                            <tr class="bg-secondary white">
                                <td class="text-right">{{ $t("Due") }}/{{ $t("Status") }}</td>
                                <td class="text-left">
                                    <input type="text" v-model="billForm.due" :class="{'is-invalid': billForm.errors.has('due')}" id="due" placeholder="Due" readonly class="form-control"/>
                                    <has-error :form="billForm" field="due"></has-error>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <hr/>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary text-right" data-dismiss="modal"><i class="fas fa-times"></i> {{ $t("Close") }}</button>
                            </div>
                            <div class="col-6">
                                <button :disabled="billForm.busy" type="submit" @click.prevent="submitBillReceive" class="btn btn-primary"><i class="fas fa-save"></i> {{ $t("ReceiveNow") }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="printMe" v-show="isPrint">
            <div class="row" v-if="student !== ''">
                <div class="col-6" v-if="printAble !== ''">
                    <div class="text-center">
                        <h3>{{lang == 'en' ? basic.name : basic.name_bn}}</h3>
                        <h5>{{basic.address}}</h5>
                        <h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
                        <span class="border rounded p-2">{{ $t('ReceiptOfBill') }}</span>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <p>{{ $t('Custom') }}: {{printAble.package.custom}}</p>
                                <p>{{ $t('Date') }}: {{printAble.updated_at|myDate}}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <p>{{ $t('StudentName') }}: {{ student.student_data.name }} - ({{student.academic_data.academic_id }})</p>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div class="flex-fill">
                                    <p>{{$t("Academic_Class") }}: {{student.academic_data.class }}</p>
                                </div>
                                <template v-if="type == 1">
                                    <div class="flex-fill">
                                        <p>{{$t("Academic_Group") }}: {{student.academic_data.group }}</p>
                                    </div>
                                </template>
                                <template v-if="type == 1 || type == 0">
                                    <div class="flex-fill">
                                        <p>{{$t("Group_section") }}: {{student.academic_data.section }}</p>
                                    </div>
                                </template>
                                <template v-if="type == 2">
                                    <div class="flex-fill">
                                        <p>{{$t("Academic_Department") }}: {{student.academic_data.department }}</p>
                                    </div>
                                    <div class="flex-fill">
                                        <p>{{$t("Department_year") }}: {{student.academic_data.year }}</p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td class="text-right">{{ $t("Details") }}</td>
                                    <td class="text-left">{{ $t("amount") }}</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(b, r) in printAble.package.items" :key="r">
                                    <td class="text-right">{{ b.text }}</td>
                                    <td>{{ b.amount | withCurrency }}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-right">{{ $t("Total") }}</td>
                                    <td>{{ printAble.package.total | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("Fine") }} (+)</td>
                                    <td>{{ printAble.fine | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("Waiver") }} (-)</td>
                                    <td>{{ printAble.waiver | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("GrandTotal") }}</td>
                                    <td>{{ printAble.total + printAble.fine - printAble.waiver | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("PayNow") }}</td>
                                    <td>{{ printAble.pay | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("Due") }}</td>
                                    <td>{{ printAble.due | withCurrency }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12">
                            <p>{{ $t('InWord') }} {{printAble.total + printAble.fine - printAble.waiver | toWords | upperText}}</p>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <p>{{ $t('Date') }}:</p>
                                <p>{{ $t('ReceiverSignature') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6" v-if="printAble !== ''">
                    <div class="text-center">
                        <h3>{{lang == 'en' ? basic.name : basic.name_bn}}</h3>
                        <h5>{{basic.address}}</h5>
                        <h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
                        <span class="border rounded p-2">{{ $t('ReceiptOfBill') }}</span>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <p>{{ $t('Custom') }}: {{printAble.package.custom}}</p>
                                <p>{{ $t('Date') }}: {{printAble.updated_at|myDate}}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <p>{{ $t('StudentName') }}: {{ student.student_data.name }} - ({{student.academic_data.academic_id }})</p>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div class="flex-fill">
                                    <p>{{$t("Academic_Class") }}: {{student.academic_data.class }}</p>
                                </div>
                                <template v-if="type == 1">
                                    <div class="flex-fill">
                                        <p>{{$t("Academic_Group") }}: {{student.academic_data.group }}</p>
                                    </div>
                                </template>
                                <template v-if="type == 1 || type == 0">
                                    <div class="flex-fill">
                                        <p>{{$t("Group_section") }}: {{student.academic_data.section }}</p>
                                    </div>
                                </template>
                                <template v-if="type == 2">
                                    <div class="flex-fill">
                                        <p>{{$t("Academic_Department") }}: {{student.academic_data.department }}</p>
                                    </div>
                                    <div class="flex-fill">
                                        <p>{{$t("Department_year") }}: {{student.academic_data.year }}</p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td class="text-right">{{ $t("Details") }}</td>
                                    <td class="text-left">{{ $t("amount") }}</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(b, r) in printAble.package.items" :key="r">
                                    <td class="text-right">{{ b.text }}</td>
                                    <td>{{ b.amount | withCurrency }}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-right">{{ $t("Total") }}</td>
                                    <td>{{ printAble.package.total | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("Fine") }} (+)</td>
                                    <td>{{ printAble.fine | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("Waiver") }} (-)</td>
                                    <td>{{ printAble.waiver | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("GrandTotal") }}</td>
                                    <td>{{ printAble.total + printAble.fine - printAble.waiver | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("PayNow") }}</td>
                                    <td>{{ printAble.pay | withCurrency }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ $t("Due") }}</td>
                                    <td>{{ printAble.due | withCurrency }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12">
                            <p>{{ $t('InWord') }} {{printAble.total + printAble.fine - printAble.waiver | toWords | upperText}}</p>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <p>{{ $t('Date') }}:</p>
                                <p>{{ $t('ReceiverSignature') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </custom-card>
</template>

<script>
import CustomSelect from "../../globals/CustomSelect";
import CustomSelectEmpty from "../../globals/CustomSelectEmpty";

export default {
    name: "New",
    components: {CustomSelect, CustomSelectEmpty},
    data() {
        return {
            form: new Form({
                academic_class_id: "",
                academic_class_type: "",
                academic_group_id: "",
                academic_section_id: "",
                academic_department_id: "",
                academic_year_id: ""
            }),
            billForm: new Form({
                user_id: "",
                bill_id: "",
                itemTotal: "",
                total: "",
                oldPay: 0,
                pay: 0,
                fine: 0,
                waiver: 0,
                isAttempt: false
            }),
            classes: {},
            sections: {},
            groups: {},
            departments: {},
            years: {},
            students: {},
            student: "",
            type: "",
            lang: "",
            bills: "",
            receiveBill: "",
            receiveItems: "",
            isPrint: false,
            basic : {},
            printAble:''
        };
    },
    watch: {
        "billForm.pay": function (val) {
            let pay = val === "" ? 0 : val;
            if (this.billForm.isAttempt) {
                let limit = parseFloat(this.billForm.total) - parseFloat(this.billForm.oldPay);
                if (pay > limit) {
                    this.billForm.pay = limit;
                } else {
                    this.billForm.pay = val === "" ? 0 : val;
                }
            } else {
                if (pay > this.billForm.total) {
                    this.billForm.pay = this.billForm.total;
                } else {
                    this.billForm.pay = val === "" ? 0 : val;
                }
            }
            this.countDue();
        },
        "billForm.fine": function (val) {
            this.billForm.fine = val === "" ? 0 : val;
            this.billForm.pay = 0;
            this.countTotal();
            this.countDue();
        },
        "billForm.waiver": function (val) {
            this.billForm.waiver = val === "" ? 0 : val;
            this.billForm.pay = 0;
            this.countTotal();
            this.countDue();
        }
    },
    methods: {
        async print(divName) {
            await this.$htmlToPaper(divName);
        },
        countDue() {
            let due = parseFloat(this.billForm.total) - parseFloat(this.billForm.oldPay) - parseFloat(this.billForm.pay);
            if (due === 0) {
                this.billForm.due = "Paid";
            } else {
                this.billForm.due = due;
            }
        },
        countTotal() {
            let itemTotal = this.billForm.itemTotal;
            let waiver = this.billForm.waiver;
            let fine = this.billForm.fine;
            this.billForm.total = parseFloat(itemTotal) + parseFloat(fine) - parseFloat(waiver);
        },
        printReceipt(billId){
            axios.get('/api/specific-bill-receipt',{params:{id:billId}}).then((res)=>{
                this.printAble = res.data;
                setTimeout(() => {
                    this.print("printMe");
                }, 2000);
            })
        },
        submitBillReceive() {
            this.billForm
                .post("/api/submit-specific-student-bill")
                .then(res => {
                    this.printAble = res.data;
                    this.loadSpecificData(res.data.user_id);
                    this.billForm.clear();
                    $("#userModal").modal("hide");
                    setTimeout(() => {
                        this.print("printMe");
                    }, 2000);
                })
                .catch(error => {
                    console.log("fail");
                });
        },
        openUserModal() {
            this.billForm.clear();
            $("#userModal").modal("show");
        },
        receiveNow(bill) {
            this.receiveBill = bill;
            this.receiveItems = bill.package.items;
            this.billForm.user_id = bill.user_id;
            this.billForm.bill_id = bill.id;
            this.billForm.itemTotal = bill.total; //bill package total
            this.billForm.fine = bill.fine;
            this.billForm.waiver = bill.waiver;
            this.billForm.total = parseFloat(bill.total) + parseFloat(bill.fine) - parseFloat(bill.waiver);
            this.billForm.due = bill.due;
            this.billForm.oldPay = bill.pay;
            this.billForm.isAttempt = bill.isAttempt;
            this.openUserModal();
        },
        selectStudent: function (e) {
            if (e) {
                this.loadSpecificData(e);
            }
        },
        loadSpecificData(id) {
            axios.get("/api/receive-specific-student-bill", {
                    params: {id: id}
                })
                .then(res => {
                    this.student = res.data;
                    this.type = res.data.academic_data.type;
                    this.bills = res.data.bills.bills;
                })
                .catch(error => {
                });
        },
        classChange: function (e) {
            if (e) {
                this.groups = {};
                this.departments = {};
                this.sections = {};
                this.years = {};
                axios.get("/api/load-class-group-department", {
                        params: {id: e}
                    })
                    .then(res => {
                        this.form.academic_class_type = res.data.type;
                        this.groups = res.data.academic_groups;
                        this.departments = res.data.academic_departments;
                        this.sections = res.data.sections;
                        this.loadSelectedStudent();
                    });
            }
        },
        changeGroup: function (e) {
            if (e) {
                axios.get("/api/load-only-group-section", {params: {id: e}})
                    .then(res => {
                        this.sections = {};
                        this.form.academic_section_id = "";
                        this.sections = res.data.sections;
                    });
                this.loadSelectedStudent();
            }
        },
        changeSection: function (e) {
            if (e) {
                this.loadSelectedStudent();
            }
        },
        changeDepartment: function (e) {
            if (e) {
                this.years = {};
                axios.get("/api/load-department-years", {params: {id: e}})
                    .then(res => {
                        this.years = res.data.sections;
                    });
                this.loadSelectedStudent();
            }
        },
        changeYear: function (e) {
            if (e) {
                this.loadSelectedStudent();
            }
        },
        loadSelectedStudent() {
            let params = {
                academic_class_id: this.form.academic_class_id,
                academic_class_type: this.form.academic_class_type,
                academic_group_id: this.form.academic_group_id,
                academic_section_id: this.form.academic_section_id,
                academic_department_id: this.form.academic_department_id,
                academic_year_id: this.form.academic_year_id
            };
            axios
                .get("/api/load-specific-student", {params: params})
                .then(res => {
                    this.students = res.data;
                });
        },
        loadClassList() {
            axios.get("/api/load-class-list").then(res => {
                this.classes = res.data;
            });
        }
    },
    created() {
        this.loadClassList();
    },
    mounted() {
        this.lang = this.$store.state.locale;
        this.basic = this.$store.getters.basicData;
    }
};
</script>

<style scoped>
.table-user-information > tbody > tr:first-child {
    border-top: 0;
}

.table-user-information > tbody > tr > td {
    border-top: 0;
}

@media print {
    #printMe,
    #printMe * {
        visibility: visible;
    }

    #printMe {
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>
