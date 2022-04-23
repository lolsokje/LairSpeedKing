<template>
	<BackToOverviewButton :link="route('admin.seasons.points.index', [season])"/>

	<Header text="Set points system"/>

	<div class="row mb-4">
		<label for="points_paying_positions" class="col-2 col-form-label">Points paying positions</label>
		<div class="col-1">
			<input type="text" class="form-control" v-model="pointScoringPositions">
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.post(route('admin.seasons.points.store', [season]))">
				<div v-if="form.errors">
					<p v-for="(error, index) in form.errors" class="text-danger" :key="index">{{ error }}</p>
				</div>
				<div class="row mb-3" v-for="(position, key) in form.positions" :key="key">
					<label :for="'position_' + key" class="col-1 col-form-label">P{{ position.position }}</label>
					<div class="col-1">
						<input type="text" class="form-control" v-model="position.points">
					</div>
				</div>

				<button type="submit" class="btn btn-primary" v-if="form.positions.length >= 1">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
});

const points = props.season.points;
const pointScoringPositions = ref(points.length ? points.length : 1);

const form = useForm({
	positions: points.length ? points : [{ position: 1, points: 0 }],
});

watch(pointScoringPositions, (value) => {
	if (isNaN(value)) {
		return;
	}

	const amount = parseInt(value);

	if (amount === form.positions.length) {
		return;
	}

	if (amount < form.positions.length) {
		form.positions = form.positions.splice(0, amount);
		return;
	}

	for (let i = form.positions.length; i < amount; i++) {
		form.positions.push({
			position: i + 1,
			points: 0,
		});
	}
});
</script>
