# Educational Institute Assistant Management System

This project is an **Educational Institute Assistant Management System** built with **Laravel 11**, designed to manage and streamline course management and student management for tutoring students in various classes. The backend is built using **API routes** for CRUD operations and is structured using **modules** to organize functionality.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- **Simple, fast routing engine**
- **Powerful dependency injection container**
- Multiple backends for session and cache storage
- Expressive, intuitive database ORM (Eloquent)
- Database agnostic schema migrations
- Robust background job processing
- Real-time event broadcasting

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Features

The system includes two main modules:

1. **Course Management**: Handles course creation, assignments, exams, and teacher details.
2. **Student Management**: Manages student enrollments, attendance tracking, evaluations, and related data.

## Project Structure

The project is organized using the **nwidart/laravel-modules** package, which separates each module with its own routes, controllers, models, and migrations. This allows for better code organization and easier maintenance.

### Modules:

1. **Course Management Module**: 
   - Courses, Teachers, Assignments, Exams, and Questions are managed here.
   
2. **Student Management Module**: 
   - Students, Attendance, Enrollment, and Evaluations are handled in this module.
   

## Technologies Used

- **Laravel 11**: The latest version of Laravel used for building the backend API.
- **Laravel Modules**: The project uses the `nwidart/laravel-modules` package to split the functionality into separate modules.
- **Postman**: For testing the API endpoints during development.
- **MySQL**: Database to store data for courses, students, enrollments, etc.

## Installation

To set up the project locally:

1. Clone the repository:
    ```bash
    git clone https://github.com/your-repository-url.git
    ```

2. Navigate into the project directory:
    ```bash
    cd educational-institute-management
    ```

3. Install the dependencies:
    ```bash
    composer install
    ```

4. Set up the environment variables:
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Configure the database and other settings in the `.env` file.

5. Generate an application key:
    ```bash
    php artisan key:generate
    ```

6. Run the database migrations:
    ```bash
    php artisan migrate
    ```

7. Start the server:
    ```bash
    php artisan serve
    ```

## Usage

This project provides API endpoints to manage courses, students, enrollments, and more. Admin authentication is required for most operations, while students can register, log in, and log out.

- **Admin Operations**: Only an admin can create, update, and delete resources such as courses, students, assignments, and exams.
- **Student Access**: Students can only register, log in, view their courses, submit assignments, and take exams.

## Authentication

The project uses **Laravel Sanctum** to secure API routes. Admin access is limited by assigning a specific email and password, while students will only be able to register, log in, and perform student-specific actions.

To authenticate:
- Admins: Use the designated admin email and password set in the database.
- Students: Register via the student registration endpoint.

## Admin Middleware

All admin-level CRUD operations are protected by middleware. Only users authenticated as admins can access these routes, which handle courses, students, exams, assignments, and questions.

## Future Enhancements

- Extend the **Student Module** to include more detailed academic records.
- Add a **Notifications System** for students and teachers.

## Contributions

Contributions to this project are welcome. Please follow the guidelines below:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.


## Contact

For any inquiries or contributions, you can reach me at [deemamoneer@gmail.com].
