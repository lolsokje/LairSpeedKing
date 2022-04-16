<template>
	<h2>Manage tracks</h2>

	<InertiaLink :href="route('admin.tracks.create')" class="btn btn-primary ms-auto my-4">
		Add track
	</InertiaLink>

	<ContentIndex type="tracks" :content="tracks"/>
</template>

<script setup>
import ContentIndex from '@/Shared/Content/Index';

const props = defineProps({
	tracks: {
		type: Array,
		required: true,
	},
});
</script>
