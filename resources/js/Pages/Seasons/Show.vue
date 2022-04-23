<template>
	<BackToOverviewButton :link="route('index')"/>

	<Header :text="season.name"/>

	<div v-if="active" class="mb-5">
		<RoundCard :round="active" class="col-lg-4 col-md-6 col-12 mb-3" :user="user"/>
	</div>

	<div v-if="pending.length" class="mb-5">
		<div class="row">
			<RoundCard :round="round" v-for="round in pending" :key="round.id" class="col-lg-4 col-md-6 col-12 mb-3"/>
		</div>
	</div>

	<div v-if="completed.length" class="mb-5">
		<div class="row">
			<RoundCard :round="round" v-for="round in completed" :key="round.id" class="col-lg-4 col-md-6 col-12 mb03"/>
		</div>
	</div>
</template>

<script setup>
import RoundCard from '@/Shared/RoundCard';
import Header from '@/Shared/Header';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	active: {
		type: Object,
		required: true,
	},
	pending: {
		type: Array,
		required: true,
	},
	completed: {
		type: Array,
		required: true,
	},
});

const user = computed(() => usePage().props.value.auth.user);
</script>
