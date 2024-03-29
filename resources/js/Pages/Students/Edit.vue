<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Students" />

        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Update Students
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8"
                >
                  <form @submit.prevent="submit" enctype="multipart/form-data" >
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
                                />

                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <label for="image">Image</label>

                                <input
                                    id="image"
                                    name="image"
                                    ref="imageInput"
                                    type="file"
                                    class="mt-1 block w-full"
                                    autocomplete="image-input"
                                    @change="handleFileChange($event)"
                                />

                                <InputError
                                    :message="form.errors.image"
                                    class="mt-2"
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
                                />

                                <InputError
                                    :message="form.errors.age"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="status" value="Status" />

                                <input
                                    id="status"
                                    ref="statusInput"
                                    v-model="form.status"
                                    type="checkbox"
                                    class="mt-1 block w-full"
                                    autocomplete="status-input"
                                />

                                <InputError
                                    :message="form.errors.status"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        <div class="mt-8">
                            <PrimaryButton type="submit"
                                >Update Student</PrimaryButton
                            >
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
    }, props: {
        student: Object,
    },

    data() {
        return {
            form: useForm(this.student),
        };
    },
    methods: {

    
        // Function to handle file change event
       handleFileChange(event) {
    const file = event.target.files[0]; // Get the first file from the files array
    if (file) {
        this.form.image = file; // Store the file object in the form data
    } else {
        // Handle case where no file is selected (optional)
    }
},

        submit() {
            let formData = new FormData();
            formData.append("name", this.form.name);
      formData.append("image", this.form.image);
            formData.append("age", this.form.age);
            formData.append("status", this.form.status);

            this.form.put(route("students.update", this.student.id), formData, {
                preserveScroll: true,
              
               
            });
        },
    },
};
</script>