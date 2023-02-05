<template>
    <div class="relative block rounded-lg shadow-lg bg-dark-accent"
         :class="{'w-4/12': size === CardSize.SMALL, 'w-6/12': size === CardSize.MEDIUM, 'w-full': size === CardSize.LARGE}"
    >
        <div :class="{ 'pb-10': hasFooter() }">
            <slot name="header"/>
            <div class="p-6">
                <h3 class="text-white leading-tight font-medium mb-2" v-if="title">{{ title }}</h3>
                <slot/>
            </div>
        </div>
        <div class="absolute bottom-0 inset-x-0">
            <slot name="footer"/>
        </div>
    </div>
</template>

<script setup>
import CardSize from '@/Enums/CardSize.js';
import { useSlots } from 'vue';

defineProps({
    size: String,
    title: String,
});

const slots = useSlots();

const hasFooter = () => {
    return !! slots['footer'];
};
</script>
