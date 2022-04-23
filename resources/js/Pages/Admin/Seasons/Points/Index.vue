<template>
	<BackToOverviewButton :link="route('admin.seasons.show', [season])"/>

	<Header :text="'Point system for \'' + season.name + '\''"/>

	<InertiaLink :href="route('admin.seasons.points.create', [season])" class="btn btn-primary mb-4">
		Set points system
	</InertiaLink>

	<div class="card" v-if="season.points.length">
		<div class="card-body p-3">
			<h3 class="card-header">Current point system</h3>
			<p class="card-text px-3 mt-4" v-for="point in season.points" :key="point.id">
				P{{ point.position }}: {{ point.points }} point(s)
			</p>
		</div>
	</div>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
});
</script>
