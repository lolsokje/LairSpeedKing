<template>
	<InertiaLink :href="route('admin.tracks.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">Update {{ track.name }}</h2>

	<ContentEdit type="tracks" :item="track" :content_types="content_types"/>
</template>

<script setup>
import ContentEdit from '@/Shared/Content/Edit';

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
