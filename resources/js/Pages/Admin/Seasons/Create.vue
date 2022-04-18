<template>
	<BackToOverviewButton :link="route('admin.seasons.index')"/>

	<Header text="Add season"/>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.post(route('admin.seasons.store'))">
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
import Header from '@/Shared/Header';

const form = useForm({
	name: '',
});

const formValid = computed(() => form.name.length >= 3);
</script>
