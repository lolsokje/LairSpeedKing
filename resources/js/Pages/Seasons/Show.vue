<template>
    <BackToOverviewButton :link="route('index')"/>

    <Header :text="season.name"/>

    <div v-if="active" class="mb-4">
        <CardContainer>
            <RoundCard :round="active" :size="CardSize.LARGE" :user="user"/>
        </CardContainer>
    </div>

    <div v-if="pending.length" class="mb-4">
        <CardContainer>
            <RoundCard :round="round" v-for="round in pending" :key="round.id" :size="CardSize.LARGE"/>
        </CardContainer>
    </div>

    <div v-if="completed.length" class="mb-4">
        <CardContainer>
            <RoundCard :round="round" v-for="round in completed" :key="round.id" :size="CardSize.LARGE"/>
        </CardContainer>
    </div>
</template>

<script setup>
import RoundCard from '@/Components/RoundCard.vue';
import Header from '@/Shared/Header.vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import CardContainer from '@/Components/CardContainer.vue';
import CardSize from '@/Enums/CardSize.js';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
    active: {
        type: Object,
        required: false,
    },
    pending: {
        type: Array,
        required: true,
    },
    completed: {
        type: Array,
        required: true,
    },
});

const user = computed(() => usePage().props.value.auth.user);
</script>
