<template>
    <InertiaLink :href="href"
                 class="bg-primary hover:bg-primary-hover active:bg-primary-active text-white hover:text-white px-6 py-2.5 leading-tight rounded uppercase text-sm font-bold"
                 :class="{ 'bg-secondary hover:bg-secondary-hover active:bg-secondary-active text-dark hover:text-dark': secondary }"
    >
        {{ label }}
    </InertiaLink>
</template>

<script setup>
defineProps({
    href: String,
    label: String,
    secondary: Boolean,
});
</script>
