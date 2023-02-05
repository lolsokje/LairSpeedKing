<template>
    <td :class="{ 'py-6': !unpadded, 'text-left': left, 'text-center': center }">
        <slot/>
    </td>
</template>

<script setup>
defineProps({
    unpadded: Boolean,
    left: Boolean,
    center: Boolean,
});
</script>
