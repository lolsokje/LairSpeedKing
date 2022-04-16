<template>
	<InertiaLink :href="route('admin.seasons.index')">&larr; back to overview</InertiaLink>

	<h2 class="mt-5">{{ season.name }}</h2>

	<InertiaLink href="#" class="btn btn-primary my-4">Add week</InertiaLink>
</template>

<script setup>
const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
});
</script>
