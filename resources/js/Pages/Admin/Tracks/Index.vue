<template>
	<BackToOverviewButton :link="route('admin.index')"/>

	<AdminHeader text="Manage tracks"/>

	<InertiaLink :href="route('admin.tracks.create')" class="btn btn-primary mb-4">
		Add track
	</InertiaLink>

	<ContentIndex type="tracks" :content="tracks" :has_variations="true"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import ContentIndex from '@/Shared/Content/Index';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	tracks: {
		type: Array,
		required: true,
	},
});
</script>
