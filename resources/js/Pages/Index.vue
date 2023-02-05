<template>
    <div v-if="active" class="mb-5">
        <Header text="Active season"/>

        <CardContainer>
            <SeasonCard :season="active" :size="CardSize.LARGE"/>
        </CardContainer>
    </div>

    <div v-if="pending.length">
        <Header text="Upcoming seasons"/>

        <CardContainer>
            <SeasonCard :season="season" v-for="season in pending" :key="season.id" :size="CardSize.LARGE"/>
        </CardContainer>
    </div>

    <div v-if="completed.length">
        <Header text="Past seasons"/>

        <CardContainer>
            <SeasonCard :season="season" v-for="season in completed" :key="season.id" :size="CardSize.LARGE"/>
        </CardContainer>
    </div>
</template>

<script setup>
import SeasonCard from '@/Components/SeasonCard.vue';
import Header from '@/Shared/Header.vue';
import CardContainer from '@/Components/CardContainer.vue';
import CardSize from '@/Enums/CardSize.js';

const props = defineProps({
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
</script>
