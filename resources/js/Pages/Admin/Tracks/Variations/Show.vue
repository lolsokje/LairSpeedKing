<template>
	<BackToOverviewButton :link="route('admin.tracks.variations.index', [track])"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';

const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
});
</script>
