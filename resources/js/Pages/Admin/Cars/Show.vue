<template>
	<BackToOverviewButton :link="route('admin.cars.index')"/>

	<Header :text="car.name"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';

const props = defineProps({
	car: {
		type: Object,
		required: true,
	},
});
</script>
