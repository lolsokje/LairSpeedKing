<template>
    <BackToOverviewButton :link="route('admin.seasons.rounds.index', [season])"/>

    <Header :text="'Times for ' + round.name"/>

    <div v-if="!route().current().includes('pending')">
        <input type="checkbox" class="form-check-inline" v-model="onlyPending" id="only_pending">
        <label for="only_pending" class="form-label">Show only pending laptimes</label>
    </div>

    <CustomTable>
        <TableHead>
            <tr>
                <TableHeader class="text-center">#</TableHeader>
                <TableHeader></TableHeader>
                <TableHeader left>User</TableHeader>
                <TableHeader>Time</TableHeader>
                <TableHeader>Video</TableHeader>
                <TableHeader>Status</TableHeader>
                <TableHeader class="w-2/12"></TableHeader>
            </tr>
        </TableHead>
        <TableBody>
            <tr v-for="(time, key) in times" :key="key" class="align-middle">
                <TableCell center>{{ key + 1 }}</TableCell>
                <TableCell unpadded><img :src="time.user.avatar" alt="" height="50" width="50" class="rounded-full">
                </TableCell>
                <TableCell>{{ time.user.username }}</TableCell>
                <TableCell center>{{ time.readable_lap_time }}</TableCell>
                <TableCell center>
                    <a :href="time.video_url"
                       class="text-secondary hover:text-secondary-hover active:text-secondary-active"
                       target="_blank"
                    >view</a>
                </TableCell>
                <TableCell center>
                    <StatusBadge :status="time.status_text"/>
                </TableCell>
                <TableCell class="px-6" center>
                    <div class="flex justify-between">
                        <CustomButton type="button"
                                      v-if="canBeApproved(time)"
                                      @click="approve(time)"
                                      label="approve"
                                      success
                                      small
                        />
                        <CustomButton type="button"
                                      v-if="canBeDenied(time)"
                                      @click="deny(time)"
                                      label="deny"
                                      danger
                                      small
                        />
                    </div>
                </TableCell>
            </tr>
        </TableBody>
    </CustomTable>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import { Inertia } from '@inertiajs/inertia';
import LapTimeStatus from '@/LapTimeStatus';
import { ref, watch } from 'vue';
import CustomTable from '@/Components/CustomTable.vue';
import TableHead from '@/Components/TableHead.vue';
import TableHeader from '@/Components/TableHeader.vue';
import TableBody from '@/Components/TableBody.vue';
import TableCell from '@/Components/TableCell.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import CustomButton from '@/Components/CustomButton.vue';

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
    round: {
        type: Object,
        required: true,
    },
    times: {
        type: Array,
        required: true,
    },
});

const pendingParam = (new URLSearchParams(window.location.search)).get('pending_only');
const onlyPending = ref(pendingParam);

const approve = (time) => {
    handleStatusChange('admin.seasons.rounds.times.approve', time);
};

const deny = (time) => {
    handleStatusChange('admin.seasons.rounds.times.deny', time);
};

const handleStatusChange = (routeName, time) => {
    const routeToCall = route(routeName, [ props.season, props.round, time ]);

    Inertia.patch(routeToCall);
};

const canBeApproved = (time) => time.status === LapTimeStatus.SUBMITTED || time.status === LapTimeStatus.DENIED;
const canBeDenied = (time) => time.status === LapTimeStatus.SUBMITTED || time.status === LapTimeStatus.APPROVED;

const statusColourClass = (status) => {
    if (status === LapTimeStatus.SUBMITTED || status === LapTimeStatus.UPDATED) {
        return 'bg-warning text-black';
    }

    if (status === LapTimeStatus.APPROVED) {
        return 'bg-success text-black';
    }

    if (status === LapTimeStatus.DENIED) {
        return 'bg-danger';
    }
};

watch(onlyPending, (checked) => {
    Inertia.get(route('admin.seasons.rounds.times.index', [ props.season, props.round ]), {
        only_pending: checked,
    }, {
        preserveState: true,
        only: [ 'times' ],
    });
});
</script>
