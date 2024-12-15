import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

export function useTabs() {
    const page = usePage();

    const tabs = computed(() => [
        {
            label: "Manage Courses",
            value: "manage",
            route: route("courses.manage"),
            component: "Courses/Manage",
        },
        {
            label: "Registration",
            value: "registration",
            route: route("courses.registration"),
            component: "Courses/Registration",
        },
        {
            label: "Manage Proctors",
            value: "proctors",
            route: route("courses.proctors"),
            component: "Courses/Proctors",
        },
        {
            label: "How To",
            value: "howto",
            route: route("courses.howto"),
            component: "Courses/HowTo",
        },
    ]);

    const currentTab = computed(() =>
        tabs.value.find((tab) => page.component === tab.component)
    );

    return {tabs, currentTab};
}
