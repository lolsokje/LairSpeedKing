<template>
    <h1 class="my-4">Lair Speed King Championship Management</h1>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <Card v-for="(page, key) in pages" :key="key">
            <template #header>
                <img :src="`/images/${page.image}`" alt="">
            </template>
            <h4 class="text-white">{{ page.name }}</h4>
            <div class="pt-4">
                <ButtonLink :href="page.route"
                            :label="`Manage ${page.name.toLowerCase()}`"
                            class="after:absolute after:inset-0"
                            secondary
                />
            </div>
        </Card>
    </div>
</template>

<script setup>
import Card from '@/Components/Card.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    season: {
        type: Object,
        required: false,
    },
    round: {
        type: Object,
        required: false,
    },
});

const pages = [
    { name: 'Tracks', image: 'track-cover.jpg', route: route('admin.tracks.index') },
    { name: 'Cars', image: 'car-cover.jpg', route: route('admin.cars.index') },
    { name: 'Seasons', image: 'seasons-cover.jpg', route: route('admin.seasons.index') },
];

if (props.round) {
    pages.push({
        name: 'Pending times',
        image: 'times-cover.jpg',
        route: route('admin.seasons.rounds.times.pending', [ props.season, props.round ]),
    });
}
</script>
