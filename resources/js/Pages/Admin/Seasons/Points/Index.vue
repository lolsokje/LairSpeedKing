<template>
    <BackToOverviewButton :link="route('admin.seasons.show', [season])"/>

    <Header :text="'Point system for \'' + season.name + '\''"/>

    <ButtonLink :href="route('admin.seasons.points.create', [season])" label="Set points system"/>

    <Card v-if="season.points.length" class="mt-6" :size="CardSize.SMALL">
        <h2>Current point system</h2>
        <p class="mt-4 text-lg" v-for="point in season.points" :key="point.id">
            P{{ point.position }}: {{ point.points }} point(s)
        </p>
    </Card>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import Card from '@/Components/Card.vue';
import CardSize from '@/Enums/CardSize.js';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
});
</script>
