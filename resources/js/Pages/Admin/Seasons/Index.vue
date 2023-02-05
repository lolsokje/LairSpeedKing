<template>
    <BackToOverviewButton :link="route('admin.index')"/>

    <Header text="Seasons"/>

    <ButtonLink :href="route('admin.seasons.create')" label="Add season"/>

    <CardContainer v-if="seasons.length">
        <Card v-for="season in seasons" :key="season.id" :season="season" :size="CardSize.LARGE">
            <h5>{{ season.name }}</h5>
            <h6 class="text-slate-500 mb-4">{{ season.date_range }}</h6>
            <p>Rounds: {{ season.rounds_count }}</p>
            <p>Participants: 0</p>
            <p>Times submitted: 0</p>

            <div class="flex justify-between mt-8">
                <ButtonLink :href="route('admin.seasons.show', [season])" label="View season"/>
                <ButtonLink :href="route('admin.seasons.edit', [season])"
                            label="Edit season"
                            secondary
                />
            </div>
            <template #footer>
                <CardStatusFooter :status="season.status"/>
            </template>
        </Card>
    </CardContainer>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import CardContainer from '@/Components/CardContainer.vue';
import CardStatusFooter from '@/Components/CardStatusFooter.vue';
import CardSize from '@/Enums/CardSize.js';
import Card from '@/Components/Card.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    seasons: {
        type: Array,
        required: true,
    },
});
</script>
