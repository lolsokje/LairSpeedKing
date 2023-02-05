<template>
    <textarea :id="id"
              :value="modelValue"
              @input="$emit('update:modelValue', $event.target.value)"
              class="w-full rounded p-2 text-black"
              rows="6"
              :required="required"
    ></textarea>
</template>

<script setup>
const props = defineProps({
    id: String,
    modelValue: String,
    required: Boolean,
});

defineEmits([ 'update:modelValue' ]);
</script>
