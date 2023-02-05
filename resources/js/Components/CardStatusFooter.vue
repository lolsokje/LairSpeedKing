<template>
    <div class="text-center py-3 rounded-b-lg font-bold bg-danger text-white"
         :class="{ 'bg-success text-dark' : isActive(), 'bg-white text-dark': isComplete(), 'bg-primary': isPending() }"
    >
        {{ status }}
    </div>
</template>

<script setup>
const props = defineProps({
    status: String,
});

const isActive = () => {
    return props.status === 'Active';
};

const isComplete = () => {
    return props.status === 'Completed';
};

const isPending = () => {
    return props.status === 'Pending';
};
</script>
