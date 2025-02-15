<template>
    <div
        class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8"
    >
        <div class="max-w-2xl w-full bg-white shadow-2xl rounded-xl p-8">
            <h1 class="text-center text-4xl font-bold text-indigo-700 mb-8">Create Your Story</h1>

            <form class="space-y-8" @submit.prevent="submit">
                <!-- Title -->
                <div class="relative">
                    <input
                        id="title"
                        v-model="form.title"
                        class="peer w-full px-4 py-3 border-2 rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none transition-all duration-300"
                        placeholder=" "
                        required
                        type="text"
                    />
                    <label
                        class="absolute left-4 top-3 text-gray-500 bg-white px-1 transition-all duration-300
                               peer-placeholder-shown:top-4 peer-placeholder-shown:text-base
                               peer-focus:-top-2 peer-focus:text-sm peer-focus:text-indigo-500"
                        for="title"
                    >
                        Story Title
                    </label>
                    <span v-if="errors.title" class="text-red-500 text-sm mt-1 block">{{ errors.title }}</span>
                </div>

                <!-- Content (Rich Text Editor) -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="content">
                        Your Story
                    </label>
                    <div
                        id="editor"
                        class="h-64 bg-gray-50 rounded-lg border-2 border-gray-200 shadow-inner p-4 focus:outline-none focus:border-indigo-500"
                    ></div>
                    <span v-if="errors.content" class="text-red-500 text-sm mt-1 block">{{ errors.content }}</span>
                </div>

                <!-- Published (Radio Buttons) -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Publish Status</label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center space-x-2">
                            <input
                                v-model="form.status"
                                class="text-indigo-500 focus:ring-indigo-500"
                                type="radio"
                                value="published"
                            />
                            <span class="text-gray-700">Published</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input
                                v-model="form.status"
                                class="text-red-500 focus:ring-red-500"
                                type="radio"
                                value="draft"
                            />
                            <span class="text-gray-700">Draft</span>
                        </label>
                    </div>
                    <span v-if="errors.status" class="text-red-500 text-sm mt-1 block">{{ errors.status }}</span>
                </div>

                <!-- Image Upload -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload an Image</label>
                    <div class="flex items-center justify-center">
                        <label
                            class="relative flex flex-col items-center justify-center w-full p-6 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300 border-gray-200"
                        >
                            <div v-if="!previewImage" class="flex flex-col items-center">
                                <svg
                                    class="w-10 h-10 text-gray-400 mb-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    ></path>
                                </svg>
                                <p class="text-sm text-gray-500">Click to upload an image</p>
                            </div>
                            <img
                                v-else
                                :src="previewImage"
                                alt="Preview"
                                class="w-32 h-32 object-cover rounded-lg shadow-lg"
                            />
                            <input
                                accept="image/*"
                                class="absolute inset-0 opacity-0"
                                type="file"
                                @change="handleFileUpload"
                            />
                        </label>
                    </div>
                    <span v-if="errors.image" class="text-red-500 text-sm mt-1 block">{{ errors.image }}</span>
                </div>

                <!-- Submit Button -->
                <button
                    class="w-full py-3 text-white font-semibold rounded-lg
                           bg-gradient-to-r from-indigo-600 to-purple-600
                           hover:from-indigo-700 hover:to-purple-700
                           transition-all duration-300
                           transform hover:scale-105
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    type="submit"
                >
                    Submit Story
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import Quill from "quill";
import "quill/dist/quill.snow.css";
import appLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: appLayout,
    setup() {
        const form = useForm({
            title: "",
            content: "",
            published: false,
            status: "",
            image: null,
        });

        const previewImage = ref(null);
        const editor = ref(null);

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            form.image = file;
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    previewImage.value = reader.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const submit = () => {
            // Retrieve the HTML content from Quill editor
            form.content = editor.value.root.innerHTML;

            form.post(route("stories.store"), {
                onError: (errors) => console.error(errors),
            });
        };

        onMounted(() => {
            editor.value = new Quill("#editor", {
                theme: "snow",
                placeholder: "Write your story here...",
                modules: {
                    toolbar: [
                        [{header: [1, 2, false]}],
                        ["bold", "italic", "underline"],
                        [{list: "ordered"}, {list: "bullet"}],
                        ["link", "image"],
                        ["clean"],
                    ],
                },
            });
        });

        return {
            form,
            previewImage,
            handleFileUpload,
            submit,
            errors: form.errors,
        };
    },
};
</script>
