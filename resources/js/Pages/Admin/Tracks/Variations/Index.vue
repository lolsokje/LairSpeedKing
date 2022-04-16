<template>
	<InertiaLink :href="route('admin.tracks.index')">&larr; back to overview</InertiaLink>

	<h2 class="mt-5">Manage track variations for {{ track.name }}</h2>

	<InertiaLink :href="route('admin.tracks.variations.create', [track])" class="btn btn-primary ms-auto my-4">
		Add track variation
	</InertiaLink>

	<div>
		<div v-for="variation in variations" :key="variation.id" class="py-1">
			<div class="row p-3 table-pill">
				<div class="col-10">{{ variation.name }}</div>
				<div class="col-1">
					<InertiaLink :href="route('admin.tracks.variations.edit', [track, variation])">edit</InertiaLink>
				</div>
				<div class="col-1">
					<InertiaLink :href="route('admin.tracks.variations.show', [track, variation])">view</InertiaLink>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
	variations: {
		type: Array,
		required: true,
	},
});
</script>
