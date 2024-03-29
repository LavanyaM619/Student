<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Students" />

        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Students
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('students.create')">
                        <PrimaryButton>Create Student</PrimaryButton>
                    </Link>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <table class="w-full text-center">
                        <tr>
                            <th class="text-black p-4">ID</th>

                            <th class="text-black p-4">Name</th>
                            <th class="text-black p-4">Age</th>
                            <th class="text-black p-4">Status</th>
                            <th class="text-black p-4">Actions</th>
                        </tr>
                        <tr v-for="item in students.data" :key="item.id">
                            <td class="text-black px-4 py-2">{{ item.id }}</td>
                            <td class="text-black px-4 py-2">
                                {{ item.name }}
                            </td>

                            <td class="text-black px-4 py-2">{{ item.age }}</td>

                            <td class="text-white px-4 py-2 space-x-4 text-center">
                                <PrimaryButton
                                    :style="`background-color: ${
                                        item.status ? 'green' : '#c35c17'
                                    }; color: white; width: 100px; height: 30px; text-align: center; font-size: 12px;`"
                                >
                                    {{ item.status ? "Active" : "Inactive" }}
                                </PrimaryButton>
                            </td>

                            <td
                                class="text-white px-4 py-2 space-x-4 text-center"
                            >
                                <Link :href="route('students.show', item.id)">
                                    <PrimaryButton>Show</PrimaryButton>
                                </Link>

                                <Link :href="route('students.edit', item.id)">
                                    <PrimaryButton>Edit</PrimaryButton>
                                </Link>
                                <PrimaryButton
                                    @click="deleteItem(item)"
                                    style="background-color: red; color: white"
                                    >Delete</PrimaryButton
                                >
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <Link
                        v-if="students.prev_page_url"
                        :href="students.prev_page_url"
                        >Previous</Link
                    >
                    <Link
                        v-if="students.next_page_url"
                        :href="students.next_page_url"
                        >Next</Link
                    >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        students: Object,
    },
    data() {
        return {
            form: useForm({}),
        };
    },
    mounted() {},
    methods: {
        deleteItem(item) {
            this.form.delete(route("students.destroy", item.id), {
                preserveScroll: true,
                onSuccess: () => {},
                onError: () => {},
                onFinish: () => {},
            });
        },
    },
};
</script>
