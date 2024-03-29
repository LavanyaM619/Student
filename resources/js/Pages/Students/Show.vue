<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Students" />

        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                View Student
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8"
                >
                    <form
                        @submit.prevent="submit"
                        enctype="multipart/form-data"
                        style="text-align: center"
                    >
                        <div class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    ref="nameInput"
                                    v-model="form.name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="name-input"
                                    readonly
                                    style="border: none; text-align: center"
                                />

                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2"
                                />
                            </div>
                            <div style="text-align: center">
                                <img
                                    :src="'/' + student.image"
                                    alt="Student Image"
                                    style="display: block; margin: 0 auto"
                                />
                            </div>

                            <div>
                                <InputLabel for="age" value="Age" />

                                <TextInput
                                    id="age"
                                    ref="ageInput"
                                    v-model="form.age"
                                    type="number"
                                    class="mt-1 block w-full"
                                    autocomplete="age-input"
                                    style="border: none; text-align: center"
                                    readonly
                                />

                                <InputError
                                    :message="form.errors.age"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="status" value="Status" />

                                <PrimaryButton
                                    :style="`background-color: ${
                                        form.status ? 'green' : '#c35c17'
                                    }; color: white; width: 100px; height: 30px; text-align: center; font-size: 12px;`"
                                >
                                    {{ form.status ? "Active" : "Inactive" }}
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
    },
    props: {
        student: Object,
    },
    data() {
        return {
            form: useForm(this.student),
        };
    },
    methods: {},
};
</script>
