const Ziggy = {
    "url": "http:\/\/localhost", "port": null, "defaults": {}, "routes": {
        "debugbar.openhandler": {"uri": "_debugbar\/open", "methods": ["GET", "HEAD"]},
        "debugbar.clockwork": {"uri": "_debugbar\/clockwork\/{id}", "methods": ["GET", "HEAD"], "parameters": ["id"]},
        "debugbar.assets.css": {"uri": "_debugbar\/assets\/stylesheets", "methods": ["GET", "HEAD"]},
        "debugbar.assets.js": {"uri": "_debugbar\/assets\/javascript", "methods": ["GET", "HEAD"]},
        "debugbar.cache.delete": {
            "uri": "_debugbar\/cache\/{key}\/{tags?}",
            "methods": ["DELETE"],
            "parameters": ["key", "tags"]
        },
        "debugbar.queries.explain": {"uri": "_debugbar\/queries\/explain", "methods": ["POST"]},
        "filament.exports.download": {
            "uri": "filament\/exports\/{export}\/download",
            "methods": ["GET", "HEAD"],
            "parameters": ["export"],
            "bindings": {"export": "id"}
        },
        "filament.imports.failed-rows.download": {
            "uri": "filament\/imports\/{import}\/failed-rows\/download",
            "methods": ["GET", "HEAD"],
            "parameters": ["import"],
            "bindings": {"import": "id"}
        },
        "filament.admin.auth.login": {"uri": "admin\/login", "methods": ["GET", "HEAD"]},
        "filament.admin.auth.password-reset.request": {
            "uri": "admin\/password-reset\/request",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.auth.password-reset.reset": {"uri": "admin\/password-reset\/reset", "methods": ["GET", "HEAD"]},
        "filament.admin.auth.register": {"uri": "admin\/register", "methods": ["GET", "HEAD"]},
        "filament.admin.auth.logout": {"uri": "admin\/logout", "methods": ["POST"]},
        "filament.admin.auth.email-verification.prompt": {
            "uri": "admin\/email-verification\/prompt",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.auth.email-verification.verify": {
            "uri": "admin\/email-verification\/verify\/{id}\/{hash}",
            "methods": ["GET", "HEAD"],
            "parameters": ["id", "hash"]
        },
        "filament.admin.pages.dashboard": {"uri": "admin", "methods": ["GET", "HEAD"]},
        "filament.admin.pages.edit-profile": {"uri": "admin\/edit-profile", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.admins.index": {"uri": "admin\/admins", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.admins.create": {"uri": "admin\/admins\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.admins.edit": {
            "uri": "admin\/admins\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.announcement-comments.index": {
            "uri": "admin\/announcement-comments",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.announcement-comments.create": {
            "uri": "admin\/announcement-comments\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.announcement-comments.edit": {
            "uri": "admin\/announcement-comments\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.announcements.index": {"uri": "admin\/announcements", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.announcements.create": {
            "uri": "admin\/announcements\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.announcements.edit": {
            "uri": "admin\/announcements\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.assignments.index": {"uri": "admin\/assignments", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.assignments.create": {
            "uri": "admin\/assignments\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.assignments.edit": {
            "uri": "admin\/assignments\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.assignment-submissions.index": {
            "uri": "admin\/assignment-submissions",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.assignment-submissions.create": {
            "uri": "admin\/assignment-submissions\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.assignment-submissions.edit": {
            "uri": "admin\/assignment-submissions\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.attendances.index": {"uri": "admin\/attendances", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.attendances.create": {
            "uri": "admin\/attendances\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.attendances.edit": {
            "uri": "admin\/attendances\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.classes.index": {"uri": "admin\/classes", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.classes.create": {"uri": "admin\/classes\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.classes.edit": {
            "uri": "admin\/classes\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.courses.index": {"uri": "admin\/courses", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.courses.create": {"uri": "admin\/courses\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.courses.edit": {
            "uri": "admin\/courses\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.departments.index": {"uri": "admin\/departments", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.departments.create": {
            "uri": "admin\/departments\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.departments.edit": {
            "uri": "admin\/departments\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.enrollments.index": {"uri": "admin\/enrollments", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.enrollments.create": {
            "uri": "admin\/enrollments\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.enrollments.edit": {
            "uri": "admin\/enrollments\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.exam-answers.index": {"uri": "admin\/exam-answers", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.exam-answers.create": {
            "uri": "admin\/exam-answers\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.exam-answers.edit": {
            "uri": "admin\/exam-answers\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.exam-question-options.index": {
            "uri": "admin\/exam-question-options",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.exam-question-options.create": {
            "uri": "admin\/exam-question-options\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.exam-question-options.edit": {
            "uri": "admin\/exam-question-options\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.exam-questions.index": {"uri": "admin\/exam-questions", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.exam-questions.create": {
            "uri": "admin\/exam-questions\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.exam-questions.edit": {
            "uri": "admin\/exam-questions\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.exams.index": {"uri": "admin\/exams", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.exams.create": {"uri": "admin\/exams\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.exams.edit": {
            "uri": "admin\/exams\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.exam-results.index": {"uri": "admin\/exam-results", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.exam-results.create": {
            "uri": "admin\/exam-results\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.exam-results.edit": {
            "uri": "admin\/exam-results\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.grading-scales.index": {"uri": "admin\/grading-scales", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.grading-scales.create": {
            "uri": "admin\/grading-scales\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.grading-scales.edit": {
            "uri": "admin\/grading-scales\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.materials.index": {"uri": "admin\/materials", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.materials.create": {"uri": "admin\/materials\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.materials.edit": {
            "uri": "admin\/materials\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.proctors.index": {"uri": "admin\/proctors", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.proctors.create": {"uri": "admin\/proctors\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.proctors.edit": {
            "uri": "admin\/proctors\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.programs.index": {"uri": "admin\/programs", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.programs.create": {"uri": "admin\/programs\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.programs.edit": {
            "uri": "admin\/programs\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.quiz-question-options.index": {
            "uri": "admin\/quiz-question-options",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.quiz-question-options.create": {
            "uri": "admin\/quiz-question-options\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.quiz-question-options.edit": {
            "uri": "admin\/quiz-question-options\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.quiz-questions.index": {
            "uri": "admin\/quiz-questions",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.quiz-questions.create": {
            "uri": "admin\/quiz-questions\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.quiz-questions.edit": {
            "uri": "admin\/quiz-questions\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.quizzes.index": {"uri": "admin\/quizzes", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.quizzes.create": {"uri": "admin\/quizzes\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.quizzes.edit": {
            "uri": "admin\/quizzes\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.quiz-submissions.index": {
            "uri": "admin\/quiz-submissions",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.quiz-submissions.create": {
            "uri": "admin\/quiz-submissions\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.quiz-submissions.edit": {
            "uri": "admin\/quiz-submissions\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.students.index": {"uri": "admin\/students", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.students.create": {"uri": "admin\/students\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.students.edit": {
            "uri": "admin\/students\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.teachers.index": {"uri": "admin\/teachers", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.teachers.create": {"uri": "admin\/teachers\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.teachers.edit": {
            "uri": "admin\/teachers\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.technical-teams.index": {"uri": "admin\/technical-teams", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.technical-teams.create": {
            "uri": "admin\/technical-teams\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.technical-teams.edit": {
            "uri": "admin\/technical-teams\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.terms.index": {"uri": "admin\/terms", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.terms.create": {"uri": "admin\/terms\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.terms.edit": {
            "uri": "admin\/terms\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.users.index": {"uri": "admin\/users", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.users.create": {"uri": "admin\/users\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.users.edit": {
            "uri": "admin\/users\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.weeks.index": {"uri": "admin\/weeks", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.weeks.create": {"uri": "admin\/weeks\/create", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.weeks.edit": {
            "uri": "admin\/weeks\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.shield.roles.index": {"uri": "admin\/shield\/roles", "methods": ["GET", "HEAD"]},
        "filament.admin.resources.shield.roles.create": {
            "uri": "admin\/shield\/roles\/create",
            "methods": ["GET", "HEAD"]
        },
        "filament.admin.resources.shield.roles.view": {
            "uri": "admin\/shield\/roles\/{record}",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "filament.admin.resources.shield.roles.edit": {
            "uri": "admin\/shield\/roles\/{record}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["record"]
        },
        "sanctum.csrf-cookie": {"uri": "sanctum\/csrf-cookie", "methods": ["GET", "HEAD"]},
        "livewire.update": {"uri": "livewire\/update", "methods": ["POST"]},
        "livewire.upload-file": {"uri": "livewire\/upload-file", "methods": ["POST"]},
        "livewire.preview-file": {
            "uri": "livewire\/preview-file\/{filename}",
            "methods": ["GET", "HEAD"],
            "parameters": ["filename"]
        },
        "dashboard": {"uri": "dashboard", "methods": ["GET", "HEAD"]},
        "user.profile": {"uri": "profile\/{user}", "methods": ["GET", "HEAD"], "parameters": ["user"]},
        "payments": {"uri": "payments", "methods": ["GET", "HEAD"]},
        "courses": {"uri": "courses", "methods": ["GET", "HEAD"]},
        "share": {"uri": "share", "methods": ["GET", "HEAD"]},
        "achievements": {"uri": "achievements", "methods": ["GET", "HEAD"]},
        "forms": {"uri": "forms", "methods": ["GET", "HEAD"]},
        "admissions": {"uri": "admissions", "methods": ["GET", "HEAD"]},
        "links": {"uri": "links", "methods": ["GET", "HEAD"]},
        "online-campus": {"uri": "online-campus", "methods": ["GET", "HEAD"]},
        "profile.edit": {"uri": "profile", "methods": ["GET", "HEAD"]},
        "profile.update": {"uri": "profile", "methods": ["PATCH"]},
        "profile.destroy": {"uri": "profile", "methods": ["DELETE"]},
        "register": {"uri": "register", "methods": ["GET", "HEAD"]},
        "login": {"uri": "login", "methods": ["GET", "HEAD"]},
        "password.request": {"uri": "forgot-password", "methods": ["GET", "HEAD"]},
        "password.email": {"uri": "forgot-password", "methods": ["POST"]},
        "password.reset": {"uri": "reset-password\/{token}", "methods": ["GET", "HEAD"], "parameters": ["token"]},
        "password.store": {"uri": "reset-password", "methods": ["POST"]},
        "verification.notice": {"uri": "verify-email", "methods": ["GET", "HEAD"]},
        "verification.verify": {
            "uri": "verify-email\/{id}\/{hash}",
            "methods": ["GET", "HEAD"],
            "parameters": ["id", "hash"]
        },
        "verification.send": {"uri": "email\/verification-notification", "methods": ["POST"]},
        "password.confirm": {"uri": "confirm-password", "methods": ["GET", "HEAD"]},
        "password.update": {"uri": "password", "methods": ["PUT"]},
        "logout": {"uri": "logout", "methods": ["POST"]}
    }
};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export {Ziggy};
