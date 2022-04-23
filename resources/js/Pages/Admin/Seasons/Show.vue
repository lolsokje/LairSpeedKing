<template>
	<BackToOverviewButton :link="route('admin.seasons.index')"/>

	<Header :text="season.name"/>

	<div class="row">
		<div class="col-lg-4 col-md-6 col-12 mb-3" v-for="(page, key) in pages" :key="key">
			<div class="card">
				<div class="card-header">
					<h2>{{ page.name }}</h2>
				</div>
				<div class="card-body">
					<p class="card-text">Total rounds: {{ season.rounds.length }}</p>
					<InertiaLink :href="page.route" class="btn btn-primary">
						Manage {{ page.name.toLowerCase() }}
					</InertiaLink>
				</div>
			</div>
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

const pages = [
	{ name: 'Rounds', route: route('admin.seasons.rounds.index', [props.season]) },
	{ name: 'Points', route: route('admin.seasons.points.index', [props.season]) },
];
</script>
