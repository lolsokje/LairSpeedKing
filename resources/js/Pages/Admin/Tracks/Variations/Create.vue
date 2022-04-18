<template>
	<BackToOverviewButton :link="route('admin.tracks.variations.index', [track])"/>

	<Header text="Add track variations"/>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.post(route('admin.tracks.variations.store', [track]))">
				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" v-model="form.name" required>
				</div>

				<button type="submit" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import Header from '@/Shared/Header';

const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
});

const form = useForm({
	name: '',
});
</script>
