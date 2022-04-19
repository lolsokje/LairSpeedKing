<template>
	<BackToOverviewButton :link="route('admin.index')"/>

	<Header text="Lap times"/>

	<a :href="route('admin.times.pending')" class="btn btn-primary my-4">View pending laptimes</a>

	<div class="row bg-black py-3 rounded-3 fw-bold">
		<div class="col-2">User</div>
		<div class="col-2">Season</div>
		<div class="col-2">Round</div>
		<div class="col-1">Time</div>
		<div class="col-1">Video</div>
		<div class="col-1"></div>
		<div class="col-3"></div>
	</div>
	<div class="row py-3 my-3 rounded-3 align-items-center bg-accent" v-for="time in times" :key="time.id">
		<div class="col-2">{{ time.user.username }}</div>
		<div class="col-2">{{ time.round.season.name }}</div>
		<div class="col-2">{{ time.round.name }}</div>
		<div class="col-1">{{ time.readable_lap_time }}</div>
		<div class="col-1"><a :href="time.video_url" target="_blank">view</a></div>
		<div class="col-1"></div>
		<div class="col-3">
			<div class="d-flex">
				<button class="btn btn-outline-success">approve</button>
				<button class="btn btn-outline-danger ms-3">reject</button>
			</div>
		</div>
	</div>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	times: {
		type: Array,
		required: true,
	},
});
</script>
