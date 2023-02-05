<template>
    <BackToOverviewButton :link="route('admin.cars.index')"/>

    <Header text="Add car"/>

    <ContentCreate type="cars" :content_types="content_types"/>
</template>

<script setup>
import ContentCreate from '@/Shared/Content/Create.vue';
import Header from '@/Shared/Header.vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';

const props = defineProps({
    content_types: {
        type: Object,
        required: true,
    },
});
</script>
