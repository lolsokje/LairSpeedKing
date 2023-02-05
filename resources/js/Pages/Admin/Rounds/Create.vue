<template>
    <BackToOverviewButton :link="route('admin.seasons.rounds.index', [season])"/>

    <Header :text="'Add round to ' + season.name"/>

    <Card>
        <form @submit.prevent="form.post(route('admin.seasons.rounds.store', [season]))">
            <div v-if="form.errors">
                <p class="text-danger" v-for="error in form.errors">{{ error }}</p>
            </div>

            <div class="md:flex gap-x-0 md:gap-x-4">
                <FormGroup class="w-full md:w-10/12 mb-0">
                    <FormLabel target="name">Name</FormLabel>
                    <FormInput id="name" v-model="form.name" required/>
                </FormGroup>
                <FormGroup class="w-full md:w-2/12 mb-0">
                    <FormLabel target="tla">TLA</FormLabel>
                    <FormInput id="tla" v-model="form.tla" maxlength="3" required/>
                </FormGroup>
            </div>
            <p class="md:text-right mb-4">
                The TLA will be shown on the season standings page, so make sure it's unique within the season
            </p>

            <div class="md:flex gap-x-0 md:gap-x-4">
                <FormGroup class="w-full md:w-6/12 lg:w-4/12">
                    <FormLabel target="car">Car</FormLabel>
                    <FormSelect id="car" v-model="form.car_id" required>
                        <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
                    </FormSelect>
                </FormGroup>

                <FormGroup class="w-full md:w-6/12 lg:w-4/12">
                    <FormLabel target="track">Track</FormLabel>
                    <FormSelect id="track" v-model="selectedTrackId">
                        <option v-for="track in tracks" :key="track.id" :value="track.id">{{ track.name }}</option>
                    </FormSelect>
                </FormGroup>

                <FormGroup class="w-full md:w-6/12 lg:w-4/12">
                    <FormLabel target="track_variation">Track variation</FormLabel>
                    <FormSelect id="track_variation" v-model="form.track_variation_id"
                                :disabled="selectedTrack === ''" required
                    >
                        <option v-for="variation in variations" :key="variation.id" :value="variation.id">
                            {{ variation.name }}
                        </option>
                    </FormSelect>
                </FormGroup>
            </div>

            <div class="flex gap-x-1 md:gap-x-4">
                <FormGroup class="w-6/12">
                    <FormLabel target="start_date">Start date</FormLabel>
                    <FormInput type="date" id="start_date" v-model="form.starts_at" required/>
                </FormGroup>

                <FormGroup class="w-6/12">
                    <FormLabel target="end_date">End date</FormLabel>
                    <FormInput type="date" id="end_date" v-model="form.ends_at" required/>
                </FormGroup>
            </div>

            <FormGroup>
                <FormLabel target="notes">Round notes</FormLabel>
                <FormTextArea v-model="form.notes" id="notes"></FormTextArea>
            </FormGroup>

            <CustomButton label="Save"/>
        </form>
    </Card>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, ref, watch } from 'vue';
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import Card from '@/Components/Card.vue';
import CustomButton from '@/Components/CustomButton.vue';
import FormGroup from '@/Components/Forms/FormGroup.vue';
import FormLabel from '@/Components/Forms/FormLabel.vue';
import FormInput from '@/Components/Forms/FormInput.vue';
import FormSelect from '@/Components/Forms/FormSelect.vue';
import FormTextArea from '@/Components/Forms/FormTextArea.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
    tracks: {
        type: Array,
        required: true,
    },
    cars: {
        type: Array,
        required: true,
    },
});

const selectedTrack = ref(props.tracks[0]);
const selectedTrackId = ref(selectedTrack.value.id);
const variations = ref(selectedTrack.value.variations);

const form = useForm({
    name: '',
    tla: '',
    car_id: props.cars[0].id,
    track_variation_id: variations.value[0].id,
    starts_at: '',
    ends_at: '',
    notes: '',
});

const formValid = computed(() => {
    return form.name.length >= 3
        && form.tla.length === 3
        && form.car_id !== ''
        && form.track_variation_id !== ''
        && form.starts_at !== ''
        && form.ends_at !== '';
});

watch(selectedTrackId, (trackId) => {
    if (! trackId) {
        variations.value = [];
        return;
    }

    const selectedTrack = props.tracks.find((t) => t.id === trackId);
    variations.value = selectedTrack.variations;
    form.track_variation_id = variations.value[0].id;
});
</script>
