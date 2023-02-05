<template>
    <BackToOverviewButton :link="route('admin.seasons.show', [season])"/>

    <Header text="Manage rounds"/>

    <ButtonLink :href="route('admin.seasons.rounds.create', [season])" label="Add round"/>

    <CardContainer v-if="rounds.length">
        <Card v-for="round in rounds" :key="round.id">
            <template #header>
                <img src="#" alt="" class="card-img-top">
            </template>
            <h4>{{ round.name }}</h4>
            <h6 class="card-subtitle text-muted mb-2">{{ round.date_range }}</h6>
            <ul>
                <li>
                    <span class="font-bold">Car</span>
                    <p>{{ round.car.name }}</p>
                </li>
                <li class="mt-4">
                    <span class="font-bold">Track</span>
                    <p>{{ round.variation.track.name }}</p>
                </li>
                <li class="mt-4">
                    <span class="font-bold">Variation</span>
                    <p>{{ round.variation.name }}</p>
                </li>
            </ul>

            <div class="flex justify-between mt-4">
                <ButtonLink :href="route('admin.seasons.rounds.edit', [season, round])" label="Edit"/>
                <ButtonLink :href="route('admin.seasons.rounds.times.index', [season, round])"
                            label="Results"
                            secondary
                />
            </div>
            <template #footer>
                <CardStatusFooter :status="round.status"/>
            </template>
        </Card>
    </CardContainer>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import CardContainer from '@/Components/CardContainer.vue';
import Card from '@/Components/Card.vue';
import CardStatusFooter from '@/Components/CardStatusFooter.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
    rounds: {
        type: Object,
        required: true,
    },
});
</script>
