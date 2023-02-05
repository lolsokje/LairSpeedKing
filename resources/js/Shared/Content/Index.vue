<template>
    <CustomTable>
        <TableBody>
            <tr v-for="item in content" :key="item.id">
                <TableCell class="pl-6 w-9/12">{{ item.name }} - {{ item.content_type_name }}</TableCell>
                <TableCell class="w-1/12" center>
                    <InertiaLink :href="route(`admin.${type}.edit`, [item])">edit</InertiaLink>
                </TableCell>
                <TableCell class="w-1/12" center>
                    <InertiaLink :href="route(`admin.${type}.show`, [item])">view</InertiaLink>
                </TableCell>
                <TableCell v-if="has_variations" center>
                    <InertiaLink :href="route(`admin.${type}.variations.index`, [item])">variations</InertiaLink>
                </TableCell>
            </tr>
        </TableBody>
    </CustomTable>
</template>

<script setup>
import CustomTable from '@/Components/CustomTable.vue';
import TableBody from '@/Components/TableBody.vue';
import TableCell from '@/Components/TableCell.vue';

const props = defineProps({
    type: {
        type: String,
        required: true,
    },
    content: {
        type: Array,
        required: true,
    },
    has_variations: {
        type: Boolean,
        required: false,
        default: false,
    },
});
</script>

<script>
export default { name: 'ContentIndex' };
</script>
