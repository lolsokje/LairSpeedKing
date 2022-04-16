<template>
	<h2>Manage cars</h2>

	<InertiaLink :href="route('admin.cars.create')" class="btn btn-primary ms-auto my-4">
		Add car
	</InertiaLink>

	<div>
		<div v-for="car in cars" :key="car.id" class="py-1">
			<div class="row p-3 table-pill">
				<div class="col-10">{{ car.name }} - {{ car.content_type }}</div>
				<div class="col-1">
					<InertiaLink :href="route('admin.cars.edit', [car.id])">edit</InertiaLink>
				</div>
				<div class="col-1">
					<InertiaLink :href="route('admin.cars.show', [car.id])">view</InertiaLink>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	cars: {
		type: Array,
		required: true,
	},
});
</script>
