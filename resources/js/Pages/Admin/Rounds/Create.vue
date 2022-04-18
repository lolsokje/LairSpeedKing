<template>
	<InertiaLink :href="route('admin.seasons.rounds.index', [season])">&larr; back to overview</InertiaLink>

	<h2 class="mt-5">Add round to {{ season.name }}</h2>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.post(route('admin.seasons.rounds.store', [season]))">
				<div v-if="form.errors">
					<p class="text-danger" v-for="error in form.errors">{{ error }}</p>
				</div>

				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" v-model="form.name" id="name" required>
				</div>

				<div class="row mb-3">
					<div class="col-4">
						<label for="car" class="form-label">Car</label>
						<select id="car" class="form-select" v-model="form.car_id" required>
							<option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
						</select>
					</div>

					<div class="col-4">
						<label for="track" class="form-label">Track</label>
						<select id="track" class="form-select" v-model="selectedTrackId">
							<option v-for="track in tracks" :key="track.id" :value="track.id">{{ track.name }}</option>
						</select>
					</div>

					<div class="col-4">
						<label for="track_variation" class="form-label">Track variation</label>
						<select id="track_variation" class="form-select" v-model="form.track_variation_id"
								:disabled="selectedTrack === ''" required>
							<option v-for="variation in variations" :key="variation.id" :value="variation.id">
								{{ variation.name }}
							</option>
						</select>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-6">
						<label for="start_date" class="form-label">Start date</label>
						<input type="date" class="form-control" id="start_date" v-model="form.starts_at" required>
					</div>

					<div class="col-6">
						<label for="end_date" class="form-label">End date</label>
						<input type="date" class="form-control" id="end_date" v-model="form.ends_at" required>
					</div>
				</div>

				<button type="submit" class="btn btn-primary" v-if="formValid">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	tracks: {
		type: Array,
		required: true,
	},
	cars: {
		type: Array,
		required: true,
	},
});

const selectedTrack = ref(props.tracks[0]);
const selectedTrackId = ref(selectedTrack.value.id);
const variations = ref(selectedTrack.value.variations);

const form = useForm({
	name: '',
	car_id: props.cars[0].id,
	track_variation_id: variations.value[0].id,
	starts_at: '',
	ends_at: '',
});

const formValid = computed(() => {
	return form.name.length >= 3
		&& form.car_id !== ''
		&& form.track_variation_id !== ''
		&& form.starts_at !== ''
		&& form.ends_at !== '';
});

watch(selectedTrackId, (trackId) => {
	if (!trackId) {
		variations.value = [];
		return;
	}

	const selectedTrack = props.tracks.find((t) => t.id === trackId);
	variations.value = selectedTrack.variations;
	form.track_variation_id = variations.value[0].id;
});
</script>
