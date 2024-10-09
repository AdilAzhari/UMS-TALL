import { createRouter, createWebHistory } from 'vue-router';
const routes = [
    {
        name: "home",
        path: "/",
        component: () => import("@/Layouts/AppLayout.vue"),
        meta: {
            title: "Dashboard",
            icon: "home",
        },
    },
    {
        name: "NotFound",
        path: "/:pathMatch(.*)*",
        component: () => import("@/Pages/NotFound.vue"),
    },
    {
        name: "Payments",
        path: "/payments",
        component: () => import("@/Components/Payments/Index.vue"),
        meta: {
            title: "Payments",
            icon: "credit-card",
        },
    },
    {
        name: "My Courses",
        path: '/courses',
        component: () => import('@/Pages/Courses/Index.vue'),
        meta: {
            title: "Courses",
            icon: "book",
        },
    },
    {
        name: "share-story",
        path: '/stories',
        component: () => import('@/Pages/Stories/Index.vue'),
        meta: {
            title: "Share Story",
            icon: "book",
        },
    },
    {
        name: "Academic-Achievements",
        path: '/academic-achievements',
        component: () => import('@/Pages/AcademicAchievements.vue'),
        meta: {
            title: "Academic Achievements",
            icon: "book",
        }
    },
    {
        name: "Self-Service-Forms",
        path: '/self-service-forms',
        component: () => import('@/Pages/SelfServiceForms.vue'),
        meta: {
            title: "Self Service Forms",
            icon: "book",
        }
    },
    {
        name: "Admissions",
        path: '/admissions',
        component: () => import('@/Pages/Admissions.vue'),
        meta: {
            title: "Admissions",
            icon: "book",
        }
    },
    {
        name: "Useful-Links",
        path: '/useful-links',
        component: () => import('@/Pages/UsefulLinks.vue'),
        meta: {
            title: "Useful Links",
            icon: "book",
        }
    },
    {
        name: "online-campus",
        path: '/online-campus',
        component: () => import('@/Pages/StudentCampus/OnlineCampus.vue'),
        meta: {
            title: "Online Campus",
            icon: "book",
        }
    },
    {
        name: 'profile',
        path: '/profile',
        // component: () => import('@/Pages/Profile/Profile.vue'),
    },

];
const router = createRouter({
    history: createWebHistory(),
    routes
  })
export default router;
