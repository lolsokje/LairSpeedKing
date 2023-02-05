<template>
    <BackToOverviewButton :link="route('admin.seasons.index')"/>

    <Header :text="season.name"/>

    <CardContainer>
        <Card v-for="(page, key) in pages" :key="key">
            <h2>{{ page.name }}</h2>
            <p class="mb-8 mt-4">Total rounds: {{ season.rounds.length }}</p>
            <ButtonLink :href="page.route" :label="`Manage ${page.name.toLowerCase()}`"/>
        </Card>
    </CardContainer>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import CardContainer from '@/Components/CardContainer.vue';
import Card from '@/Components/Card.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
});

const pages = [
    { name: 'Rounds', route: route('admin.seasons.rounds.index', [ props.season ]) },
    { name: 'Points', route: route('admin.seasons.points.index', [ props.season ]) },
];
</script>
