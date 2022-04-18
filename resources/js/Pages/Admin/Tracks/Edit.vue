<template>
	<BackToOverviewButton :link="route('admin.tracks.index')"/>

	<Header :text="'Update ' + track.name"/>

	<ContentEdit type="tracks" :item="track" :content_types="content_types"/>
</template>

<script setup>
import ContentEdit from '@/Shared/Content/Edit';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

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
