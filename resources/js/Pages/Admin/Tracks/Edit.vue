<template>
	<InertiaLink :href="route('admin.tracks.index')">&larr; back to overview</InertiaLink>

	<h2 class="my-5">Update {{ track.name }}</h2>

	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.put(route('admin.tracks.update', [track]))">
				<div v-if="form.errors">
					<p class="text-danger" v-for="error in form.errors">{{ error }}</p>
				</div>
				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" id="name" v-model="form.name" required>
				</div>

				<div class="mb-3">
					<label for="content_type" class="form-label">Content type</label>
					<select id="content_type" v-model="form.content_type" class="form-select" required>
						<option v-for="content_type in content_types" :value="content_type">{{ content_type }}</option>
					</select>
				</div>

				<div class="mb-3" v-if="form.content_type !== 'base'">
					<label for="link" class="form-label">Download/Purchase link</label>
					<input type="text" id="link" class="form-control" v-model="form.link">
				</div>

				<button v-if="formValid" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
	track: {
		type: Object,
		required: true,
	},
	content_types: {
		type: Array,
		required: true,
	},
});

const form = useForm({
	name: props.track.name,
	content_type: props.track.content_type,
	link: props.track.link,
});

const formValid = computed(() => {
	if (form.content_type === 'base') {
		return form.name.length >= 3;
	} else {
		return form.name.length >= 3 && form.link.length >= 3;
	}
});
</script>
