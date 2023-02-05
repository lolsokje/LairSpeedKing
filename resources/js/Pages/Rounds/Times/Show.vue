<template>
    <Header :text="'Lap times for \'' + round.name + '\''"/>

    <CustomTable>
        <TableHead>
            <tr>
                <TableHeader>POS</TableHeader>
                <TableHeader/>
                <TableHeader left>USER</TableHeader>
                <TableHeader>TIME</TableHeader>
                <TableHeader>GAP</TableHeader>
                <TableHeader>INTERVAL</TableHeader>
                <TableHeader>VIDEO</TableHeader>
                <TableHeader>POINTS</TableHeader>
            </tr>
        </TableHead>
        <TableBody>
            <tr v-for="(time, index) in times" :key="index">
                <TableCell center>{{ index + 1 }}</TableCell>
                <TableCell unpadded>
                    <img :src="time.user.avatar" height="50" width="50" alt="" class="rounded-full"
                         v-if="time.user.avatar"
                    >
                </TableCell>
                <TableCell>{{ time.user.username }}</TableCell>
                <TableCell center>{{ time.readable_lap_time }}</TableCell>
                <TableCell center>{{ calculateGap(time.lap_time) }}</TableCell>
                <TableCell center>{{ calculateInterval(index) }}</TableCell>
                <TableCell center>
                    <a :href="time.video_url"
                       class="text-secondary hover:text-secondary-hover active:text-secondary-active"
                       target="_blank"
                    >view</a>
                </TableCell>
                <TableCell center>{{ getPoints(index + 1) }}</TableCell>
            </tr>
        </TableBody>
    </CustomTable>
</template>

<script setup>
import Header from '@/Shared/Header.vue';
import CustomTable from '@/Components/CustomTable.vue';
import TableHead from '@/Components/TableHead.vue';
import TableHeader from '@/Components/TableHeader.vue';
import TableBody from '@/Components/TableBody.vue';
import TableCell from '@/Components/TableCell.vue';

const props = defineProps({
    round: {
        type: Object,
        required: true,
    },
    times: {
        type: Array,
        required: true,
    },
    points: {
        type: Array,
        required: true,
    },
});

const calculateGap = (lapTime) => {
    const times = props.times;
    const lapTimeToCompareTo = times[0].lap_time;

    if (lapTime === lapTimeToCompareTo) {
        return '-';
    } else {
        return parseLaptimes(lapTime, lapTimeToCompareTo);
    }
};

const calculateInterval = (index) => {
    if (index === 0) {
        return '-';
    }
    const times = props.times;
    const currentLaptime = times[index].lap_time;
    const previousLaptime = times[index - 1].lap_time;

    return parseLaptimes(currentLaptime, previousLaptime);
};

const getPoints = (position) => {
    const result = props.points.find((p) => p.position === position);
    return result ? result.points : 0;
};

const parseLaptimes = (lapTime, compareLapTime) => {
    const difference = Math.abs(lapTime - compareLapTime);
    const minutes = parseInt((difference / 60000) % 60);
    const seconds = `${parseInt((difference / 1000) % 60)}`.padStart(2, '0');
    const millis = `${difference % 1000}`.padStart(3, '0');

    return `+${minutes}:${seconds}.${millis}`;
};
</script>
