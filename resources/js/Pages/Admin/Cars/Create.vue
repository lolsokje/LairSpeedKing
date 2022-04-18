<template>
	<BackToOverviewButton :link="route('admin.cars.index')"/>

	<AdminHeader text="Add car"/>

	<ContentCreate type="cars" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	content_types: {
		type: Object,
		required: true,
	},
});
</script>
