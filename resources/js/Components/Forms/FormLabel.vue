<template>
    <label :for="target" class="block mb-2">
        <slot/>
    </label>
</template>

<script setup>
defineProps({
    target: String,
});
</script>
