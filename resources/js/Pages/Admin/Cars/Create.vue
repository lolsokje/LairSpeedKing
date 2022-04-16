<template>
	<InertiaLink :href="route('admin.cars.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">Add car</h2>

	<ContentCreate type="cars" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create';

const props = defineProps({
	content_types: {
		type: Array,
		required: true,
	},
});
</script>
