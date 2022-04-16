<template>
	<InertiaLink :href="route('admin.cars.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">{{ car.name }}</h2>
</template>

<script setup>
const props = defineProps({
	car: {
		type: Object,
		required: true,
	},
});
</script>
