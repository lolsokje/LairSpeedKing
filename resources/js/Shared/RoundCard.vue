<template>
	<div>
		<div class="card">
			<img src="#" alt="" class="card-img-top">
			<div class="card-body">
				<h4 class="card-title">{{ round.name }}</h4>
				<h6 class="card-subtitle text-muted mb-2">{{ round.date_range }}</h6>
				<ul class="list-group list-unstyled">
					<li class="" v-if="round.status !== 'Pending'">
						<span class="fw-bolder">Car</span>
						<p class="mb-0">
							{{ round.car.name }}
							<span v-if="showCallToAction(round.car.content_type)">
								- <a :href="round.car.link" class="text-secondary" target="_blank">
									{{ callToActionLabel(round.car.content_type) }}
								</a>
							</span>
						</p>
					</li>
					<li class="mt-3">
						<span class="fw-bolder">Track</span>
						<p class="mb-0">
							{{ round.variation.track.name }}
							<span v-if="showCallToAction(round.variation.track.content_type)">
								- <a :href="round.variation.track.link" class="text-secondary" target="_blank">
									{{ callToActionLabel(round.variation.track.content_type) }}
								</a>
							</span>
						</p>
					</li>
					<li class="mt-3">
						<span class="fw-bolder">Variation</span>
						<p>{{ round.variation.name }}</p>
					</li>
				</ul>

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
import ContentType from '@/ContentType';

const props = defineProps({
	round: {
		type: Object,
		required: true,
	},
});

const canSubmit = props.round.status === 'Active';
const footerClass = `status-${props.round.status.toLowerCase()}`;
const hasResults = props.round.status === 'Active' | props.round.status === 'Completed';

const showCallToAction = (type) => {
	return type !== ContentType.BASE;
};

const callToActionLabel = (type) => {
	if (type === ContentType.DLC) {
		return 'purchase';
	}

	if (type === ContentType.MOD) {
		return 'download';
	}
};
</script>

<script>
export default { name: 'RoundCard' };
</script>
