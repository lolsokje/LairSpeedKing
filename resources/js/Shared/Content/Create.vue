<template>
    <Card>
        <form @submit.prevent="form.post(route(`admin.${type}.store`))">
            <div v-if="form.errors">
                <p class="text-danger" v-for="error in form.errors">{{ error }}</p>
            </div>
            <FormGroup>
                <FormLabel target="name">Name</FormLabel>
                <FormInput id="name" v-model="form.name" required/>
            </FormGroup>

            <FormGroup>
                <FormLabel target="content_type">Content type</FormLabel>
                <FormSelect id="content_type" v-model="form.content_type" required>
                    <option v-for="(content_type, key) in content_types" :value="parseInt(key)">
                        {{ content_type }}
                    </option>
                </FormSelect>
            </FormGroup>

            <FormGroup v-if="form.content_type > 1">
                <FormLabel for="link">Download/Purchase link</FormLabel>
                <FormInput id="link" class="form-control" v-model="form.link"/>
            </FormGroup>

            <CustomButton v-if="formValid" label="Save"/>
        </form>
    </Card>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import Card from '@/Components/Card.vue';
import FormGroup from '@/Components/Forms/FormGroup.vue';
import FormLabel from '@/Components/Forms/FormLabel.vue';
import FormInput from '@/Components/Forms/FormInput.vue';
import FormSelect from '@/Components/Forms/FormSelect.vue';
import CustomButton from '@/Components/CustomButton.vue';

const props = defineProps({
    type: {
        type: String,
        required: true,
    },
    content_types: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: '',
    content_type: 1,
    link: '',
});

const formValid = computed(() => {
    if (form.content_type === 1) {
        return form.name.length >= 3;
    } else {
        return form.name.length >= 3 && form.link.length >= 3;
    }
});
</script>

<script>
export default { name: 'ContentCreate' };
</script>
