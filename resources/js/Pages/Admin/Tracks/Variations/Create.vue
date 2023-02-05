<template>
    <BackToOverviewButton :link="route('admin.tracks.variations.index', [track])"/>

    <Header text="Add track variations"/>

    <Card>
        <form @submit.prevent="form.post(route('admin.tracks.variations.store', [track]))">
            <FormGroup>
                <FormLabel target="name">Name</FormLabel>
                <FormInput id="name" v-model="form.name" required/>
            </FormGroup>

            <CustomButton label="Save"/>
        </form>
    </Card>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import Card from '@/Components/Card.vue';
import FormGroup from '@/Components/Forms/FormGroup.vue';
import FormLabel from '@/Components/Forms/FormLabel.vue';
import FormInput from '@/Components/Forms/FormInput.vue';
import CustomButton from '@/Components/CustomButton.vue';

const props = defineProps({
    track: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: '',
});
</script>
