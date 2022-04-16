<template>
	<div class="card">
		<div class="card-body">
			<form @submit.prevent="form.post(route(`admin.${type}.store`))">
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
						<option v-for="(content_type, key) in content_types" :value="parseInt(key)">
							{{ content_type }}
						</option>
					</select>
				</div>

				<div class="mb-3" v-if="form.content_type !== 1">
					<label for="link" class="form-label">Download/Purchase link</label>
					<input type="text" id="link" class="form-control" v-model="form.link">
				</div>

				<button v-if="formValid" class="btn btn-outline-primary">Save</button>
			</form>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
	type: {
		type: String,
		required: true,
	},
	content_types: {
		type: Object,
		required: true,
	},
});

const form = useForm({
	name: '',
	content_type: 1,
	link: '',
});

const formValid = computed(() => {
	if (form.content_type === 1) {
		return form.name.length >= 3;
	} else {
		return form.name.length >= 3 && form.link.length >= 3;
	}
});
</script>

<script>
export default { name: 'ContentCreate' };
</script>
