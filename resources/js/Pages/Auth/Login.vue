<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
        onSuccess: () => {
            // window.location.href = route('student.portal');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="max-w-md mx-auto p-6 font-sans">
            <h1 class="text-2xl font-bold text-purple-900 mb-2">WELCOME TO YOUR PORTAL</h1>
            <p class="text-gray-600 mb-6">Log in to your account</p>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="email" value="Email address *" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Password *" />
                    <div class="relative">
                        <TextInput
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            class="mt-1 block w-full pr-10"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                        />
                        <button
                            type="button"
                            @click="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-purple-900"
                        >
                            {{ showPassword ? 'Hide' : 'Show' }}
                        </button>
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="remember"
                        v-model="form.remember"
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>

                <div class="flex items-center justify-between">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-purple-900 hover:underline"
                    >
                        Forgot your password?
                    </Link>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        LOG IN
                    </PrimaryButton>
                </div>
            </form>

            <div class="mt-6 text-center">
                <Link :href="route('password.request')" class="text-pink-500 font-bold block mb-2">
                    CAN'T ACCESS YOUR ACCOUNT?
                </Link>
                <p class="text-sm text-gray-600">
                    Not a current student or applicant?
                    <Link :href="route('register')" class="text-pink-500 font-bold">APPLY NOW</Link>
                </p>
            </div>
        </div>
    </GuestLayout>
</template>
