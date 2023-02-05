<template>
    <select :id="id"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="w-full rounded p-2 text-black"
            :required="required"
    >
        <slot/>
    </select>
</template>

<script setup>
const props = defineProps({
    id: String,
    modelValue: [ String, Number ],
    required: Boolean,
});

defineEmits([ 'update:modelValue' ]);
</script>
