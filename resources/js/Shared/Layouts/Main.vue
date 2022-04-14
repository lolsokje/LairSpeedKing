<template>
	<nav>
		<div class="container">
			<ul class="list-unstyled">
				<li class="nav-item" v-if="!user">
					<a class="nav-link" :href="route('auth.discord.redirect')">Login</a>
				</li>
				<li class="nav-item" v-else>
					<InertiaLink :href="route('auth.logout')" as="button" method="POST" class="nav-link btn btn-link">
						Logout
					</InertiaLink>
				</li>
			</ul>
		</div>
	</nav>
	<slot/>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const user = computed(() => usePage().props.value.auth.user);
</script>

<script>
export default { name: 'Main' };
</script>
