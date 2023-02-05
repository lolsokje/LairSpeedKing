<template>
    <BackToOverviewButton :link="route('index')"/>

    <Header :text="season.name + ' standings'"/>
    <CustomTable>
        <TableHead>
            <tr>
                <TableHeader>#</TableHeader>
                <TableHeader/>
                <TableHeader left>Driver</TableHeader>
                <TableHeader v-for="(round, index) in season.rounds" :key="round.id">
                    <InertiaLink :href="route('times.show', [round])"
                                 class="text-secondary hover:text-secondary-hover active:text-secondary-active"
                    >
                        {{ getColumnHeader(round, index) }}
                    </InertiaLink>
                </TableHeader>
                <TableHeader>Total</TableHeader>
                <TableHeader>Gap</TableHeader>
            </tr>
        </TableHead>
        <TableBody>
            <tr v-for="(result, key) in standings" :key="key" class="align-middle">
                <TableCell class="text-center">{{ key + 1 }}</TableCell>
                <TableCell unpadded>
                    <img :src="result.avatar" height="50" width="50" alt="" class="rounded-full"
                         v-if="result.avatar"
                    >
                </TableCell>
                <TableCell>{{ result.username }}</TableCell>
                <TableCell class="text-center" v-for="round in season.rounds" :key="round.id">
                    {{ result.rounds[round.id] }}
                </TableCell>
                <TableCell class="text-center">{{ result.total }}</TableCell>
                <TableCell class="text-center">{{ getGap(result.total) }}</TableCell>
            </tr>
        </TableBody>
    </CustomTable>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import CustomTable from '@/Components/CustomTable.vue';
import TableHead from '@/Components/TableHead.vue';
import TableHeader from '@/Components/TableHeader.vue';
import TableBody from '@/Components/TableBody.vue';
import TableCell from '@/Components/TableCell.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
    standings: {
        type: Array,
        required: true,
    },
});

const getColumnHeader = (round, index) => {
    return round.tla === '' ? index + 1 : round.tla;
};

const getGap = (total) => {
    const leaderTotal = props.standings[0].total;

    return leaderTotal === total ? '' : `-${leaderTotal - total}`;
};
</script>
