<template>
	<h2>{{ round.name }}, {{ season.name }}</h2>
</template>

<script setup>
const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	round: {
		type: Object,
		required: true,
	},
});
</script>
