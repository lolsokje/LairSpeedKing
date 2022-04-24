<template>
	<BackToOverviewButton :link="route('index')"/>

	<Header :text="season.name + ' standings'"/>
	<table class="table table-borderless table-responsive custom-table">
		<thead>
		<tr>
			<th class="text-center">#</th>
			<th></th>
			<th>Driver</th>
			<th class="text-center" v-for="(round, index) in season.rounds" :key="round.id">
				<InertiaLink :href="route('times.show', [round])" class="text-secondary">
					{{ index + 1 }}
				</InertiaLink>
			</th>
			<th class="text-center">Total</th>
			<th class="text-center">Gap</th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="(result, key) in standings" :key="key" class="align-middle">
			<td class="text-center">{{ key + 1 }}</td>
			<td>
				<img :src="result.avatar" height="50" width="50" alt="" class="rounded-circle img-fluid"
					 v-if="result.avatar">
			</td>
			<td>{{ result.username }}</td>
			<td class="text-center" v-for="round in season.rounds" :key="round.id">
				{{ result.rounds[round.id] }}
			</td>
			<td class="text-center">{{ result.total }}</td>
			<td class="text-center">{{ getGap(result.total) }}</td>
		</tr>
		</tbody>
	</table>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
	standings: {
		type: Array,
		required: true,
	},
});

const getGap = (total) => {
	const leaderTotal = props.standings[0].total;

	return leaderTotal === total ? '' : `-${leaderTotal - total}`;
};
</script>
