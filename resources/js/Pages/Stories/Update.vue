<template>
    <div v-if="form">
        <!-- Title -->
        <div class="relative mb-4">
            <input
                v-model="form.title"
                class="peer w-full px-4 py-3 border rounded-md border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300"
                placeholder=" "
                required
                type="text"
            />
            <label
                class="absolute left-4 top-3 text-gray-500 transition-all duration-300
                       peer-placeholder-shown:top-4 peer-placeholder-shown:text-base
                       peer-focus:-top-2 peer-focus:text-sm peer-focus:text-indigo-500"
                for="title"
            >
                Story Title
            </label>
            <span v-if="errors.title" class="text-red-500 text-sm mt-1">{{ errors.title }}</span>
        </div>

        <!-- Content (Rich Text Editor) -->
        <div class="relative mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2" for="content">
                Your Story
            </label>
            <div id="editor"
                 class="h-48 bg-gray-50 rounded-md border border-gray-300 shadow-inner p-2 focus:outline-none"></div>
            <span v-if="errors.content" class="text-red-500 text-sm mt-1">{{ errors.content }}</span>
        </div>

        <!-- Published (Radio Buttons) -->
        <div class="relative mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Publish Status</label>
            <div class="flex items-center space-x-6">
                <label class="flex items-center space-x-2">
                    <input v-model="form.status" class="text-indigo-500" type="radio" value="published"/>
                    <span class="text-gray-600">Published</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input v-model="form.status" class="text-red-500" type="radio" value="draft"/>
                    <span class="text-gray-600">Draft</span>
                </label>
            </div>
            <span v-if="errors.status" class="text-red-500 text-sm mt-1">{{ errors.status }}</span>
        </div>

        <!-- Image Upload -->
        <div class="relative mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload an Image</label>
            <div class="flex items-center justify-center">
                <label
                    class="relative flex flex-col items-center justify-center w-full p-6 border-2 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300">
                    <div v-if="!previewImage" class="flex flex-col items-center">
                        <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <p class="text-sm text-gray-500">Click to upload an image</p>
                    </div>
                    <img v-else :src="previewImage" alt="Preview" class="w-32 h-32 object-cover rounded-md shadow-lg"/>
                    <input accept="image/*" class="absolute inset-0 opacity-0" type="file" @change="handleFileUpload"/>
                </label>
            </div>
            <span v-if="errors.image" class="text-red-500 text-sm mt-1">{{ errors.image }}</span>
        </div>

        <!-- Submit Button -->
        <button
            class="w-full py-3 mt-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300"
            type="submit"
            @click="updateStory"
        >
            Update Story
        </button>
    </div>
</template>

<script>
import appLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {nextTick, onMounted, ref} from "vue";
import Quill from "quill";

export default {
    layout: appLayout,
    props: {
        story: {
            type: Object,
            required: true,
        },
        errors: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const form = ref(null);
        const previewImage = ref(props.story.image || "");

        // Initialize the form with existing data
        if (props.story) {
            form.value = useForm({
                title: props.story.title || '',
                content: props.story.content || '',
                status: props.story.status || 'draft',
                image: props.story.image || '',
            });
        }

        // Initialize Quill Editor
        onMounted(async () => {
            await nextTick(() => {
                if (form.value) {
                    form.value.contentEditor = new Quill("#editor", {
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

                    // Load content into the Quill editor
                    if (props.story.content) {
                        form.value.contentEditor.root.innerHTML = props.story.content;
                    }
                }
            });
        });

        // Handle file upload
        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.value = e.target.result;
                    form.value.image = file;
                };
                reader.readAsDataURL(file);
            }
        };

        // Update story
        const updateStory = () => {
            // Save the content from the Quill editor to the form data
            if (form.value && form.value.contentEditor) {
                form.value.content = form.value.contentEditor.root.innerHTML;
            }

            // Make the PUT request
            form.value.put(route("stories.update", props.story.id), {
                onError: (errors) => {
                    console.log("Error:", errors); // Handle errors here
                },
                onSuccess: () => {
                    console.log("Story updated successfully!");
                },
            });
        };

        return {
            form,
            previewImage,
            handleFileUpload,
            updateStory,
        };
    },
};
</script>

<style scoped>
#editor {
    height: 300px;
    font-size: 16px;
}

button[type="submit"] {
    background-color: #4f46e5;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #3730a3;
}
</style>
