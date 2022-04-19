<template>
	<BackToOverviewButton :link="route('admin.seasons.rounds.index', [season])"/>

	<Header :text="'Times for ' + round.name"/>

	<label for="only_pending" class="form-label">Show only pending laptimes</label>

	<div class="row bg-black rounded-3 py-3 fw-bold align-items-center">
		<div class="col-1 text-center">#</div>
		<div class="col-1"></div>
		<div class="col-3">User</div>
		<div class="col-1 text-center">Time</div>
		<div class="col-1 text-center">Video</div>
		<div class="col-1 text-center">Status</div>
		<div class="offset-1 col-2 text-center"></div>
	</div>
	<div class="row bg-accent rounded-3 my-3 py-3 align-items-center" v-for="(time, key) in times" :key="key">
		<div class="col-1 text-center">{{ key + 1 }}</div>
		<div class="col-1">
			<img :src="time.user.avatar" alt="" height="50" width="50" class="rounded-circle">
		</div>
		<div class="col-3">{{ time.user.username }}</div>
		<div class="col-1 text-center">{{ time.readable_lap_time }}</div>
		<div class="col-1 text-center">
			<a :href="time.video_url" class="text-secondary" target="_blank">view</a>
		</div>
		<div class="col-1 text-center badge py-2" :class="statusColourClass(time.status)">{{ time.status_text }}</div>
		<div class="offset-1 col-2 text-center">
			<div class="d-flex">
				<button class="btn btn-success me-auto" @click="approve(time)" v-if="canBeApproved(time)">
					approve
				</button>
				<button v-if="canBeDenied(time)" class="btn btn-danger ms-auto" @click="deny(time)">
					deny
				</button>
			</div>
		</div>
	</div>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';
import { Inertia } from '@inertiajs/inertia';
import LapTimeStatus from '@/LapTimeStatus';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	round: {
		type: Object,
		required: true,
	},
	times: {
		type: Array,
		required: true,
	},
});

const approve = (time) => {
	handleStatusChange('admin.seasons.rounds.times.approve', time);
};

const deny = (time) => {
	handleStatusChange('admin.seasons.rounds.times.deny', time);
};

const handleStatusChange = (routeName, time) => {
	const routeToCall = route(routeName, [props.season, props.round, time]);

	Inertia.patch(routeToCall);
};

const canBeApproved = (time) => time.status === LapTimeStatus.SUBMITTED || time.status === LapTimeStatus.DENIED;
const canBeDenied = (time) => time.status === LapTimeStatus.SUBMITTED || time.status === LapTimeStatus.APPROVED;

const statusColourClass = (status) => {
	if (status === LapTimeStatus.SUBMITTED || status === LapTimeStatus.UPDATED) {
		return 'bg-warning text-black';
	}

	if (status === LapTimeStatus.APPROVED) {
		return 'bg-success text-black';
	}

	if (status === LapTimeStatus.DENIED) {
		return 'bg-danger';
	}
};
</script>
