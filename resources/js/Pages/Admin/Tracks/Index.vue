<template>
	<h2>Manage tracks</h2>

	<InertiaLink :href="route('admin.tracks.create')" class="btn btn-primary ms-auto my-4">
		Add track
	</InertiaLink>

	<div>
		<div v-for="track in tracks" :key="track.id" class="py-1">
			<div class="row p-3 table-pill">
				<div class="col-10">{{ track.name }} - {{ track.content_type }}</div>
				<div class="col-1">
					<InertiaLink :href="route('admin.tracks.edit', [track.id])">edit</InertiaLink>
				</div>
				<div class="col-1">
					<InertiaLink :href="route('admin.tracks.show', [track.id])">view</InertiaLink>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	tracks: {
		type: Array,
		required: true,
	},
});
</script>
