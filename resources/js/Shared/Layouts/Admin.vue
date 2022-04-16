<template>
	<nav class="navbar navbar-expand-lg my-5">
		<div class="container">
			<ul class="navbar-nav me-auto">
				<li class="nav-item">
					<InertiaLink class="nav-link" :href="route('admin.index')">Admin index</InertiaLink>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<InertiaLink class="btn btn-outline-primary" :href="route('index')">Home</InertiaLink>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container my-5">
		<slot/>
	</div>
</template>

<script setup>

</script>

<script>
export default { name: 'Admin' };
</script>
