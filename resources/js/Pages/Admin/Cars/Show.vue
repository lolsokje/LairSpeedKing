<template>
	<BackToOverviewButton :link="route('admin.cars.index')"/>

	<AdminHeader :text="car.name"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	car: {
		type: Object,
		required: true,
	},
});
</script>
