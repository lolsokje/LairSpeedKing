<template>
	<BackToOverviewButton :link="route('admin.cars.index')"/>

	<Header :text="'Update ' + car.name"/>

	<ContentEdit type="cars" :item="car" :content_types="content_types"/>
</template>

<script setup>
import ContentEdit from '@/Shared/Content/Edit.vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';

const props = defineProps({
	car: {
		type: Object,
		required: true,
	},
	content_types: {
		type: Object,
		required: true,
	},
});


</script>
