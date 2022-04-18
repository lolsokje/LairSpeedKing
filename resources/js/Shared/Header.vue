<template>
	<h2 class="my-4">{{ text }}</h2>
</template>

<script setup>
defineProps({
	text: {
		type: String,
		required: true,
	},
});
</script>

<script>
export default { name: 'Header' };
</script>
