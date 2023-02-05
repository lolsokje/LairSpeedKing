<template>
    <InertiaLink :href="link"
                 class="p-4 uppercase hover:text-primary-hover font-bold active:text-primary-active"
                 :class="{ 'text-secondary hover:text-secondary-hover active:text-secondary-active': secondary }"
    >
        {{ label }}
    </InertiaLink>
</template>

<script setup>
defineProps({
    link: String,
    label: String,
    secondary: Boolean,
});
</script>
