<template>
    <BackToOverviewButton :link="route('admin.seasons.index')"/>

    <Header :text="'Edit ' + season.name"/>

    <Card>
        <form @submit.prevent="form.put(route('admin.seasons.update', [season]))">
            <div v-if="form.errors">
                <p class="text-danger" v-for="error in form.errors">{{ error }}</p>
            </div>
            <FormGroup>
                <FormLabel for="name" class="form-label">Name</FormLabel>
                <FormInput id="name" v-model="form.name" required/>
            </FormGroup>

            <CustomButton v-if="formValid" label="Save"/>
        </form>
    </Card>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import Card from '@/Components/Card.vue';
import FormGroup from '@/Components/Forms/FormGroup.vue';
import FormLabel from '@/Components/Forms/FormLabel.vue';
import FormInput from '@/Components/Forms/FormInput.vue';
import CustomButton from '@/Components/CustomButton.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.season.name,
});

const formValid = computed(() => form.name.length >= 3);
</script>
