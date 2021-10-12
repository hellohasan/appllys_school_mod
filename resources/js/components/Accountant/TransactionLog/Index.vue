<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title font-weight-bold"><i class="fas fas fa-history"></i> {{ $t('TransactionLog') }}</h3>
        </div>
        <div class="card-body">

          <div class="form-row align-items-center">
            <div class="form-group col-5">
              <label for="reason">{{ $t('Reason') }}</label>
              <custom-select :options="reasons" v-model="filter.reason" :placeholder="$t('Select_One')" name="reason"></custom-select>
            </div>
            <div class="form-group col-5">
              <label for="daterange">{{ $t('DateRange') }}</label> <br>
              <date-picker v-model="filter.daterange" range :confirm="true" :shortcuts="shortcuts" format="YYYY-MM-DD" type="date" :placeholder="$t('DateRange')"></date-picker>
            </div>
            <div class="form-group col-auto" style="margin-top: 6px;">
              <br>
              <button type="button" @click.prevent="resetFilter" class="btn btn-danger"><i class="fas fa-times"></i> {{ $t('Reset') }}</button>
              <button type="button" @click.prevent="submitFilter" class="btn btn-primary"><i class="fas fa-filter"></i> {{ $t('Filter') }}</button>
            </div>
          </div>

          <hr>
          <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>{{ $t("SL") }}</th>
                  <th>{{ $t("CreatedAt") }}</th>
                  <th>{{ $t("CreateBy") }}</th>
                  <th>{{ $t("CreatedFor") }}</th>
                  <th>{{ $t("BeforeAmount") }}</th>
                  <th>{{ $t("Type") }}</th>
                  <th>{{ $t("amount") }}</th>
                  <th>{{ $t("AfterAmount") }}</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  import moment from 'moment'
  import CustomSelect from '../../globals/CustomSelect'
  import i18n from '../../../plugins/i18n';
  export default {
    name: "Index",
    components: { DatePicker, CustomSelect },
    data() {
      return {
        filter: {
          reason: '',
          daterange: '',
        },
        shortcuts: [
          {
            text: 'Today', onClick: () => {
              return [moment().toDate(), moment().toDate()]
            }
          },
          {
            text: 'Yesterday',
            onClick: () => {
              return [moment().subtract(1, 'day').toDate(), moment().subtract(1, 'day').toDate()];
            },
          },
          {
            text: 'Last 3 Days',
            onClick: () => {
              return [moment().subtract(2, 'days').toDate(), moment().toDate()]
            }
          },
          {
            text: 'Last 7 Days',
            onClick: () => {
              return [moment().subtract(6, 'days').toDate(), moment().toDate()]
            }
          },
          {
            text: 'Last 15 Days',
            onClick: () => {
              return [moment().subtract(14, 'days').toDate(), moment().toDate()]
            }
          },
          {
            text: 'Last 30 Day',
            onClick: () => {
              return [moment().subtract(29, 'days').toDate(), moment().toDate()]
            }
          },
          {
            text: 'This Month',
            onClick: () => {
              return [moment().startOf('month').toDate(), moment().endOf('month').toDate()]
            }
          },
          {
            text: 'Last Month',
            onClick: () => {
              return [moment().subtract(1, 'month').startOf('month').toDate(), moment().subtract(1, 'month').endOf('month').toDate()]
            }
          },
          {
            text: 'Last 3 Month',
            onClick: () => {
              return [moment().subtract(2, 'month').startOf('month').toDate(), moment().toDate()]
            }
          },
          {
            text: 'This Year',
            onClick: () => {
              return [moment().startOf('year').toDate(), moment().toDate()]
            }
          },
          {
            text: 'Last Year',
            onClick: () => {
              return [moment().subtract(1, 'year').startOf('year').toDate(), moment().subtract(1, 'year').endOf('year').toDate()]
            }
          },

        ],
        reasons: [
          { id: 'bill_receive', text: i18n.tc('BillReceive') },
          { id: 'expense', text: i18n.tc('AcademicExpense') },
          { id: 'salary', text: i18n.tc('Salary') },
          { id: 'transfer_from', text: i18n.tc('SendingAmount') },
          { id: 'transfer_to', text: i18n.tc('ReceiveAmount') },
        ]
      }
    },
    methods: {
      submitFilter() {
        if (this.filter.reason != '' || this.filter.daterange != '') {
          this.myTable();
        }
      },
      resetFilter() {
        if (this.filter.reason != '' || this.filter.daterange != '') {
          this.filter.reason = ''
          this.filter.daterange = ''
          this.myTable();
        }
      },
      myTable() {
        $("#myTable").DataTable().clear().destroy();
        $("#myTable").DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          retrieve: true,
          destroy: true,
          ajax: {
            url: "/api/transaction-logs",
            type: "GET",
            data: this.filter,
            headers: {
              Authorization: "Bearer " + this.$store.getters.currentUser.token,
            },
          },
          columns: [
            { data: "DT_RowIndex" },
            { data: "created_at" },
            { data: "user_id" },
            { data: "reason" },
            { data: "before_amount" },
            { data: "type" },
            { data: "amount" },
            { data: "after_amount" },
          ],
          dom:
            "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          pageLength: 25,
          lengthMenu: [
            [10, 25, 50, 75, 100, -1],
            [10, 25, 50, 75, 100, "All"],
          ],
          buttons: [
            {
              extend: "print",
              text: "<i class='fas fa-print'></i> Print",
              titleAttr: "Print",
              className: "btn btn-info btn-sm text-white",
              exportOptions: {
                columns: ":not(.not-export-col)",
              },
            },
            {
              extend: "pdfHtml5",
              text: "<i class='fas fa-file-pdf'></i> PDF",
              titleAttr: "Export as PDF",
              className: "btn btn-success btn-sm",
              exportOptions: {
                columns: ":not(.not-export-col)",
              },
              customize: function (doc, config) {
                doc.defaultStyle.font = "SolaimanLipi";
                doc.styles.tableHeader.alignment = "left";
                doc.defaultStyle.alignment = "left";
                doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5, 5, 5, 5];
                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join("*").split("");

                let tableNode;
                for (let i = 0; i < doc.content.length; ++i) {
                  if (doc.content[i].table !== undefined) {
                    tableNode = doc.content[i];
                    break;
                  }
                }
                const rowIndex = 0;
                const tableColumnCount = tableNode.table.body[rowIndex].length;
                if (tableColumnCount > 6) {
                  doc.pageOrientation = "landscape";
                }
              },
            },
            {
              extend: "excelHtml5",
              text: "<i class='fas fa-file-excel'></i> Excel",
              titleAttr: "Export as Excel",
              className: "btn btn-secondary btn-sm",
              exportOptions: {
                columns: ":not(.not-export-col)",
              },
            },
            {
              extend: "copyHtml5",
              text: "<i class='fas fa-copy'></i> Copy",
              titleAttr: "Copy to clipboard",
              className: "btn btn-info btn-sm text-white",
              exportOptions: {
                columns: ":not(.not-export-col)",
              },
            },
          ],
        });
      },
    },
    mounted() {
      this.myTable();
    }
  };
</script>

<style lang="scss" scoped>
  .mx-datepicker {
    display: block;
    width: 100%;
  }
  .mx-input {
    height: 38px;
    font-size: 16px;
  }
</style>
