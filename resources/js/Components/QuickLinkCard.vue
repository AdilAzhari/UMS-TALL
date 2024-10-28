<template>
    <Link
        :href="to"
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition duration-300"
    >
        <div class="flex flex-col items-center text-center">
            <div class="mb-2 p-3 bg-indigo-100 rounded-full">
                <component
                    :is="iconComponent"
                    class="w-6 h-6 text-indigo-600"
                />
            </div>
            <h5 class="mb-1 text-xl font-medium text-gray-900">{{ title }}</h5>
        </div>
    </Link>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";
import {
    AcademicCapIcon,
    ClipboardListIcon,
    ChartBarIcon,
    CalendarIcon,
} from "@heroicons/vue/outline";

export default defineComponent({
    components: {
        Link,
        AcademicCapIcon,
        ClipboardListIcon,
        ChartBarIcon,
        CalendarIcon,
    },
    props: {
        title: {
            type: String,
            required: true,
        },
        icon: {
            type: String,
            required: true,
        },
        to: {
            type: String,
            required: true,
        },
    },
    computed: {
        iconComponent() {
            const icons = {
                "academic-cap": AcademicCapIcon,
                "clipboard-list": ClipboardListIcon,
                "chart-bar": ChartBarIcon,
                calendar: CalendarIcon,
            };
            return icons[this.icon] || AcademicCapIcon;
        },
    },
});
</script>
