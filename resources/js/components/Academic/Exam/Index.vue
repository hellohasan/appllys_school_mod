<template>
	<custom-card :title="$t('ExamList')" :url="'/academic-exam-create'" :text="$t('ExamList')">
		<div class="table-responsive">
			<table id="myTable" class="table table-bordered table-striped display dt-responsive nowrap" style="width:100%">
				<thead>
					<tr>
						<th>{{ $t('SL') }}</th>
						<th>{{ $t('Custom') }}</th>
						<th>{{ $t('Title') }}</th>
						<th>{{ $t('StartDate') }}</th>
						<th>{{ $t('EndDate') }}</th>
						<th>{{ $t('Total') }}</th>
						<th>{{ $t('Routine') }}</th>
						<th>{{ $t('Status') }}</th>
						<th class="not-export-col">{{ $t('Action') }}</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(exam, index) in exams" :key="index">
						<td>{{ ++index }}</td>
						<td>{{ exam.custom }}</td>
						<td>{{ exam.title }}</td>
						<td>{{ exam.start_date | myDate }}</td>
						<td>{{ exam.end_date | myDate }}</td>
						<td>{{ exam.students_count | students }}</td>
						<td>
							<span class="badge cursor-pointer" :class="exam.is_routine ? 'badge-success' : 'badge-warning'">{{ exam.is_routine ? 'Created' : 'Pending' }}</span>
						</td>
						<td>
							<span class="badge cursor-pointer" :class="exam.status ? 'badge-success' : 'badge-warning'">{{ exam.status ? 'Complete' : 'Pending' }}</span>
						</td>
						<td>
							<div class="btn-group btn-group-sm" role="group" aria-label="...">
								<router-link :to="`/academic-exam/${exam.custom}/routine`" class="btn btn-sm btn-info"><i class="fas fa-list-alt"></i> Routine</router-link>
								<router-link :to="`/academic-exam/${exam.custom}/show`" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Show</router-link>
								<button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</custom-card>
</template>

<script>
	require('datatables.net-bs4/js/dataTables.bootstrap4.min')
	require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min')
	require('datatables.net-buttons/js/buttons.html5')
	require('datatables.net-buttons/js/buttons.colVis')
	require('datatables.net-buttons/js/buttons.print')
	export default {
		name: 'Index',
		data() {
			return {
				exams: {}
			}
		},
		methods: {
			loadExamList() {
				axios.get(`/api/academic-exam`).then((res) => {
					this.exams = res.data
					this.myTable()
				})
			},
			myTable() {
				this.$nextTick(() => {
					$('#myTable').DataTable({
						responsive: true,
						retrieve: true,
						dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6 text-center'B><'col-sm-12 col-md-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
						buttons: [
							{
								"extend": "copyHtml5",
								"text": "<i class='fas fa-copy'></i> Copy",
								"titleAttr": "Copy to clipboard",
								"className": "btn btn-secondary btn-sm",
								exportOptions: {
									columns: ":not(.not-export-col)"
								}
							},
							{
								"extend": "excelHtml5",
								"text": "<i class='fas fa-file-excel'></i> Excel",
								"titleAttr": "Export as Excel",
								"className": "btn btn-success btn-sm",
								exportOptions: {
									columns: ":not(.not-export-col)"
								}
							},
							{
								"extend": "pdfHtml5",
								"text": "<i class='fas fa-file-pdf'></i> PDF",
								"titleAttr": "Export as PDF",
								"className": "btn btn-danger btn-sm",
								exportOptions: {
									columns: ":not(.not-export-col)"
								},
								customize: function (doc) {
									doc.defaultStyle.font = 'SolaimanLipi';
									doc.styles.tableHeader.alignment = 'left';
									doc.defaultStyle.alignment = 'left';
									doc.styles.title = {
										color: 'red',
										fontSize: '25',
										alignment: 'center'
									}
									doc.styles.tableHeader.margin = doc.styles.tableBodyOdd.margin = doc.styles.tableBodyEven.margin = [5, 5, 5, 5];
									doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
								}
							},
							{
								"extend": "csvHtml5",
								"text": "<i class='fas fa-file-csv'></i> CSV",
								"titleAttr": "Export as CSV",
								"className": "btn btn-info btn-sm text-white",
								exportOptions: {
									columns: ":not(.not-export-col)"
								}
							},
							{
								"extend": "print",
								"text": "<i class='fas fa-print'></i> Print",
								"titleAttr": "Print",
								"className": "btn btn-secondary btn-sm",
								exportOptions: {
									columns: ":not(.not-export-col)"
								}
							},
							{
								"extend": "colvis",
								"text": "<i class='fas fa-print'></i> Column",
								"titleAttr": "Column Sort",
								"className": "btn btn-info btn-sm text-white",
								exportOptions: {
									columns: ":not(.not-export-col)"
								}
							}
						]
					})
				})
			},
		},
		created() {
			this.loadExamList();
		},
	}
</script>

<style lang="scss" scoped>
</style>
