<template>
	<BackToOverviewButton :link="route('admin.seasons.rounds.index', [season])"/>

	<Header :text="'Edit round ' + round.name"/>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.put(route('admin.seasons.rounds.update', [season, round]))">
				<div v-if="form.errors">
					<p class="text-danger" v-for="error in form.errors">{{ error }}</p>
				</div>

				<div class="row mb-3">
					<div class="col-10">
						<label for="name" class="form-label">Name</label>
						<input type="text" class="form-control" v-model="form.name" id="name" required>
					</div>
					<div class="col-2">
						<label for="tla" class="form-label">TLA</label>
						<input type="text" class="form-control" v-model="form.tla" id="tla" maxlength="3" required>
					</div>
					<small class="text-end">
						The TLA will be shown on the season standings page, so make sure it's unique within the season
					</small>
				</div>

				<div class="row mb-3">
					<div class="col-lg-4 col-md-6 col-12">
						<label for="car" class="form-label">Car</label>
						<select id="car" class="form-select" v-model="form.car_id" required>
							<option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
						</select>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
						<label for="track" class="form-label">Track</label>
						<select id="track" class="form-select" v-model="selectedTrackId">
							<option v-for="track in tracks" :key="track.id" :value="track.id">{{
									track.name
								}}
							</option>
						</select>
					</div>

					<div class="col-lg-4 col-md-6 col-12">
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

				<div class="mb-3">
					<label for="notes" class="form-label">Round notes</label>
					<textarea v-model="form.notes" id="notes" class="form-control" rows="6"></textarea>
				</div>

				<button type="submit" class="btn btn-primary" v-if="formValid">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, onMounted, ref, watch } from 'vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	round: {
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

const selectedTrack = ref(props.round.variation.track);
const selectedTrackId = ref(selectedTrack.value.id);
const variations = ref([]);

const form = useForm({
	name: props.round.name,
	tla: props.round.tla,
	car_id: props.round.car_id,
	track_variation_id: props.round.track_variation_id,
	starts_at: props.round.starts_at,
	ends_at: props.round.ends_at,
	notes: props.round.notes.replace('<br />', ''),
});

const formValid = computed(() => {
	return form.name.length >= 3
		&& form.tla.length === 3
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

onMounted(() => {
	variations.value = props.tracks.find((track) => track.id === selectedTrackId.value).variations;

	form.starts_at = formatDate(form.starts_at);
	form.ends_at = formatDate(form.ends_at);
});

const formatDate = (dateTime) => {
	const date = new Date(dateTime);

	// TODO figure out if there's a better way of formatting the date rather than using a French-Canadian format
	return new Intl.DateTimeFormat('fr-CA').format(date);
};
</script>
