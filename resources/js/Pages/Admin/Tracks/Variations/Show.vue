<template>
	<InertiaLink :href="route('admin.tracks.variations.index', [track])">&larr; back to overview</InertiaLink>
</template>

<script setup>
const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
});
</script>
