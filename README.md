<div align="center">

# 🎓 University Management System (UMS)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![Inertia.js](https://img.shields.io/badge/Inertia.js-000000?style=for-the-badge&logo=inertia&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PestPHP](https://img.shields.io/badge/PestPHP-FF2D20?style=for-the-badge&logo=pest&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Stripe](https://img.shields.io/badge/Stripe-008CDD?style=for-the-badge&logo=stripe&logoColor=white)

</div>

A comprehensive **University Management System (UMS)** built using **Laravel, Vue.js, Inertia.js, MySQL, and Pest for testing**. This project follows the **service pattern architecture** and aims to provide an efficient, scalable, and modern solution for managing university operations.

---

## 🌟 Key Features

### **User Roles & Authentication**
- **Role-based access control** for Students, Teachers, and Admins.
- Secure authentication powered by **Laravel Breeze**.

### **Course Management**
- **Course Registration**: Students can register for courses, and admins can manage course offerings.
- **Proctor Management**: Assign proctors to courses and manage proctor responses.
- **Course Resources**: Access syllabus, learning guides, and resources for each course.

### **Student Portal**
- **Online Campus**: Access course materials, announcements, and weekly activities.
- **Assignments**: Submit assignments and view feedback.
- **Quizzes**: Take quizzes, view results, and track progress.
- **Forum Discussions**: Participate in course-related discussions and reply to comments.

### **Teacher & Admin Dashboard**
- **Announcements**: Create and manage course announcements.
- **Learning Guides**: Upload and manage weekly learning guides.
- **Assignments & Quizzes**: Create and grade assignments and quizzes.
- **Proctor Management**: Assign proctors and manage their responses.

### **Academic Progress & Achievements**
- Track academic progress and view achievements.
- Monitor course completion and performance.

### **Payment Integration**
- **Stripe Integration**: Securely handle course payments and view payment history.
- Payment success and cancellation handling.

### **Stories & Community Engagement**
- **Stories**: Share and manage stories within the university community.
- **Comments**: Engage with stories by posting and managing comments.

### **Automated Notifications**
- Email notifications for course updates, homework deadlines, and announcements.

### **Developer Tooling**
- Pre-configured testing with **PestPHP**.
- Code quality enforcement using **PHPStan**, **Pint**, and **Rector**.

---

## 🛠️ Tech Stack

### **Backend**
- **Laravel 11** (PHP framework)
- **MySQL** (Database)
- **Inertia.js** (Server-side routing)

### **Frontend**
- **Vue.js** (JavaScript framework)
- **Tailwind CSS** (Styling)

### **Authentication**
- **Laravel Breeze** (Authentication scaffolding)

### **Testing**
- **PestPHP** (Testing framework)

### **Code Quality**
- **PHPStan** (Static analysis)
- **Pint** (Laravel code styling)
- **Rector** (Automated code refactoring)

### **Payment Integration**
- **Stripe** (Payment gateway)

---

## 🚀 Installation

### 1. Clone the repository:
```bash
git clone https://github.com/AdilAzhari/UMS-TALL.git
cd project-name
```

### 2. Install dependencies:
```bash
composer install
npm install
```

### 3. Set up the environment:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure the database:
Update the `.env` file with your database credentials:
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Run migrations:
```bash
php artisan migrate
```

### 6. Seed Data for Testing:
To populate the database with dummy data for testing, run:
```bash
php artisan db:seed
```
###OR 
```bash
php artisan migrate --seed
```
### 7. Start the development server:
```bash
php artisan serve
npm run dev
```

---

## 🧪 Development Commands

The project includes a **custom composer script** to streamline testing and code quality checks:

```json
"scripts": {
    "test": [
        "@pint",
        "@rector",
        "@phpstan"
    ],
    "pint": "vendor/bin/pint",
    "rector": "vendor/bin/rector",
    "phpstan": "vendor/bin/phpstan analyse --configuration=phpstan.neon"
}
```

Run all tests and format code with:
```bash
composer test
```
