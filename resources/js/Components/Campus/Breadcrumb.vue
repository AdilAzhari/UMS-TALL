<!-- Breadcrumbs.vue -->
<template>
    <nav
        aria-label="breadcrumb"
        class="max-w-screen-xl mx-auto py-4 px-6"
    >
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl shadow-sm border border-gray-100 p-4">
            <ol class="flex items-center flex-wrap gap-2">
                <li
                    v-for="(crumb, index) in breadcrumbs"
                    :key="index"
                    class="flex items-center"
                >
                    <template v-if="index > 0">
            <span class="mx-3 text-gray-300">
              <i class="fas fa-chevron-right text-xs"></i>
            </span>
                    </template>

                    <router-link
                        v-if="crumb.path"
                        :to="crumb.path"
                        class="text-blue-600 hover:text-blue-800 transition-colors duration-200 flex items-center"
                    >
                        <i v-if="index === 0" class="fas fa-home mr-2"></i>
                        {{ crumb.label }}
                    </router-link>
                    <span
                        v-else
                        class="text-gray-600 font-medium flex items-center"
                    >
            {{ crumb.label }}
          </span>
                </li>
            </ol>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Breadcrumbs',
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
            default: () => [
                { label: 'Home', path: '/' },
                { label: 'Dashboard', path: '/dashboard' },
                { label: 'Profile' }
            ]
        }
    },
    watch: {
        $route() {
            this.updateBreadcrumbs();
        }
    },
    methods: {
        updateBreadcrumbs() {
            const routeName = this.$route.name;
            const dynamicBreadcrumbs = {
                assignments: [
                    { label: 'Home', path: '/' },
                    { label: 'Courses', path: '/courses' },
                    { label: 'Assignments' }
                ],
                announcements: [
                    { label: 'Home', path: '/' },
                    { label: 'Courses', path: '/courses' },
                    { label: 'Announcements' }
                ],
                profile: [
                    { label: 'Home', path: '/' },
                    { label: 'Profile' }
                ]
            };
            this.breadcrumbs = dynamicBreadcrumbs[routeName] || [{ label: 'Home', path: '/' }];
        }
    },
    mounted() {
        this.updateBreadcrumbs();
    }
}
</script>
