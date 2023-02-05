<template>
    <div v-if="!round">
        <Header text="No current round active"/>
    </div>
    <div v-else>
        <Header :text="'Submit a time for \'' + round.name + '\' in season \'' + round.season.name + '\''"/>

        <Card>
            <form @submit.prevent="form.post(route('times.store'))">
                <div v-if="form.errors">
                    <p class="text-danger" v-for="(error, key) in form.errors" :key="key">{{ error }}</p>
                </div>
                <FormGroup>
                    <FormLabel target="time">Time</FormLabel>
                    <FormInput id="time" v-model="form.lap_time" placeholder="m:ss.xxx" required/>
                    <p><small>Times must be submitted in the format "m:ss.xxx"</small></p>
                </FormGroup>

                <FormGroup>
                    <FormLabel target="video_url">Youtube video URL</FormLabel>
                    <FormInput id="video_url" v-model="form.video_url" required/>
                </FormGroup>

                <CustomButton type="submit" v-if="formValid" label="Save"></CustomButton>
            </form>
        </Card>
    </div>
</template>

<script setup>
import Header from '@/Shared/Header.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import Card from '@/Components/Card.vue';
import CustomButton from '@/Components/CustomButton.vue';
import FormGroup from '@/Components/Forms/FormGroup.vue';
import FormLabel from '@/Components/Forms/FormLabel.vue';
import FormInput from '@/Components/Forms/FormInput.vue';

const form = useForm({
    lap_time: '',
    video_url: '',
});

const props = defineProps({
    round: {
        type: Object,
        required: false,
        default: null,
    },
});

const formValid = computed(() => laptimeValid() && form.video_url.length >= 3);

const laptimeValid = () => {
    const lapTime = form.lap_time;
    const pattern = /\d{1,2}:\d{2}\.\d{3}/;
    const matches = lapTime.match(pattern);

    return matches && matches.length === 1 && matches[0] === lapTime;
};
</script>
