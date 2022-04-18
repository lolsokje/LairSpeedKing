<template>
	<BackToOverviewButton :link="route('admin.seasons.index')"/>

	<AdminHeader :text="'Edit ' + season.name"/>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.put(route('admin.seasons.update', [season]))">
				<div v-if="form.errors">
					<p class="text-danger" v-for="error in form.errors">{{ error }}</p>
				</div>
				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" id="name" v-model="form.name" required>
				</div>

				<button type="submit" class="btn btn-primary" v-if="formValid">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton';
import AdminHeader from '@/Shared/AdminHeader';

const props = defineProps({
	season: {
		type: Object,
		required: true,
	},
});

const form = useForm({
	name: props.season.name,
});

const formValid = computed(() => form.name.length >= 3);
</script>
