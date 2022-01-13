<template>
	<div class="p-3">

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>SL</th>
					<th>Class Name</th>
					<th>Class Code</th>
					<th>Grading Type</th>
					<th>Details Tree</th>
					<th>Action</th>
				</tr>
			</thead>
			<thead>
				<tr v-for="(cl,index) in classes" :key="index">
					<td>{{ ++index }}</td>
					<td>{{ cl.name }}</td>
					<td>{{ cl.code }}</td>
					<td>{{ cl.grading.name }}</td>
					<td>
						<template v-if="cl.type == 2">
							<div id="tree" class="tree">
								<ul>
									<li class="parent_li"><span>Departments</span>
										<ul>
											<li class="parent_li" v-for="(d,index) in cl.academic_departments" :key="index">
												<span>{{ d.name }}
													-
													<span class="badge" :class="d.status ? 'badge-success' : 'badge-danger'">{{d.status ? 'Activate' : 'Deactivated'}}</span>
												</span>
												<ul>
													<li class="parent_li" v-for="(ss, i) in d.sections" :key="i">
														<span>{{ ss.name }}
															-
															<span class="badge" :class="ss.status ? 'badge-success' : 'badge-danger'">{{ss.status ? 'Activate' : 'Deactivated'}}</span>
														</span>
													</li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</template>
						<template v-else-if="cl.type == 1">
							<div class="tree">
								<ul>
									<li class="parent_li"><span>Groups</span>
										<ul>
											<li class="parent_li" v-for="(d,index) in cl.academic_groups" :key="index">
												<span>{{ d.name }}
													-
													<span class="badge" :class="d.status ? 'badge-success' : 'badge-danger'">{{d.status ? 'Activate' : 'Deactivated'}}</span>
												</span>
												<ul>
													<li class="parent_li" v-for="(ss, i) in d.sections" :key="i">
														<span>{{ ss.name }}
															-
															<span class="badge" :class="ss.status ? 'badge-success' : 'badge-danger'">{{ss.status ? 'Activate' : 'Deactivated'}}</span>
														</span>
													</li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</template>
						<template v-else>
							<div id="test" class="tree">
								<ul>
									<li class="parent_li"><span>Section</span>
										<ul>
											<li class="parent_li" v-for="(sec,i) in cl.sections" :key="i">
												<span>{{ sec.name }}
													-
													<span class="badge" :class="sec.status? 'badge-success' : 'badge-danger'">{{sec.status ? 'Activate' : 'Deactivated'}}</span>
												</span>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</template>
					</td>
					<td>
						<router-link :to="`/academic-class/${cl.id}/edit`" class="btn btn-sm btn-primary font-weight-bold"><i class="fas fa-edit"></i> Edit</router-link>
					</td>
				</tr>
			</thead>
		</table>
	</div>
</template>

<script>
	import Select2 from "../../globals/Select2";
	import CustomSelect from "../../globals/CustomSelect";

	export default {
		name: "Index",
		components: {
			Select2, CustomSelect
		},
		data() {
			return {
				sessions: {},
				session_id: '',
				classes: {}
			}
		},
		methods: {
			loadClasses() {
				axios.get('/api/get-academic-classes').then((res) => {
					this.classes = res.data
				})
			}
		},
		created() {
			this.loadClasses()
		}
	}
</script>


<style scoped>
	.tree {
		min-height: 20px;
		background-color: #fbfbfb;
		border: 1px solid #999;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
		-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
	}

	.tree li {
		list-style-type: none;
		margin: 0;
		padding: 10px 5px 0 5px;
		position: relative;
	}

	.tree li::before,
	.tree li::after {
		content: "";
		left: -20px;
		position: absolute;
		right: auto;
	}

	.tree li::before {
		border-left: 1px solid #999;
		bottom: 50px;
		height: 100%;
		top: 0;
		width: 1px;
	}

	.tree li::after {
		border-top: 1px solid #999;
		height: 20px;
		top: 25px;
		width: 25px;
	}

	.tree li span:not(.glyphicon) {
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		display: inline-block;
		padding: 4px 9px;
		text-decoration: none;
	}

	.tree li.parent_li > span:not(.glyphicon) {
		cursor: pointer;
	}

	.tree > ul > li::before,
	.tree > ul > li::after {
		border: 0;
	}

	.tree li:last-child::before {
		height: 30px;
	}

	.tree li.parent_li > span:not(.glyphicon):hover,
	.tree li.parent_li > span:not(.glyphicon):hover + ul li span:not(.glyphicon) {
		background: #eee;
		border: 1px solid #999;
		padding: 3px 8px;
		color: #000;
	}
</style>
