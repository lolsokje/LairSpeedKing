<template>
	<nav class="navbar navbar-expand-lg my-5">
		<div class="container">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<InertiaLink :href="route('index')" class="nav-link">Home</InertiaLink>
				</li>
				<li class="nav-item" v-if="!user">
					<a class="nav-link" :href="route('auth.discord.redirect')">Login</a>
				</li>
				<li class="nav-item" v-if="user">
					<InertiaLink href="#" class="nav-link text-secondary">Submit a time</InertiaLink>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto" v-if="user && user.is_admin">
				<li class="nav-item" v-if="user">
					<InertiaLink :href="route('auth.logout')" as="button" method="POST"
								 class="nav-link btn btn-link me-3">
						Logout
					</InertiaLink>
				</li>
				<li class="nav-item">
					<InertiaLink :href="route('admin.index')" class="btn btn-outline-primary nav-link">
						Admin
					</InertiaLink>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<slot/>
	</div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const user = computed(() => usePage().props.value.auth.user);
</script>

<script>
export default { name: 'Main' };
</script>
