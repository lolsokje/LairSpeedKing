<template>
	<Header :text="'Lap times for \'' + round.name + '\''"/>

	<div class="row bg-black py-3 rounded-3 fw-bold">
		<div class="col-1 text-center">POS</div>
		<div class="col-1"></div>
		<div class="col-5">USER</div>
		<div class="col-1 text-center">TIME</div>
		<div class="col-1 text-center">GAP</div>
		<div class="col-1 text-center">INTERVAL</div>
		<div class="col-1 text-center">VIDEO</div>
		<div class="col-1 text-center">POINTS</div>
	</div>
	<div class="row py-3 my-3 rounded-3 align-items-center bg-accent" v-for="(time, index) in times" :key="index">
		<div class="col-1 text-center">{{ index + 1 }}</div>
		<div class="col-1">
			<img :src="time.user.avatar" height="50" width="50" alt="" class="rounded-circle"
				 v-if="time.user.avatar">
		</div>
		<div class="col-5">{{ time.user.username }}</div>
		<div class="col-1 text-center">{{ time.readable_lap_time }}</div>
		<div class="col-1 text-center">{{ calculateGap(time.lap_time) }}</div>
		<div class="col-1 text-center">{{ calculateGap(time.lap_time) }}</div>
		<div class="col-1 text-center">
			<a :href="time.video_url" class="text-secondary">view</a>
		</div>
		<div class="col-1 text-center">{{ getPoints(index + 1) }}</div>
	</div>
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
	const millis = `${difference % 1000}`.padEnd(3, '0');

	return `+${minutes}:${seconds}.${millis}`;
};
</script>
