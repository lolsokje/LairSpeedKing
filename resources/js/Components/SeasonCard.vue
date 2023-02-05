<template>
    <Card :size="CardSize.SMALL">
        <h4>{{ season.name }}</h4>
        <p class="text-slate-500 mb-4">{{ season.date_range }}</p>
        <p class="mb-4">Rounds: {{ season.rounds_count }}</p>

        <div class="flex justify-between">
            <ButtonLink :href="route('seasons.show', [season])" label="Rounds"/>
            <ButtonLink v-if="hasStandings" :href="route('seasons.standings', [season])" label="Standings" secondary/>
        </div>
        <template #footer>
            <CardStatusFooter :status="season.status"/>
        </template>
    </Card>
</template>

<script setup>
import Card from '@/Components/Card.vue';
import CardSize from '@/Enums/CardSize.js';
import CardStatusFooter from '@/Components/CardStatusFooter.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
});

const hasStandings = props.season.times_count > 0;
</script>

<script>
export default { name: 'SeasonCard' };
</script>
