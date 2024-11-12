<template>
    <AppLayout>
        <!-- Animated Header Banner with Gradient -->
        <div
            class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-purple-800"
        >
            <div class="absolute inset-0">
                <div
                    class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=&#34;30&#34; height=&#34;30&#34; viewBox=&#34;0 0 60 60&#34; xmlns=&#34;http://www.w3.org/2000/svg&#34;%3E%3Cg fill=&#34;none&#34; fill-rule=&#34;evenodd&#34;%3E%3Cg fill=&#34;%23ffffff&#34; fill-opacity=&#34;0.1&#34;%3E%3Cpath d=&#34;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&#34;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"
                ></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
                <div class="flex items-center justify-between">
                    <div class="space-y-2">
                        <h1
                            class="text-3xl font-bold text-white tracking-tight"
                        >
                            Assign Proctor
                        </h1>
                        <p class="text-purple-100 text-lg">
                            Complete the form to assign a proctor for your exam
                        </p>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full border border-white/20"
                    >
                        <div class="flex items-center space-x-2">
                            <div class="flex space-x-1">
                                <div
                                    class="w-2 h-2 rounded-full"
                                    :class="[
                                        currentStep >= 1
                                            ? 'bg-white'
                                            : 'bg-white/40',
                                    ]"
                                ></div>
                                <div
                                    class="w-2 h-2 rounded-full"
                                    :class="[
                                        currentStep >= 2
                                            ? 'bg-white'
                                            : 'bg-white/40',
                                    ]"
                                ></div>
                            </div>
                            <span class="text-white text-sm font-medium"
                                >Step {{ currentStep }} of 2</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Container with Animation -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div
                class="bg-white rounded-xl shadow-xl overflow-hidden border border-purple-100 transition-all duration-500"
                :class="{
                    'opacity-0 translate-y-4': isLoading,
                    'opacity-100 translate-y-0': !isLoading,
                }"
            >
                <!-- Form Header -->
                <div
                    class="bg-gradient-to-r from-purple-50 to-purple-100/50 px-6 py-6 border-b border-purple-100"
                >
                    <h2 class="text-xl font-semibold text-purple-900">
                        Proctor Details Form
                    </h2>
                    <p class="text-sm text-purple-600 mt-1">
                        All fields marked with an asterisk (*) are required
                    </p>
                </div>

                <!-- Form Content -->
                <div class="p-6">
                    <form @submit.prevent="submitForm" class="space-y-8">
                        <!-- Step 1: Personal Information -->
                        <div v-show="currentStep === 1" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-6">
                                    <h3
                                        class="flex items-center text-lg font-medium text-gray-900"
                                    >
                                        <span
                                            class="flex items-center justify-center w-6 h-6 rounded-full bg-purple-100 text-purple-600 text-sm mr-2"
                                            >1</span
                                        >
                                        Personal Information
                                    </h3>

                                    <!-- Name Input -->
                                    <div class="relative group">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            Full Name
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.name"
                                                type="text"
                                                id="name"
                                                placeholder="Enter your full name"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="7"
                                                        r="4"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Email Input -->
                                    <div class="relative group">
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            Email Address
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.email"
                                                type="email"
                                                id="email"
                                                placeholder="Enter your email address"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                                    />
                                                    <polyline
                                                        points="22,6 12,13 2,6"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Phone Input -->
                                    <div class="relative group">
                                        <label
                                            for="phone"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            Phone Number
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.phone_number"
                                                type="tel"
                                                id="phone"
                                                placeholder="Enter your phone number"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right side illustration -->
                                <div
                                    class="hidden md:flex items-center justify-center"
                                >
                                    <div class="w-full max-w-sm p-8">
                                        <svg
                                            class="w-full h-auto text-purple-100"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M12 14c3.31 0 6-2.69 6-6s-2.69-6-6-6-6 2.69-6 6 2.69 6 6 6zm0-10c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0 12c-4.42 0-8 1.79-8 4v2h16v-2c0-2.21-3.58-4-8-4zm6 4H6v-.99c.2-.72 3.3-2.01 6-2.01s5.8 1.29 6 2v1z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Address Information -->
                        <div v-show="currentStep === 2" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-6">
                                    <h3
                                        class="flex items-center text-lg font-medium text-gray-900"
                                    >
                                        <span
                                            class="flex items-center justify-center w-6 h-6 rounded-full bg-purple-100 text-purple-600 text-sm mr-2"
                                            >2</span
                                        >
                                        Address Information
                                    </h3>

                                    <!-- Address Input -->
                                    <div class="relative group">
                                        <label
                                            for="address"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            Street Address
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.address"
                                                type="text"
                                                id="address"
                                                placeholder="Enter your street address"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="10"
                                                        r="3"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- City Input -->
                                    <div class="relative group">
                                        <label
                                            for="city"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            City
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.city"
                                                type="text"
                                                id="city"
                                                placeholder="Enter your city"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                                    />
                                                    <polyline
                                                        points="9 22 9 12 15 12 15 22"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- State Input -->
                                    <div class="relative group">
                                        <label
                                            for="state"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            State/Province
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.state"
                                                type="text"
                                                id="state"
                                                placeholder="Enter your state/province"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="7"
                                                        r="4"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Country Input -->
                                    <div class="relative group">
                                        <label
                                            for="country"
                                            class="block text-sm font-medium text-gray-700 mb-1"
                                        >
                                            Country
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                v-model="form.country"
                                                type="text"
                                                id="country"
                                                placeholder="Enter your country"
                                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                                required
                                            />
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                >
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="10"
                                                    />
                                                    <path
                                                        d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right side illustration for address step -->
                                <div
                                    class="hidden md:flex items-center justify-center"
                                >
                                    <div class="w-full max-w-sm p-8">
                                        <svg
                                            class="w-full h-auto text-purple-100"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"
                                            />
                                            <circle cx="12" cy="9" r="2.5" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div
                            class="flex justify-between pt-6 border-t border-gray-200"
                        >
                            <button
                                type="button"
                                v-if="currentStep === 2"
                                @click="currentStep = 1"
                                class="flex items-center px-6 py-3 text-sm font-medium text-purple-600 bg-purple-50 rounded-lg hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors"
                            >
                                <svg
                                    class="w-5 h-5 mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 19l-7-7 7-7"
                                    />
                                </svg>
                                Previous Step
                            </button>
                            <button
                                type="button"
                                v-if="currentStep === 1"
                                @click="currentStep = 2"
                                class="flex items-center px-6 py-3 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors"
                            >
                                Next Step
                                <svg
                                    class="w-5 h-5 ml-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </button>
                            <button
                                type="submit"
                                v-if="currentStep === 2"
                                :disabled="isSubmitting"
                                class="flex items-center px-6 py-3 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span v-if="!isSubmitting"
                                    >Submit Proctor Details</span
                                >
                                <span v-else class="flex items-center">
                                    <svg
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        />
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        />
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Success Message -->
            <div
                v-if="showSuccess"
                class="fixed bottom-4 right-4 bg-green-50 text-green-800 px-6 py-4 rounded-lg shadow-lg border border-green-200 transition-all duration-500 transform translate-y-0"
            >
                <div class="flex items-center space-x-2">
                    <svg
                        class="w-6 h-6 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                    <span class="font-medium"
                        >Form submitted successfully!</span
                    >
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    props: {
        courseID: {
            type: [String, Number],
            required: true,
        },
    },
    components: {
        AppLayout,
    },

    setup(props) {
        const currentStep = ref(1);
        const isSubmitting = ref(false);
        const showSuccess = ref(false);
        const isLoading = ref(true);

        const form = useForm({
            name: "",
            email: "",
            phone_number: "",
            address: "",
            city: "",
            state: "",
            country: "",
            courseID: props.courseID,
        });

        // Simulate loading state
        setTimeout(() => {
            isLoading.value = false;
        }, 500);

        const submitForm = () => {
            isSubmitting.value = true;
            form.post(`/assign/proctorForm/${props.courseID}`, {
                onSuccess: () => {
                    form.reset();
                    isSubmitting.value = false;
                    showSuccess.value = true;
                    currentStep.value = 1;
                    setTimeout(() => {
                        showSuccess.value = false;
                    }, 3000);
                },
                onError: () => {
                    isSubmitting.value = false;
                },
            });
        };

        return {
            form,
            submitForm,
            currentStep,
            isSubmitting,
            showSuccess,
            isLoading,
        };
    },
};
</script>

<style scoped>
.form-enter-active,
.form-leave-active {
    transition: opacity 0.5s ease;
}

.form-enter-from,
.form-leave-to {
    opacity: 0;
}

@keyframes slideIn {
    from {
        transform: translateY(100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.slide-in {
    animation: slideIn 0.5s ease-out;
}
</style>
