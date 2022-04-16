<template>
	<InertiaLink :href="route('admin.tracks.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">Add track</h2>

	<ContentCreate type="tracks" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create';

const props = defineProps({
	content_types: {
		type: Object,
		required: true,
	},
});
</script>
