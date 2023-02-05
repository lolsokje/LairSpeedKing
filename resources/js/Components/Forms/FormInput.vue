<template>
    <input :type="type"
           :id="id"
           :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value)"
           class="w-full rounded p-2 text-black"
           :required="required"
    >
</template>

<script setup>
const props = defineProps({
    type: {
        type: String,
        required: false,
        default: 'text',
    },
    id: String,
    modelValue: String,
    required: Boolean,
});

defineEmits([ 'update:modelValue' ]);
</script>
