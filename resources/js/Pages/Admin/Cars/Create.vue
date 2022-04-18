<template>
	<BackToOverviewButton :link="route('admin.cars.index')"/>

	<Header text="Add car"/>

	<ContentCreate type="cars" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create';
import Header from '@/Shared/Header';

const props = defineProps({
	content_types: {
		type: Object,
		required: true,
	},
});
</script>
