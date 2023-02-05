<template>
    <th class="py-6" :class="{ 'text-center': center, 'text-left': left }">
        <slot/>
    </th>
</template>

<script setup>
defineProps({
    left: Boolean,
    center: Boolean,
});
</script>
