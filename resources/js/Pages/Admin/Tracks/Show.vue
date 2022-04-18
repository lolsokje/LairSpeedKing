<template>
	<BackToOverviewButton :link="route('admin.tracks.index')"/>

	<AdminHeader :text="track.name"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
});
</script>
