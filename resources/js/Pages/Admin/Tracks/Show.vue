<template>
	<BackToOverviewButton :link="route('admin.tracks.index')"/>

	<Header :text="track.name"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
});
</script>
