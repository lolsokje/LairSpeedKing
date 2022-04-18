<template>
	<BackToOverviewButton :link="route('admin.cars.index')"/>

	<Header :text="car.name"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	car: {
		type: Object,
		required: true,
	},
});
</script>
