<template>
	<h2>{{ season.name }}</h2>

	<div v-if="active" class="mb-5">
		<RoundCard :round="active" class="col-4"/>
	</div>

	<div v-if="pending.length" class="mb-5">
		<div class="row">
			<RoundCard :round="round" v-for="round in pending" :key="round.id" class="col-4"/>
		</div>
	</div>

	<div v-if="completed.length" class="mb-5">
		<div class="row">
			<RoundCard :round="round" v-for="round in completed" :key="round.id" class="col-4"/>
		</div>
	</div>
</template>

<script setup>
import RoundCard from '@/Shared/RoundCard';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
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
