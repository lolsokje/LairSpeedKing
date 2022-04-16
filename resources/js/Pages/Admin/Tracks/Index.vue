<template>
	<InertiaLink :href="route('admin.index')">&larr; back to overview</InertiaLink>

	<h2 class="mt-5">Manage tracks</h2>

	<InertiaLink :href="route('admin.tracks.create')" class="btn btn-primary ms-auto my-4">
		Add track
	</InertiaLink>

	<ContentIndex type="tracks" :content="tracks" :has_variations="true"/>
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
