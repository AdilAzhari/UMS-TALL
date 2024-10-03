<template>
    <div>
      <!-- Use the layout component you created earlier -->
      <student-portal-layout>
        <template #header>
          <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ user.name }}</h1>
        </template>

        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-purple-700 mb-4">BACHELOR'S DEGREE IN {{ user.program }}</h2>

                <!-- Ready for Class Section -->
                <div class="mb-6">
                  <h3 class="text-xl font-semibold mb-2">READY FOR CLASS?</h3>
                  <p>Registration for new courses opens {{ registrationStart }} to {{ registrationEnd }}. Get ready for a great term!</p>
                </div>

                <!-- Academic Progress Section -->
                <div>
                  <h3 class="text-xl font-semibold mb-2">ACADEMIC PROGRESS</h3>
                  <p class="mb-4">Keep up the great work!</p>

                  <!-- Term Progress Bar -->
                  <div class="mb-4">
                    <div class="text-sm font-medium text-gray-700">Term Progress (weeks)</div>
                    <div class="mt-1 relative pt-1">
                      <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-purple-200">
                        <div :style="{ width: `${(currentWeek / totalWeeks) * 100}%` }" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-purple-500"></div>
                      </div>
                    </div>
                    <div class="text-right text-sm font-medium text-gray-700">{{ currentWeek }} / {{ totalWeeks }} weeks</div>
                  </div>

                  <!-- GPA and Credits -->
                  <div class="grid grid-cols-2 gap-4">
                    <div>
                      <div class="text-3xl font-bold text-purple-700">{{ user.gpa.toFixed(2) }}</div>
                      <div class="text-sm text-gray-500">Cumulative GPA</div>
                    </div>
                    <div>
                      <div class="text-3xl font-bold text-purple-700">{{ user.creditsEarned }}<span class="text-lg">/{{ user.totalCredits }}</span></div>
                      <div class="text-sm text-gray-500">Credits Earned</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </student-portal-layout>
    </div>
  </template>

  <script setup>
  import StudentPortalView from '@/Views/StudentPortal.vue';
  import { computed } from 'vue';

  // Props received from the server
  const props = defineProps({
    user: Object,
    academicProgress: Object,
    courses: Array,
  });

  // Computed properties
  const registrationStart = computed(() => new Date(props.academicProgress.registrationStart).toLocaleDateString());
  const registrationEnd = computed(() => new Date(props.academicProgress.registrationEnd).toLocaleDateString());
  const currentWeek = computed(() => props.academicProgress.currentWeek);
  const totalWeeks = computed(() => props.academicProgress.totalWeeks);
  </script>
