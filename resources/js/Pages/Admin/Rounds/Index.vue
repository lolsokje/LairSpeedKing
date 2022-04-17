<template>
	<InertiaLink :href="route('admin.seasons.show', [season])">&larr; back to overview</InertiaLink>

	<h2 class="mt-5">Manage rounds</h2>

	<InertiaLink :href="route('admin.seasons.rounds.create', [season])" class="btn btn-primary my-4">
		Add round
	</InertiaLink>

	<div v-if="rounds.length">
		<div class="row">
			<div class="col-4 mb-4" v-for="round in rounds" :key="round.id">
				<div class="card">
					<img src="#" alt="" class="card-img-top">
					<div class="card-body">
						<h4 class="card-title">{{ round.name }}</h4>
						<h6 class="card-subtitle text-muted mb-2">{{ round.date_range }}</h6>
						<p class="card-text mb-0">Car: {{ round.car.name }}</p>
						<p class="card-text mb-0">Track: {{ round.variation.track.name }}</p>
						<p class="card-text">Variation: {{ round.variation.name }}</p>
						<InertiaLink :href="route('admin.seasons.rounds.edit', [season, round])"
									 class="btn btn-outline-primary">Edit
						</InertiaLink>
					</div>
					<div class="card-footer status" :class="'status-' + round.status.toLowerCase()">
						{{ round.status }}
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	rounds: {
		type: Object,
		required: true,
	},
});
</script>
