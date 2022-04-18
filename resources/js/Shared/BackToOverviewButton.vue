<template>
	<InertiaLink :href="link">&larr; back to overview</InertiaLink>
</template>

<script setup>
const props = defineProps({
	link: {
		type: String,
		required: true,
	},
});
</script>

<script>
export default { name: 'BackToOverviewButton' };
</script>
