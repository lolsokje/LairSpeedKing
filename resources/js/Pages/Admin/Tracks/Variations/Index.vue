<template>
    <BackToOverviewButton :link="route('admin.tracks.index')"/>

    <Header :text="'Manage track variations for ' + track.name"/>

    <ButtonLink :href="route('admin.tracks.variations.create', [track])" label="Add track variation"/>

    <CustomTable>
        <TableBody>
            <tr v-for="variation in variations" :key="variation.id" class="py-1">
                <TableCell class="pl-6 w-10/12">{{ variation.name }}</TableCell>
                <TableCell center>
                    <InertiaLink :href="route('admin.tracks.variations.edit', [track, variation])">edit
                    </InertiaLink>
                </TableCell>
                <TableCell center>
                    <InertiaLink :href="route('admin.tracks.variations.show', [track, variation])">view
                    </InertiaLink>
                </TableCell>
            </tr>
        </TableBody>
    </CustomTable>
</template>

<script setup>
import BackToOverviewButton from '@/Shared/BackToOverviewButton.vue';
import Header from '@/Shared/Header.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import CustomTable from '@/Components/CustomTable.vue';
import TableBody from '@/Components/TableBody.vue';
import TableCell from '@/Components/TableCell.vue';

const props = defineProps({
    track: {
        type: Object,
        required: true,
    },
    variations: {
        type: Array,
        required: true,
    },
});
</script>
