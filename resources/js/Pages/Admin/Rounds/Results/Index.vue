<template>
	<BackToOverviewButton :link="route('admin.seasons.rounds.index', [season])"/>

	<Header :text="'Times for ' + round.name"/>

	<div v-if="!route().current().includes('pending')">
		<input type="checkbox" class="form-check-inline" v-model="onlyPending" id="only_pending">
		<label for="only_pending" class="form-label">Show only pending laptimes</label>
	</div>

	<table class="table table-borderless table-responsive custom-table">
		<thead>
		<tr>
			<th class="text-center">#</th>
			<th></th>
			<th>User</th>
			<th class="text-center">Time</th>
			<th class="text-center">Video</th>
			<th class="text-center">Status</th>
			<th class="text-center"></th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="(time, key) in times" :key="key" class="align-middle">
			<td class="text-center">{{ key + 1 }}</td>
			<td><img :src="time.user.avatar" alt="" height="50" width="50" class="rounded-circle"></td>
			<td>{{ time.user.username }}</td>
			<td class="text-center">{{ time.readable_lap_time }}</td>
			<td class="text-center"><a :href="time.video_url" class="text-secondary" target="_blank">view</a></td>
			<td class="text-center">
				<span class="badge py-2" :class="statusColourClass(time.status)">{{ time.status_text }}</span>
			</td>
			<td class="text-center">
				<div class="d-flex">
					<button class="btn btn-success me-auto" v-if="canBeApproved(time)" @click="approve(time)">
						approve
					</button>
					<button class="btn btn-danger ms-auto" v-if="canBeDenied(time)" @click="deny(time)">
						deny
					</button>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';
import { Inertia } from '@inertiajs/inertia';
import LapTimeStatus from '@/LapTimeStatus';
import { ref, watch } from 'vue';

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

const pendingParam = (new URLSearchParams(window.location.search)).get('pending_only');
const onlyPending = ref(pendingParam);

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

watch(onlyPending, (checked) => {
	Inertia.get(route('admin.seasons.rounds.times.index', [props.season, props.round]), {
		only_pending: checked,
	}, {
		preserveState: true,
		only: ['times'],
	});
});
</script>
