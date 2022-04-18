<template>
	<BackToOverviewButton :link="route('admin.index')"/>

	<AdminHeader text="Seasons"/>

	<InertiaLink :href="route('admin.seasons.create')" class="btn btn-primary mb-4">Add season</InertiaLink>

	<div class="row" v-if="seasons.length">
		<div class="col-4 mb-4" v-for="season in seasons" :key="season.id">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">{{ season.name }}</h5>
					<h6 class="card-subtitle text-muted mb-2">{{ season.date_range }}</h6>
					<p class="card-text mb-0">Rounds: {{ season.rounds_count }}</p>
					<p class="card-text mb-0">Participants: 0</p>
					<p class="card-text">Times submitted: 0</p>

					<div class="d-flex">
						<InertiaLink :href="route('admin.seasons.show', [season])" class="btn btn-primary">
							View season
						</InertiaLink>
						<InertiaLink :href="route('admin.seasons.edit', [season])"
									 class="btn btn-outline-secondary ms-auto">
							Edit season
						</InertiaLink>
					</div>
				</div>
				<div class="card-footer status" :class="'status-' + season.status.toLowerCase()">
					{{ season.status }}
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	seasons: {
		type: Array,
		required: true,
	},
});
</script>
