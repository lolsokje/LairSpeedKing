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
					<InertiaLink href="#" class="btn btn-primary">
						Results
					</InertiaLink>
					<InertiaLink href="#" class="btn btn-outline-secondary ms-auto" v-if="round.status === 'Active'">
						Submit time
					</InertiaLink>
				</div>
			</div>
			<div class="card-footer status" :class="'status-' + round.status.toLowerCase()">
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
</script>

<script>
export default { name: 'RoundCard' };
</script>
