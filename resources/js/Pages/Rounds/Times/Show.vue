<template>
	<Header :text="'Lap times for \'' + round.name + '\''"/>

	<table class="table table-borderless table-responsive custom-table">
		<thead>
		<tr>
			<th class="text-center">POS</th>
			<th></th>
			<th>USER</th>
			<th class="text-center">TIME</th>
			<th class="text-center">GAP</th>
			<th class="text-center">INTERVAL</th>
			<th class="text-center">VIDEO</th>
			<th class="text-center">POINTS</th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="(time, index) in times" :key="index" class="align-middle">
			<td class="text-center">{{ index + 1 }}</td>
			<td>
				<img :src="time.user.avatar" height="50" width="50" alt="" class="rounded-circle img-fluid"
					 v-if="time.user.avatar">
			</td>
			<td>{{ time.user.username }}</td>
			<td class="text-center">{{ time.readable_lap_time }}</td>
			<td class="text-center">{{ calculateGap(time.lap_time) }}</td>
			<td class="text-center">{{ calculateInterval(index) }}</td>
			<td class="text-center">
				<a :href="time.video_url" class="text-secondary" target="_blank">view</a>
			</td>
			<td class="text-center">{{ getPoints(index + 1) }}</td>
		</tr>
		</tbody>
	</table>
</template>

<script setup>
import Header from '@/Shared/Header';

const props = defineProps({
	round: {
		type: Object,
		required: true,
	},
	times: {
		type: Array,
		required: true,
	},
	points: {
		type: Array,
		required: true,
	},
});

const calculateGap = (lapTime) => {
	const times = props.times;
	const lapTimeToCompareTo = times[0].lap_time;

	if (lapTime === lapTimeToCompareTo) {
		return '-';
	} else {
		return parseLaptimes(lapTime, lapTimeToCompareTo);
	}
};

const calculateInterval = (index) => {
	if (index === 0) {
		return '-';
	}
	const times = props.times;
	const currentLaptime = times[index].lap_time;
	const previousLaptime = times[index - 1].lap_time;

	return parseLaptimes(currentLaptime, previousLaptime);
};

const getPoints = (position) => {
	const result = props.points.find((p) => p.position === position);
	return result ? result.points : 0;
};

const parseLaptimes = (lapTime, compareLapTime) => {
	const difference = Math.abs(lapTime - compareLapTime);
	const minutes = parseInt((difference / 60000) % 60);
	const seconds = `${parseInt((difference / 1000) % 60)}`.padStart(2, '0');
	const millis = `${difference % 1000}`.padStart(3, '0');

	return `+${minutes}:${seconds}.${millis}`;
};
</script>
