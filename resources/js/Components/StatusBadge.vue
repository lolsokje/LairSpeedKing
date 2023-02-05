<template>
    <span class="text-xs py-1 px-2 rounded uppercase"
          :class="{ 'bg-success text-dark': isApproved(), 'bg-danger': isDenied(), 'bg-warning text-dark': isSubmitted() }"
    >
        {{ status }}
    </span>
</template>

<script setup>
const props = defineProps({
    status: String,
});

const isApproved = () => {
    return props.status === 'Approved';
};

const isDenied = () => {
    return props.status === 'Denied';
};

const isSubmitted = () => {
    return props.status === 'Submitted';
};
</script>
