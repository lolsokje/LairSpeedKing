<template>
	<h1 class="my-4">Lair Speed King Championship Management</h1>
	<div class="row">
		<div class="col-6 mb-3" v-for="page in pages">
			<div class="card">
				<img :src="'/images/' + page.image" alt="" class="card-img-top">
				<div class="card-body">
					<h4 class="card-title my-3">
						{{ page.name }}
					</h4>
					<p class="card-text">
						<InertiaLink :href="page.route" class="btn btn-secondary stretched-link">
							Manage {{ page.name.toLowerCase() }}
						</InertiaLink>
					</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	season: {
		type: Object,
		required: false,
	},
	round: {
		type: Object,
		required: false,
	},
});

const pages = [
	{ name: 'Tracks', image: 'track-cover.jpg', route: route('admin.tracks.index') },
	{ name: 'Cars', image: 'car-cover.jpg', route: route('admin.cars.index') },
	{ name: 'Seasons', image: 'seasons-cover.jpg', route: route('admin.seasons.index') },
];

if (props.round) {
	pages.push({
		name: 'Pending times',
		image: 'times-cover.jpg',
		route: route('admin.seasons.rounds.times.pending', [props.season, props.round]),
	});
}
</script>
