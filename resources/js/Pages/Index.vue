<template>
	<div v-if="active" class="mb-5">
		<h2>Active season</h2>

		<SeasonCard :season="active" class="col-4"/>
	</div>

	<div v-if="pending.length">
		<h2>Upcoming seasons</h2>

		<div class="container">
			<div class="row">
				<SeasonCard :season="season" v-for="season in pending" :key="season.id" class="col-4"/>
			</div>
		</div>
	</div>

	<div v-if="completed.length">
		<h2>Past seasons</h2>
	</div>
</template>

<script setup>
import SeasonCard from '@/Shared/SeasonCard';

const props = defineProps({
	active: {
		type: Object,
		required: true,
	},
	pending: {
		type: Array,
		required: true,
	},
	completed: {
		type: Array,
		required: true,
	},
});
</script>
