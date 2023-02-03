<template>
	<BackToOverviewButton :link="route('admin.index')"/>

	<Header text="Manage cars"/>

	<InertiaLink :href="route('admin.cars.create')" class="btn btn-primary ms-auto mb-4">
		Add car
	</InertiaLink>

	<ContentIndex type="cars" :content="cars"/>
</template>

<script setup>
import ContentIndex from '@/Shared/Content/Index.vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';

const props = defineProps({
	cars: {
		type: Array,
		required: true,
	},
});
</script>
