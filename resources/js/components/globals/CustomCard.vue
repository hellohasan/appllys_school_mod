<template>
	<div class="row">
		<div class="col-12">
			<div class="card card-success card-outline">
				<div v-if="title" class="card-header">
					<h3 class="card-title font-weight-bold">{{ title }}</h3>
					<div class="card-tools" v-show="tools">
						<router-link class="btn btn-success btn-sm" :to="url">
							<i class="fa-w" :class="icon"></i> {{text}}
						</router-link>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body p-3">
					<slot />
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "CustomCard",
		props: {
			title: {
				type: String,
				default: null
			},
			text: {
				type: String,
				default: null
			},
			icon: {
				type: String,
				default: 'fas fa-th-list'
			},
			url: {
				type: String,
				default: '/'
			},
			tools: {
				type: Boolean,
				default: true
			}
		}
	}
</script>

<style scoped>
</style>
