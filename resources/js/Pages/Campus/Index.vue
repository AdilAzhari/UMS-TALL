<template>
  <head>
    <title>
      ghee
    </title>
  </head>
  <div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 pl-4">My Registered Courses</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
          v-for="course in courses"
          :key="course.id"
          class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-2"
      >
        <router-link :to="`/campus/course/${course.id}`" class="block">
          <div v-if="course.image" class="h-48 w-full">
            <img
                :alt="course.name"
                :src="course.image"
                class="w-full h-full object-cover"
            />
          </div>
          <div v-else class="h-48 bg-gray-100 flex items-center justify-center">
            <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                  stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"/>
            </svg>
          </div>

          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              {{ course.name }}
            </h2>
            <div class="flex items-center text-gray-600 space-x-2">
              <span class="font-medium text-sm bg-blue-50 px-2 py-1 rounded">
                {{ course.code }}
              </span>
              <div class="flex items-center">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"/>
                </svg>
                <span>{{ course.term }}</span>
              </div>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CourseList',
  data() {
    return {
      courses: [
        {
          id: 1,
          name: "Data Mining and Machine Learning",
          code: "CS 4407-01",
          term: "AY2025-T2",
          image: "/images/data-mining.png",
        },
        {
          id: 2,
          name: "Analysis of Algorithms",
          code: "CS 3304-01",
          term: "AY2025-T2",
          image: null,
        },
        {
          id: 3,
          name: "Learning Resource Center",
          code: "LRC-01",
          term: "AY2025-T2",
          image: "/images/resource-center.png",
        }
      ]
    }
  }
}
</script>

<style scoped>
/* Additional custom styles if needed */
</style>
