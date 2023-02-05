<template>
    <button class="bg-primary hover:bg-primary-hover active:bg-primary-active text-white hover:text-white px-6 py-2.5 leading-tight rounded uppercase text-sm font-bold"
            :class="{
                'px-3': small,
                'bg-secondary hover:bg-secondary-hover active:bg-secondary-active text-dark hover:text-dark': secondary,
                'bg-success hover:bg-success-hover active:bg-success-active text-dark hover:text-dark': success,
                'bg-danger hover:bg-danger-hover active:bg-danger-active': danger
            }"
    >
        {{ label }}
    </button>
</template>

<script setup>
defineProps({
    label: String,
    secondary: Boolean,
    success: Boolean,
    danger: Boolean,
    small: Boolean,
});
</script>
