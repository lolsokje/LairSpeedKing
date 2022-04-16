<template>
	<InertiaLink :href="route('admin.index')">&larr; back to overview</InertiaLink>

	<h2 class="mt-5">Seasons</h2>

	<InertiaLink :href="route('admin.seasons.create')" class="btn btn-primary my-4">Add season</InertiaLink>

	<div class="row" v-if="seasons.length">
		<div class="col-4 mb-4" v-for="season in seasons" :key="season.id">
			<div class="card">
				<div class="card-header">
					<h2>{{ season.name }}</h2>
				</div>
				<div class="card-body">
					<p class="card-text">Weeks: 0</p>
					<p class="card-text">Participants: 0</p>
					<p class="card-text">Times submitted: 0</p>

					<div class="d-flex">
						<InertiaLink :href="route('admin.seasons.show', [season])" class="btn btn-primary">
							View season
						</InertiaLink>
						<InertiaLink :href="route('admin.seasons.edit', [season])"
									 class="btn btn-outline-primary ms-auto">
							Edit season
						</InertiaLink>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	seasons: {
		type: Array,
		required: true,
	},
});
</script>
