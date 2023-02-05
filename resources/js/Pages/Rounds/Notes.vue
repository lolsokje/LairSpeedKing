<template>
    <BackToOverviewButton :link="route('seasons.show', [round.season])"/>

    <Header :text="`'${round.name}' - '${round.season.name}`"/>

    <Card>
        <h3 class="py-4">Notes</h3>
        <p v-html="notes"></p>
    </Card>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import Card from '@/Components/Card.vue';

const props = defineProps({
    notes: String,
    round: {
        type: Object,
        required: true,
    },
});
</script>
