---

# 🎓 University Management System (UMS)

A comprehensive **University Management System (UMS)** built using **Laravel, Vue.js, Inertia.js, MySQL, and Pest for testing**. This project follows the **service pattern architecture** and aims to provide an efficient, scalable, and modern solution for managing university operations.

---

## 🌟 Key Features

### **User Roles & Authentication**
- **Role-based access control** for Students, Teachers, and Admins.
- Secure authentication powered by **Laravel Breeze**.

### **Course Management**
- Course registration, dropping, and achievement tracking.
- Seamless enrollment and progress monitoring for students.

### **Student Portal**
- Apply for leave of absence.
- View academic progress and manage course enrollment.
- Access the **Online Campus** to:
  - View registered courses.
  - Submit assignments.
  - Check weekly activities and deadlines.

### **Teacher & Admin Dashboard**
- Manage classes, exams, quizzes, and assignments.
- Oversee student progress and academic performance.

### **Automated Notifications**
- Email notifications for course updates, homework deadlines, and announcements.

### **Payment Integration**
- Secure payment processing via **Stripe** for tuition fees and other transactions.

### **Background Job Processing**
- Efficient handling of tasks using Laravel’s queue system.

### **Clean Code & Best Practices**
- Adherence to Laravel’s coding standards.
- Robust database management with **Eloquent ORM**.

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
git clone https://github.com/your-username/project-name.git
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

### 6. Start the development server:
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

---

## 🤝 Contributing

We welcome contributions! Here’s how you can help:

1. **Fork the repository**.
2. **Create a new branch** for your feature or bugfix:
   ```bash
   git checkout -b feature-new-functionality
   ```
3. **Commit your changes** with descriptive messages.
4. **Submit a pull request** with a detailed description of your changes.

---
