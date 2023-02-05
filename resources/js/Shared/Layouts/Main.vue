<template>
    <div class="text-white">
        <nav class="flex justify-between items-center container mx-auto py-8">
            <div>
                <NavLink :link="route('index')" label="Home"/>
                <template v-if="hasActiveRound">
                    <NavLink v-if="user" :link="route('times.create')" label="Submit a time" secondary/>
                    <NavLink :link="route('leaderboard')" label="Current round leaderboard" secondary/>
                </template>
            </div>
            <div>
                <template v-if="!user">
                    <a :href="route('auth.discord.redirect')" class="uppercase font-bold">Login</a>
                </template>
                <template v-else>
                    <div class="flex items-center">
                        <NavLink :link="route('auth.logout')" label="Logout" as="button" method="POST"/>
                        <div class="flex items-center">
                            <NavLink :link="route('admin.index')" label="Admin" secondary/>
                            <div class="bg-red-500 py-1 px-2 rounded text-xs" v-if="pendingLapTimes">
                                {{ pendingLapTimes }}
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </nav>
    </div>

    <div class="container mx-auto">
        <slot/>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import NavLink from '@/Components/NavLink.vue';

const user = computed(() => usePage().props.value.auth.user);
const hasActiveRound = computed(() => usePage().props.value.has_active_round);
const pendingLapTimes = computed(() => usePage().props.value.pending_laptimes);
</script>

<script>
export default { name: 'Main' };
</script>
