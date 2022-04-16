<template>
	<InertiaLink :href="route('admin.cars.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">Update {{ car.name }}</h2>

	<ContentEdit type="cars" :item="car" :content_types="content_types"/>
</template>

<script setup>
import ContentEdit from '@/Shared/Content/Edit';

const props = defineProps({
	car: {
		type: Object,
		required: true,
	},
	content_types: {
		type: Array,
		required: true,
	},
});


</script>
