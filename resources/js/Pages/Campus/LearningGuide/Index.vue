<template>
    <div class="learning-guides">
        <header class="learning-guides-header">
            <h1>{{ course.title }}</h1>
            <p class="subtitle">{{ course.description }}</p>
        </header>

        <main class="learning-guides-content">
            <section v-for="unit in course.units" :key="unit.id" class="guide-unit">
                <div class="unit-header" @click="toggleUnit(unit.id)">
                    <h2>Unit {{ unit.number }}: {{ unit.title }}</h2>
                    <p>{{ unit.dates }}</p>
                    <i :class="['fas', unit.isOpen ? 'fa-chevron-up' : 'fa-chevron-down']"></i>
                </div>
                <div v-if="unit.isOpen" class="unit-content">
                    <h3>Topics Covered</h3>
                    <ul>
                        <li v-for="topic in unit.topics" :key="topic.id">{{ topic }}</li>
                    </ul>
                    <h3>Grading Components</h3>
                    <ul>
                        <li v-for="grade in unit.grading" :key="grade.id">
                            {{ grade.component }}: {{ grade.percentage }}%
                        </li>
                    </ul>
                </div>
            </section>
        </main>

        <footer class="learning-guides-footer">
            <h3>Grading Summary</h3>
            <ul>
                <li v-for="grade in course.gradingSummary" :key="grade.id">
                    {{ grade.component }}: {{ grade.percentage }}%
                </li>
            </ul>
        </footer>
    </div>
</template>

<script>
export default {
    name: "LearningGuides",
    data() {
        return {
            course: {
                title: "Course Title Example",
                description: "An in-depth guide to mastering this course.",
                units: [
                    {
                        id: 1,
                        number: 1,
                        title: "Introduction to the Course",
                        dates: "Week 1: Jan 1 - Jan 7",
                        isOpen: false,
                        topics: ["Overview of the subject", "Course structure", "Expectations"],
                        grading: [
                            {id: 1, component: "Self-quiz", percentage: 10},
                            {id: 2, component: "Assignment", percentage: 20},
                        ],
                    },
                ],
                gradingSummary: [
                    {id: 1, component: "Quizzes", percentage: 40},
                    {id: 2, component: "Assignments", percentage: 40},
                    {id: 3, component: "Final Exam", percentage: 20},
                ],
            },
        };
    },
    methods: {
        toggleUnit(unitId) {
            this.course.units = this.course.units.map((unit) => {
                if (unit.id === unitId) {
                    unit.isOpen = !unit.isOpen;
                }
                return unit;
            });
        },
    },
};
</script>

<style scoped>
.learning-guides {
    font-family: 'Roboto', sans-serif;
    padding: 20px;
    color: #333;
    background: linear-gradient(to bottom, #f9f9f9, #eaeaea);
    min-height: 100vh;
}

.learning-guides-header {
    text-align: center;
    margin-bottom: 40px;
    background: #2196f3;
    color: #fff;
    padding: 20px 10px;
    border-radius: 8px;
}

.subtitle {
    font-size: 1.2rem;
    color: #bbdefb;
}

.guide-unit {
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
}

.unit-header {
    padding: 15px;
    background: #4caf50;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.unit-header h2 {
    margin: 0;
}

.unit-content {
    padding: 20px;
}

.unit-content h3 {
    margin-top: 0;
    color: #333;
}

.unit-content ul {
    list-style-type: disc;
    padding-left: 20px;
}

.learning-guides-footer {
    margin-top: 40px;
    padding: 20px;
    background: #f0f0f0;
    border-radius: 8px;
    text-align: center;
}

.learning-guides-footer ul {
    list-style-type: none;
    padding: 0;
}

.learning-guides-footer li {
    margin-bottom: 10px;
}
</style>
