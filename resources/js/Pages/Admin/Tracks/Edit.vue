<template>
	<BackToOverviewButton :link="route('admin.tracks.index')"/>

	<AdminHeader :text="'Update ' + track.name"/>

	<ContentEdit type="tracks" :item="track" :content_types="content_types"/>
</template>

<script setup>
import ContentEdit from '@/Shared/Content/Edit';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
	content_types: {
		type: Object,
		required: true,
	},
});
</script>
