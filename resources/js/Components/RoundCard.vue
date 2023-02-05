<template>
    <Card :size="CardSize.SMALL">
        <h4>{{ round.name }}</h4>
        <p class="text-slate-500 mb-4">
            {{ round.date_range }} -
            <InertiaLink :href="route('rounds.notes', [round])" class="text-secondary hover:text-secondary-hover">
                view notes
            </InertiaLink>
        </p>
        <ul>
            <li v-if="round.status !== 'Pending'">
                <span class="font-bold">Car</span>
                <p class="mb-0">
                    {{ round.car.name }}
                    <span v-if="showCallToAction(round.car.content_type)">
                        - <a :href="round.car.link" class="text-secondary hover:text-secondary-hover" target="_blank">
                            {{ callToActionLabel(round.car.content_type) }}
                        </a>
                    </span>
                </p>
            </li>
            <li class="mt-4">
                <span class="font-bold">Track</span>
                <p class="mb-0">
                    {{ round.variation.track.name }}
                    <span v-if="showCallToAction(round.variation.track.content_type)">
                        - <a :href="round.variation.track.link"
                             class="text-secondary hover:text-secondary-hover"
                             target="_blank"
                    >
                            {{ callToActionLabel(round.variation.track.content_type) }}
                        </a>
                    </span>
                </p>
            </li>
            <li class="mt-4">
                <span class="font-bold">Variation</span>
                <p class="mb-0"> {{ round.variation.name }} </p>
            </li>
        </ul>

        <div class="flex justify-between mt-4">
            <ButtonLink v-if="hasResults" :href="route('times.show', [round])" label="Results"/>
            <ButtonLink v-if="canSubmit" :href="route('times.create', [round])" label="Submit time" secondary/>
        </div>

        <template #footer>
            <CardStatusFooter :status="round.status"/>
        </template>
    </Card>
</template>

<script setup>
import ContentType from '@/ContentType';
import Card from '@/Components/Card.vue';
import CardSize from '@/Enums/CardSize.js';
import CardStatusFooter from '@/Components/CardStatusFooter.vue';
import ButtonLink from '@/Components/ButtonLink.vue';

const props = defineProps({
    round: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
        required: false,
        default: null,
    },
});

const canSubmit = props.user && props.round.status === 'Active';
const hasResults = props.round.status === 'Active' || props.round.status === 'Completed';

const showCallToAction = (type) => {
    return type !== ContentType.BASE;
};

const callToActionLabel = (type) => {
    if (type === ContentType.DLC) {
        return 'purchase';
    }

    if (type === ContentType.MOD) {
        return 'download';
    }
};
</script>

<script>
export default { name: 'RoundCard' };
</script>
