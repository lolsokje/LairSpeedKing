<template>
    <BackToOverviewButton :link="route('admin.seasons.points.index', [season])"/>

    <Header text="Set points system"/>

    <div class="w-3/12">
        <FormLabel target="points_paying_positions">Points paying positions</FormLabel>
        <FormInput type="number" id="points_paying_position" v-model="pointScoringPositions"/>
    </div>

    <Card :size="CardSize.SMALL" class="mt-4">
        <form @submit.prevent="form.post(route('admin.seasons.points.store', [season]))">
            <div v-if="form.errors">
                <p v-for="(error, index) in form.errors" class="text-danger" :key="index">{{ error }}</p>
            </div>
            <FormGroup class="flex gap-x-8 items-center" v-for="(position, key) in form.positions" :key="key">
                <FormLabel :target="`position_${key}`" class="mb-0">P{{ position.position }}</FormLabel>
                <FormInput :id="`position_${key}`" type="number" v-model="position.points" class="w-3/12"/>
            </FormGroup>

            <CustomButton v-if="form.positions.length >= 1" label="Save"/>
        </form>
    </Card>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import FormLabel from '@/Components/Forms/FormLabel.vue';
import FormInput from '@/Components/Forms/FormInput.vue';
import Card from '@/Components/Card.vue';
import CustomButton from '@/Components/CustomButton.vue';
import CardSize from '@/Enums/CardSize.js';
import FormGroup from '@/Components/Forms/FormGroup.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
});

const points = props.season.points;
const pointScoringPositions = ref(points.length ? points.length : 1);

const form = useForm({
    positions: points.length ? points : [ { position: 1, points: 0 } ],
});

watch(pointScoringPositions, (value) => {
    if (isNaN(value)) {
        return;
    }

    const amount = parseInt(value);

    if (amount === form.positions.length) {
        return;
    }

    if (amount < form.positions.length) {
        form.positions = form.positions.splice(0, amount);
        return;
    }

    for (let i = form.positions.length; i < amount; i++) {
        form.positions.push({
            position: i + 1,
            points: 0,
        });
    }
});
</script>
