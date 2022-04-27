<template>
	<BackToOverviewButton :link="route('seasons.show', [round.season])"/>

	<Header :text="`'${round.name}' - '${round.season.name}`"/>

	<h3 class="py-4">Notes</h3>
	<p v-html="round.notes"></p>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	round: {
		type: Object,
		required: true,
	},
});
</script>
