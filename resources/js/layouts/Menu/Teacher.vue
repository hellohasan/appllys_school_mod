<template>
	<Fragment>
		<li v-role="['Super Admin','Admin','Teacher']" class="nav-header">{{ $t('TeacherSection') }}</li>

		<li v-permission="['student-lists']" class="nav-item">
			<router-link to="/student-list" class="nav-link">
				<i class="nav-icon fas fa-graduation-cap cyan"></i>
				<p>{{ $t('StudentList') }}</p>
			</router-link>
		</li>

		<li v-permission="['mark-input']" class="nav-item">
			<router-link to="/mark-input" class="nav-link">
				<i class="nav-icon fas fa-pencil-ruler cyan"></i>
				<p>{{ $t('MarkInput') }}</p>
			</router-link>
		</li>

		<li v-permission="['attendance-new']" class="nav-item">
			<router-link to="/attendance/new" class="nav-link">
				<i class="nav-icon fas fa-notes-medical cyan"></i>
				<p>{{ $t('NewAttendance') }}</p>
			</router-link>
		</li>

		<li v-permission="['attendance-list']" class="nav-item">
			<router-link to="/attendance" class="nav-link">
				<i class="nav-icon fas fa-clipboard-list cyan"></i>
				<p>{{ $t('AttendanceList') }}</p>
			</router-link>
		</li>

	</Fragment>
</template>

<script>
	import role from "../../directive/role/index";
	import permission from "../../directive/permission/permission";
	import { Fragment } from "vue-fragment";

	export default {
		name: "Accountant",
		components: { Fragment },
		directives: { role, permission },
	};
</script>

<style lang="scss" scoped>
</style>
