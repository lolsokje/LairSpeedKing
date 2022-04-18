<template>
	<BackToOverviewButton :link="route('admin.tracks.index')"/>

	<AdminHeader text="Add track"/>

	<ContentCreate type="tracks" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	content_types: {
		type: Object,
		required: true,
	},
});
</script>
