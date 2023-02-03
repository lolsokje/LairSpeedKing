<template>
	<div v-if="!round">
		<Header text="No current round active"/>
	</div>
	<div v-else>
		<Header :text="'Submit a time for \'' + round.name + '\' in season \'' + round.season.name + '\''"/>

		<div class="card">
			<div class="card-body">
				<form @submit.prevent="form.post(route('times.store'))">
					<div v-if="form.errors">
						<p class="text-danger" v-for="(error, key) in form.errors" :key="key">{{ error }}</p>
					</div>
					<div class="mb-3">
						<label for="time" class="form-label">Time</label>
						<input type="text" id="time" class="form-control" v-model="form.lap_time" placeholder="m:ss.xxx"
							   required>
						<p><small>Times must be submitted in the format "m:ss.xxx"</small></p>
					</div>

					<div class="mb-3">
						<label for="video_url" class="form-label">Youtube video URL</label>
						<input type="text" id="video_url" class="form-control" v-model="form.video_url" required>
					</div>

					<button type="submit" v-if="formValid" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script setup>
import Header from '@/Shared/Header.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const form = useForm({
	lap_time: '',
	video_url: '',
});

const props = defineProps({
	round: {
		type: Object,
		required: false,
		default: null,
	},
});

const formValid = computed(() => laptimeValid() && form.video_url.length >= 3);

const laptimeValid = () => {
	const lapTime = form.lap_time;
	const pattern = /\d{1,2}:\d{2}\.\d{3}/;
	const matches = lapTime.match(pattern);

	return matches && matches.length === 1 && matches[0] === lapTime;
};
</script>
