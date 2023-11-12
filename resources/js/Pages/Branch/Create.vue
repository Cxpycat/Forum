<template>
    <div>
        <div class="flex items-center mb-4">
            <h3 class="text-xl mr-4">Добавить ветку</h3>
        </div>
        <div>
            <div class="mb-4" v-if="sections.length > 0">
                <select @change="getBranches" class="border-gray-300 p-2 w-1/4" v-model="section_id">
                    <option value="null" selected disabled>Выберите раздел</option>
                    <template v-for="section in sections">
                        <template v-if="this.$page.props.auth.roles.some(code => {
                                                    return [
                                                        `editor`,
                                                        `editor.${section.id}`,
                                                    ].includes(code)
                                                })">
                            <option :value="section.id">{{ section.title }}</option>
                        </template>
                    </template>
                </select>
                <div v-if="this.$page.props.errors.section_id" class="text-sm text-red-600">
                    {{ this.$page.props.errors.section_id }}
                </div>
            </div>
            <div class="mb-4" v-if="branches.length > 0">
                <select class="border-gray-300 p-2 w-1/4" v-model="parent_id">
                    <option value="null" selected disabled>Выберите ветку</option>
                    <option v-for="branch in branches" :value="branch.id">{{ branch.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <input type="text" placeholder="Заголовок" v-model="title" class="border-gray-300 p-2 w-1/4">
                <div v-if="this.$page.props.errors.title" class="text-sm text-red-600">
                    {{ this.$page.props.errors.title }}
                </div>
            </div>
            <div>
                <a class="block w-1/4 py-2 bg-sky-500 border border-sky-600 text-white text-center"
                   @click.prevent="store" href="#">Добавить</a>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import {Link} from '@inertiajs/vue3';

export default {
    name: 'Create',

    props: ['sections'],

    data() {
        return {
            title: '',
            section_id: null,
            parent_id: null,
            branches: [],
        };
    },

    components: {
        Link,
    },

    methods: {
        store() {
            this.$inertia.post('/branches', {
                section_id: this.section_id,
                parent_id: this.parent_id,
                title: this.title,
            });
        },

        getBranches() {
            this.parent_id = null;
            axios.get(`/sections/${this.section_id}/branches`).then(res => {
                this.branches = res.data;
            });
        },
    },

    layout: MainLayout,
};
</script>

<style scoped>

</style>
