<template>
    <Head>
        <title>Student Profile</title>
    </Head>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
                        <p class="text-gray-500 text-sm mt-2">Manage your account preferences and information</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            Active Student
                        </span>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <nav class="bg-white rounded-xl shadow-md mb-8">
                <div class="flex space-x-8 px-6">
                    <button
                        v-for="tab in tabs"
                        :key="tab"
                        @click="selectedTab = tab"
                        class="px-4 py-3 font-medium text-sm focus:outline-none whitespace-nowrap transition-colors duration-200"
                        :class="[
                            selectedTab === tab
                                ? 'border-b-2 border-indigo-500 text-indigo-600'
                                : 'text-gray-500 hover:text-gray-700 hover:border-gray-300'
                        ]"
                    >
                        {{ tab }}
                    </button>
                </div>
            </nav>

            <!-- Tab Panels -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <!-- Account Information Panel -->
                <div v-if="selectedTab === 'Account Information'" class="space-y-8">
                    <!-- Avatar Section -->
                    <div class="flex items-center space-x-8">
                        <div class="relative">
                            <img
                                :src="avatarPreview || profile.account_info.avatar || 'https://via.placeholder.com/150'"
                                alt="Avatar"
                                class="w-24 h-24 rounded-full object-cover border-2 border-gray-200"
                            />
                            <label
                                for="avatar-upload"
                                class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-md cursor-pointer hover:bg-gray-50 transition-colors"
                            >
                                <input
                                    id="avatar-upload"
                                    type="file"
                                    accept="image/*"
                                    @change="handleAvatarUpload"
                                    class="hidden"
                                />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </label>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Upload a new avatar</p>
                            <p class="text-xs text-gray-400">Recommended size: 150x150px</p>
                        </div>
                    </div>

                    <!-- Basic Info and Personal Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Basic Info -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-6">Basic Info</h3>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input
                                        v-model="form.name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input
                                        v-model="form.email"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Personal Details -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-6">Personal Details</h3>
                            <div class="space-y-6">
                                <div v-for="(value, key) in profile.account_info.personal_details" :key="key">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ key.replace('_', ' ') }}
                                    </label>
                                    <input
                                        v-model="form.personal_details[key]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex justify-end">
                        <button
                            @click="saveChanges"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
                <!-- Program Details Panel -->
                <div v-if="selectedTab === 'Program Details'" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Enrollment Status -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-gray-900">Enrollment Status</h3>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                    {{ profile.program_details.status }}
                                </span>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm text-gray-500">Student ID</label>
                                    <p class="text-gray-900">{{ profile.program_details.student_id }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Enrolled Since</label>
                                    <p class="text-gray-900">{{ profile.program_details.enrollment_date }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Performance -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-gray-900">Academic Performance</h3>
                                <span
                                    class="text-2xl font-semibold"
                                    :class="{
                                        'text-green-600': profile.program_details.CGPA >= 3.5,
                                        'text-yellow-600': profile.program_details.CGPA >= 2.5 && profile.program_details.CGPA < 3.5,
                                        'text-red-600': profile.program_details.CGPA < 2.5
                                    }"
                                >
                                    {{ profile.program_details.CGPA }}
                                </span>
                            </div>
                            <div class="relative pt-1">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span class="text-xs font-semibold inline-block text-gray-600">
                                            CGPA Progress
                                        </span>
                                    </div>
                                </div>
                                <div class="flex h-2 mb-4 overflow-hidden bg-gray-200 rounded">
                                    <div
                                        class="transition-all duration-500 ease-in-out"
                                        :class="{
                                            'bg-green-500': profile.program_details.CGPA >= 3.5,
                                            'bg-yellow-500': profile.program_details.CGPA >= 2.5 && profile.program_details.CGPA < 3.5,
                                            'bg-red-500': profile.program_details.CGPA < 2.5
                                        }"
                                        :style="{ width: `${(profile.program_details.CGPA / 4) * 100}%` }"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Password & Security Panel -->
                <div v-if="selectedTab === 'Password & Security'" class="space-y-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Change Password</h3>
                        <ErrorModal
                            :isOpen="isErrorModalOpen"
                            :errorMessage="errorMessage"
                            @close="isErrorModalOpen = false"
                        />
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input
                                    type="password"
                                    v-model="form.oldPassword"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                />
                                <div v-if="$page.props.errors.oldPassword" class="text-red-500 text-sm mt-1">
                                    {{ $page.props.errors.oldPassword }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input
                                    type="password"
                                    v-model="form.newPassword"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                />
                                <div v-if="$page.props.errors.newPassword" class="text-red-500 text-sm mt-1">
                                    {{ $page.props.errors.newPassword }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input
                                    type="password"
                                    v-model="form.newPassword_confirmation"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                />
                                <div v-if="$page.props.errors.newPassword_confirmation"
                                     class="text-red-500 text-sm mt-1">
                                    {{ $page.props.errors.newPassword_confirmation }}
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors"
                                    @click="changePassword"
                                >
                                    Update Password
                                </button>
                            </div>
                            <!-- Display success message -->
                            <div v-if="$page.props.flash.success" class="text-green-500 text-sm mt-4">
                                {{ $page.props.flash.success }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ErrorModal from '@/Components/ErrorModal.vue';

export default {
    layout: AppLayout,
    components: {
        Head,
        ErrorModal,
    },
    props: {
        profile: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            name: props.profile.account_info.name,
            email: props.profile.account_info.email,
            personal_details: props.profile.account_info.personal_details,
            oldPassword: null,
            newPassword: null,
            newPassword_confirmation: null,
            avatar: null,
        });

        return {form};
    },
    data() {
        return {
            tabs: ['Account Information', 'Program Details', 'Password & Security'],
            selectedTab: 'Account Information',
            avatarPreview: null,
            avatarFile: null,
            isErrorModalOpen: false,
            errorMessage: '',
        };
    },
    methods: {
        handleAvatarUpload(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) { // 2MB limit
                    alert('File size must be less than 2MB.');
                    return;
                }
                if (!file.type.startsWith('image/')) {
                    alert('Please upload a valid image file.');
                    return;
                }
                this.avatarFile = file;
                this.avatarPreview = URL.createObjectURL(file);
                this.form.avatar = file;
            } else {
                console.error('No file selected.');
            }
        },
        saveChanges() {
            this.form.post(route('update-info', {user: this.profile.id}), {
                preserveScroll: true,
                onSuccess: () => {
                    alert('Profile updated successfully!');
                },
                onError: (errors) => {
                    alert('An error occurred. Please check the form and try again.');
                },
            });
        },
        changePassword() {
            if (!this.form.oldPassword || !this.form.newPassword || !this.form.newPassword_confirmation) {
                this.errorMessage = 'Please fill in all password fields.';
                this.isErrorModalOpen = true;
                return;
            }

            if (this.form.newPassword.length < 8) {
                this.errorMessage = 'New password must be at least 8 characters long.';
                this.isErrorModalOpen = true;
                return;
            }

            if (this.form.newPassword !== this.form.newPassword_confirmation) {
                this.errorMessage = 'New passwords do not match.';
                this.isErrorModalOpen = true;
                return;
            }

            this.form.newPassword = this.form.newPassword.trim();
            this.form.newPassword_confirmation = this.form.newPassword_confirmation.trim();

            this.form.post(route('profile.user.passwordUpdate', {user: this.profile.id}), {
                preserveScroll: true,
                onSuccess: () => {
                    alert('Password updated successfully!');
                },
                onError: (errors) => {
                    this.errorMessage = errors.newPassword || 'An error occurred. Please check the form and try again.';
                    this.isErrorModalOpen = true;
                },
            });
        }
    }
}
</script>
<style>
.error-message {
    color: red;
}

.success-message {
    color: green;
}
</style>
