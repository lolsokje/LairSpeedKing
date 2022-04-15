<template>
	<InertiaLink :href="route('admin.tracks.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">{{ track.name }}</h2>
</template>

<script setup>
const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
});
</script>
