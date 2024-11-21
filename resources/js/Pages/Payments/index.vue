<template>
    <AppLayout>
        <div
            class="container mx-auto py-12 px-6 sm:px-8 bg-gradient-to-b from-gray-50 to-white rounded-lg shadow-md"
        >
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-extrabold text-indigo-900">
                    Payments
                </h1>
                <div class="flex space-x-4">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search payments..."
                        class="w-64 border border-gray-300 rounded-full px-4 py-2 shadow-md focus:ring-indigo-500 focus:border-indigo-500"
                        @input="debouncedSearch"
                    />
                    <select
                        v-model="filterStatus"
                        class="w-48 border border-gray-300 rounded-full px-4 py-2 shadow-md focus:ring-indigo-500 focus:border-indigo-500"
                        @change="applyFilter"
                    >
                        <option value="">All Statuses</option>
                        <option value="Completed">Completed</option>
                        <option value="Pending">Pending</option>
                        <option value="Failed">Failed</option>
                        <option value="Refunded">Refunded</option>
                    </select>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex justify-center space-x-8 mb-12">
                <button
                    @click="updateTab('history')"
                    class="py-3 px-10 rounded-full text-lg font-semibold shadow-md transition transform hover:scale-105"
                    :class="[
                        activeTab === 'history'
                            ? 'bg-indigo-600 text-white'
                            : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
                    ]"
                >
                    Payment History
                </button>
                <button
                    @click="updateTab('upcoming')"
                    class="py-3 px-10 rounded-full text-lg font-semibold shadow-md transition transform hover:scale-105"
                    :class="[
                        activeTab === 'upcoming'
                            ? 'bg-indigo-600 text-white'
                            : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
                    ]"
                >
                    Upcoming Payments
                </button>
            </div>

            <!-- Payment Cards -->
            <div
                v-if="currentPayments.data.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                <div
                    v-for="payment in currentPayments.data"
                    :key="payment.id"
                    class="bg-white shadow-lg rounded-xl p-6 transition hover:shadow-2xl"
                >
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-indigo-800">
                            {{ payment.course.name }}
                        </h2>
                        <span
                            :class="[getStatusBadge(payment.status)]"
                            class="px-3 py-1 text-sm font-semibold rounded-full"
                        >
                            {{ payment.status }}
                        </span>
                    </div>
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">
                            <strong>Course:</strong>
                            {{ payment.course.name}}
                            {{ payment.course.code }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Amount:</strong> ${{ payment.amount }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Date:</strong> {{ payment.payment_date }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Method:</strong> {{ payment.method }}
                        </p>
                    </div>
                    <div>
                        <button
                            v-if="
                                ['Failed', 'Refunded','Cancelled'].includes(payment.status)
                            "
                            @click="redirectToPayment(payment.id)"
                            class="w-full py-3 mb-2 text-white bg-red-600 rounded-full font-medium hover:bg-red-700 transition"
                        >
                            Retry Payment
                        </button>
                        <button
                            v-if="activeTab === 'history' && payment.status === 'Pending'"
                            @click="redirectToPayment(payment.id)"
                            class="w-full py-3 text-white bg-indigo-600 rounded-full font-medium hover:bg-indigo-700 transition"
                        >
                            Complete Payment
                        </button>
                        <button
                            v-else-if="activeTab === 'upcoming' && payment.status === 'Pending'"
                            @click="redirectToPayment(payment.id)"
                            class="w-full py-3 text-white bg-indigo-600 rounded-full font-medium hover:bg-indigo-700 transition"
                        >
                            Make Payment
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div
                v-else
                class="text-center py-16 bg-gray-100 rounded-lg shadow-md"
            >
                <div>
                    <svg
                        class="mx-auto h-12 w-12 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        ></path>
                    </svg>
                </div>
                <p class="mt-6 text-lg text-gray-600">
                    No payments found in this tab.
                </p>
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                <Pagination
                    :links="currentPayments.links"
                    @change="handlePageChange"
                />
            </div>
        </div>
    </AppLayout>
</template>
<script>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import debounce from "lodash/debounce";

export default {
    components: {
        AppLayout,
        Pagination,
    },
    props: {
        historicalPayments: Object,
        upcomingPayments: Object,
        initialTab: String,
        filters: Object,
    },

    setup(props) {
        const activeTab = ref(props.initialTab || "history");
        const search = ref(props.filters.search || "");
        const filterStatus = ref("");

        const currentPayments = computed(() => {
            let payments =
                activeTab.value === "history"
                    ? props.historicalPayments
                    : props.upcomingPayments;

            if (filterStatus.value) {
                payments = {
                    ...payments,
                    data: payments.data.filter(
                        (payment) => payment.status === filterStatus.value
                    ),
                };
            }
            return payments;
        });

        const updateTab = (tab) => {
            activeTab.value = tab;
            router.get(
                route("payments.index"),
                { tab, search: search.value, status: filterStatus.value },
                { preserveState: true, replace: true }
            );
        };

        const debouncedSearch = debounce(() => {
            router.get(
                route("payments.index"),
                { tab: activeTab.value, search: search.value },
                { preserveState: true, replace: true }
            );
        }, 300);

        const applyFilter = () => {
            router.get(
                route("payments.index"),
                { tab: activeTab.value, status: filterStatus.value, page: 1 },
                { preserveState: true, replace: true }
            );
        };
        const getStatusBadge = (status) => {
            switch (status) {
                case "Completed":
                    return "bg-green-100 text-green-800";
                case "Pending":
                    return "bg-yellow-100 text-yellow-800";
                case "Failed":
                    return "bg-red-100 text-red-800";
                case "Refunded":
                    return "bg-blue-100 text-blue-800";
                default:
                    return "bg-gray-100 text-gray-800";
            }
        };

        const handlePageChange = (page) => {
            router.get(
                route("payments.index"),
                {
                    tab: activeTab.value,
                    search: search.value,
                    status: filterStatus.value,
                    page,
                },
                { preserveState: true, replace: true }
            );
        };

        const redirectToPayment = (paymentId) => {
            window.location.href = route("payments.pay", { id: paymentId });
        };

        return {
            activeTab,
            currentPayments,
            updateTab,
            search,
            debouncedSearch,
            filterStatus,
            applyFilter,
            redirectToPayment,
            getStatusBadge,
            handlePageChange,
        };
    },
};
</script>
