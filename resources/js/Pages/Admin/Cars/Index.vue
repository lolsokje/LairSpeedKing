<template>
    <BackToOverviewButton :link="route('admin.index')"/>

    <Header text="Manage cars"/>

    <ButtonLink :href="route('admin.cars.create')" label="Add car"/>

    <ContentIndex type="cars" :content="cars"/>
</template>

<script setup>
import ContentIndex from '@/Shared/Content/Index.vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    cars: {
        type: Array,
        required: true,
    },
});
</script>
