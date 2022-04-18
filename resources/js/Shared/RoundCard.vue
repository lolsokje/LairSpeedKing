<template>
	<div>
		<div class="card">
			<img src="#" alt="" class="card-img-top">
			<div class="card-body">
				<h4 class="card-title">{{ round.name }}</h4>
				<h6 class="card-subtitle text-muted mb-2">{{ round.date_range }}</h6>
				<p class="card-text mb-0" v-if="round.status !== 'Pending'">Car: {{ round.car.name }}</p>
				<p class="card-text mb-0">Track: {{ round.variation.track.name }}</p>
				<p class="card-text">Variation: {{ round.variation.name }}</p>

				<div class="d-flex">
					<InertiaLink :href="route('times.show', [round])" class="btn btn-primary" v-if="hasResults">
						Results
					</InertiaLink>
					<InertiaLink :href="route('times.create')" class="btn btn-outline-secondary ms-auto"
								 v-if="canSubmit">
						Submit time
					</InertiaLink>
				</div>
			</div>
			<div class="card-footer status" :class="footerClass">
				{{ round.status }}
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	round: {
		type: Object,
		required: true,
	},
});

const canSubmit = props.round.status === 'Active';
const footerClass = `status-${props.round.status.toLowerCase()}`;
const hasResults = props.round.status === 'Active' | props.round.status === 'Completed';
</script>

<script>
export default { name: 'RoundCard' };
</script>
