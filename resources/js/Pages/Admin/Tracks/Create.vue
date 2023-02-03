<template>
	<BackToOverviewButton :link="route('admin.tracks.index')"/>

	<Header text="Add track"/>

	<ContentCreate type="tracks" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create.vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';

const props = defineProps({
	content_types: {
		type: Object,
		required: true,
	},
});
</script>
