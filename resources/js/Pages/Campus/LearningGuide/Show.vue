<template>
    <div v-for="week in weeks" :key="week.id" class="week-content">
        <!-- Learning Guidance Section -->
        <section class="p-4 bg-blue-50 rounded-lg border border-blue-200 mb-4">
            <h3 class="text-md font-medium text-blue-700">Learning Guidance: Week {{ week.week_number }}</h3>
            <p class="text-sm text-blue-600 mt-2">{{ week.learningGuidance.overview }}</p>

            <ul class="list-disc list-inside mt-4 space-y-2">
                <li v-for="topic in week.learningGuidance.topics" :key="topic" class="text-gray-700">
                    {{ topic }}
                </li>
            </ul>

            <div class="mt-4">
                <h4 class="font-medium text-gray-700">Learning Objectives:</h4>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li v-for="objective in week.learningGuidance.objectives" :key="objective">
                        {{ objective }}
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <h4 class="font-medium text-gray-700">Tasks:</h4>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li v-for="task in week.learningGuidance.tasks" :key="task">
                        {{ task }}
                    </li>
                </ul>
            </div>
        </section>

        <!-- Other Week Content: Resources, Assignments, etc. -->
        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
            <h4 class="text-lg font-medium text-gray-700">Additional Content</h4>
            <p>Other week content like resources, assignments, and quizzes goes here.</p>
        </div>
    </div>
</template>

<script>
export default {
    // props: {
    //     weeks: {
    //         type: Array,
    //         required: true
    //     }
    // }
    data() {
        return {
            weeks: [
                {
                    id: 1,
                    week_number: 1,
                    learningGuidance: {
                        overview: "General concepts of cybersecurity",
                        topics: [
                            "Introduction",
                            "Network security",
                            "Security Protocols: SSL and HTTPS",
                            "C.I.A. Triad"
                        ],
                        objectives: [
                            "Describe the key concepts of cybersecurity, their importance, and the most current cyber-security attacks.",
                            "Discuss the challenges faced by individuals regarding network security.",
                            "Discuss the C.I.A. triad as a core stone of cybersecurity based on research."
                        ],
                        tasks: [
                            "Read the Learning Guide and Reading Assignments",
                            "Participate in the Discussion Assignment",
                            "Complete and submit the Written Assignment",
                            "Make entries to the Learning Journal",
                            "Take the Self-Quiz"
                        ]
                    }
                },
                {
                    id: 2,
                    week_number: 2,
                    learningGuidance: {
                        overview: "Advanced networking concepts",
                        topics: ["Firewall management", "IDS/IPS"],
                        objectives: [
                            "Learn firewall rules.",
                            "Understand intrusion detection systems."
                        ],
                        tasks: ["Setup firewall in lab", "Research IDS/IPS solutions"]
                    }
                }
            ]
        };
    }

};
</script>
