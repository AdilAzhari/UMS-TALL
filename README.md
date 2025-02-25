<p align="center"><img src="public/images/logo.png" width="400" alt="UMS Logo"></p>

<p align="center">
<a href="https://laravel.com/docs/11.x"><img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel Version"></a>
<a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind%20CSS-3.x-38B2AC?style=flat-square&logo=tailwind-css" alt="Tailwind CSS"></a>
<a href="https://alpinejs.dev/"><img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js"></a>
<a href="https://livewire.laravel.com"><img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=flat-square&logo=livewire" alt="Livewire"></a>
</p>

## About UMS

UMS (University Management System) is a comprehensive web application built with the TALL stack (Tailwind CSS, Alpine.js, Laravel, Livewire) and Filament admin panel. It provides a robust and scalable solution for managing all aspects of a university or educational institution. 

## Features

- **Modern Tech Stack**: Built on Laravel 11 with the TALL stack (Tailwind, vue.js, Laravel)
- **Elegant Admin Panel**: Powered by Filament 3.x for intuitive and powerful administration
- **Responsive Design**: Fully responsive interface that works on all devices
- **Role-based Access Control**: Comprehensive permissions system with Filament Shield
- **Real-time Updates**: Using Laravel Reverb for real-time notifications and updates
- **Advanced Form Handling**: Complex forms with validation and dynamic components
- **Media Management**: Upload and manage files and images with ease
- **RESTful API**: Built-in API endpoints for integration with other systems
- **Comprehensive Reporting**: Generate reports on students, courses, grades, and more

## Modules

### Academic Structure
- Manage departments, programs, courses, terms, and academic calendar
- Create and organize class groups and schedules
- Define course prerequisites and requirements

### User Management
- Student registration and profiles
- Teacher and staff management
- Role-based permissions for administrators, teachers, students, proctors, and advisors

### Learning Management
- Course materials and resources
- Assignment creation, submission, and grading
- Peer reviews and collaborative learning
- Learning guidance and tracking

### Assessment System
- Quiz and exam creation with multiple question types
- Online test taking with secure proctoring
- Automated and manual grading options
- Comprehensive grade management and reporting

### Student Management
- Enrollment and registration tracking
- Attendance monitoring
- Academic progress tracking
- Grade management and transcripts
- Achievement recognition

### Communication
- Announcements and notifications
- Discussion forums and comments
- Messaging between users
- Story sharing and social features

## Technology Stack

UMS is built using the following technologies:

- **Laravel 11**: The latest version of the PHP framework for web artisans
- **Tailwind CSS**: A utility-first CSS framework for rapid UI development
- **Alpine.js**: A lightweight JavaScript framework for adding interactivity
- **Livewire/Volt**: For building dynamic interfaces with PHP
- **Filament 3**: Admin panel and form builder framework
- **Filament Shield**: For advanced permissions and access control
- **Intervention Image**: For image manipulation and optimization
- **Laravel Sanctum**: For API authentication
- **Stripe**: For payment processing
- **Laravel Notify**: For user notifications
- **Laravel Telescope**: For debugging and performance monitoring

## Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/UMS-TALL.git

# Navigate to the project directory
cd UMS-TALL

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seed the database
php artisan migrate --seed

# Build assets
npm run dev

# Start the server
php artisan serve
```

## Usage

After installation, you can access:
- Main application: http://localhost:8000
- Admin panel: http://localhost:8000/admin

Default admin credentials:
- Email: admin@example.com
- Password: password

## Contributing

Thank you for considering contributing to the UMS project! Contributions are welcome and appreciated.

## Security Vulnerabilities

If you discover a security vulnerability within UMS, please send an e-mail to the project maintainers. All security vulnerabilities will be promptly addressed.

## License

The UMS project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
