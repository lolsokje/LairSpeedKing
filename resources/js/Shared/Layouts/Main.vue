<template>
	<nav class="navbar navbar-expand-lg my-5">
		<div class="container">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<InertiaLink :href="route('index')" class="nav-link">Home</InertiaLink>
				</li>
				<li class="nav-item" v-if="user && hasActiveRound">
					<InertiaLink :href="route('times.create')" class="nav-link text-secondary">
						Submit a time
					</InertiaLink>
				</li>
				<li class="nav-item" v-if="hasActiveRound">
					<InertiaLink :href="route('leaderboard')" class="nav-link text-secondary">
						Current round leaderboard
					</InertiaLink>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto">
				<li class="nav-item" v-if="!user">
					<a class="nav-link" :href="route('auth.discord.redirect')">Login</a>
				</li>
				<li class="nav-item" v-else>
					<InertiaLink :href="route('auth.logout')" as="button" method="POST"
								 class="nav-link btn btn-link me-3">
						Logout
					</InertiaLink>
				</li>
				<li class="nav-item" v-if="user && user.is_admin">
					<InertiaLink :href="route('admin.index')"
								 class="btn btn-outline-secondary nav-link nav-link-secondary">
						Admin <span class="badge bg-danger ms-2" v-if="pendingLapTimes">{{ pendingLapTimes }}</span>
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
const hasActiveRound = computed(() => usePage().props.value.has_active_round);
const pendingLapTimes = computed(() => usePage().props.value.pending_laptimes);
</script>

<script>
export default { name: 'Main' };
</script>
