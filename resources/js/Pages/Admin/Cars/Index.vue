<template>
	<h2>Manage cars</h2>

	<InertiaLink :href="route('admin.cars.create')" class="btn btn-primary ms-auto my-4">
		Add car
	</InertiaLink>

	<ContentIndex type="cars" :content="cars"/>
</template>

<script setup>
import ContentIndex from '@/Shared/Content/Index';

const props = defineProps({
	cars: {
		type: Array,
		required: true,
	},
});
</script>
