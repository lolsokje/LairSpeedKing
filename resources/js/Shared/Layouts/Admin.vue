<template>
    <nav class="flex justify-between items-center container mx-auto py-8">
        <div>
            <NavLink :link="route('index')" label="Home"/>
        </div>
        <div class="ms-auto">
            <NavLink :link="route('admin.index')" label="Admin" secondary/>
        </div>
    </nav>

    <div class="container mx-auto my-5">
        <slot/>
    </div>
</template>

<script setup>

import NavLink from '@/Components/NavLink.vue';</script>

<script>
export default { name: 'Admin' };
</script>
