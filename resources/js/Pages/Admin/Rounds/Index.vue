<template>
	<BackToOverviewButton :link="route('admin.seasons.show', [season])"/>

	<Header text="Manage rounds"/>

	<InertiaLink :href="route('admin.seasons.rounds.create', [season])" class="btn btn-primary mb-4">
		Add round
	</InertiaLink>

	<div v-if="rounds.length">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12 mb-4" v-for="round in rounds" :key="round.id">
				<div class="card">
					<img src="#" alt="" class="card-img-top">
					<div class="card-body">
						<h4 class="card-title">{{ round.name }}</h4>
						<h6 class="card-subtitle text-muted mb-2">{{ round.date_range }}</h6>
						<ul class="list-group list-unstyled">
							<li>
								<span class="fw-bolder">Car</span>
								<p>{{ round.car.name }}</p>
							</li>
							<li>
								<span class="fw-bolder">Track</span>
								<p>{{ round.variation.track.name }}</p>
							</li>
							<li>
								<span class="fw-bolder">Variation</span>
								<p>{{ round.variation.name }}</p>
							</li>
						</ul>
						<!--						<p class="card-text mb-0">Car: {{ round.car.name }}</p>-->
						<!--						<p class="card-text mb-0">Track: {{ round.variation.track.name }}</p>-->
						<!--						<p class="card-text">Variation: {{ round.variation.name }}</p>-->

						<div class="d-flex">
							<InertiaLink :href="route('admin.seasons.rounds.edit', [season, round])"
										 class="btn btn-primary">Edit
							</InertiaLink>
							<InertiaLink :href="route('admin.seasons.rounds.times.index', [season, round])"
										 class="btn btn-outline-secondary ms-auto"
										 v-if="round.status !== 'Pending'">
								Results
							</InertiaLink>
						</div>
					</div>
					<div class="card-footer status" :class="'status-' + round.status.toLowerCase()">
						{{ round.status }}
					</div>
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
	rounds: {
		type: Object,
		required: true,
	},
});
</script>
