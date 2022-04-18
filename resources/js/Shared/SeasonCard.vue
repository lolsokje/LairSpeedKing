<template>
	<div class="card mb-3 px-0">
		<div class="card-body">
			<h5 class="card-title">{{ season.name }}</h5>
			<h6 class="card-subtitle text-muted mb-3">{{ season.date_range }}</h6>
			<p class="card-text mb-3">Rounds: {{ season.rounds_count }}</p>

			<div class="d-flex">
				<InertiaLink :href="route('seasons.show', [season])" class="btn btn-primary">
					Rounds
				</InertiaLink>
				<InertiaLink href="#" class="btn btn-outline-secondary ms-auto" v-if="hasStandings">
					Standings
				</InertiaLink>
			</div>
		</div>
		<div class="card-footer status" :class="footerClass">
			{{ season.status }}
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
});

const footerClass = `status-${props.season.status.toLowerCase()}`;
const hasStandings = props.season.status === 'Active' || props.season.status === 'Completed';
</script>

<script>
export default { name: 'SeasonCard' };
</script>
