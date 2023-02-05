<template>
    <BackToOverviewButton :link="route('admin.index')"/>

    <Header text="Manage tracks"/>

    <ButtonLink :href="route('admin.tracks.create')" label="Add track" class="my-6"/>

    <ContentIndex type="tracks" :content="tracks" :has_variations="true"/>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import ContentIndex from '@/Shared/Content/Index.vue';
import Header from '@/Shared/Header.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    tracks: {
        type: Array,
        required: true,
    },
});
</script>
