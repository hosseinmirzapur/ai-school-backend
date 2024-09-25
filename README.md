# Elementary School AI-Powered Learning Platform

This project is a backend application built with Laravel, integrated with ChatGPT, designed to provide a learning
platform for elementary school students. It supports features such as AI-assisted chat, flashcards for learning, user
management, and multi-tenancy for managing multiple schools or classes.

## Key Features

### 1. **Online AI Chat**

- **Chat with AI (powered by ChatGPT)**: Allows students to interact with an AI-powered chatbot for personalized
  learning assistance. Students can ask questions, get explanations, or engage in learning conversations.
- **Natural Language Processing**: The AI is capable of understanding and responding to various educational topics,
  making learning interactive and engaging.

### 2. **Flashcards for Learning**

- **Customizable Flashcards**: Teachers or admins can create, edit, and manage flashcards based on different subjects,
  topics, or difficulty levels.
- **Flashcard Quizzes**: Students can practice through flashcard quizzes with instant feedback from the system.
- **Progress Tracking**: Student performance on flashcards is tracked and analyzed for future learning improvements.

### 3. **User Management**

- **Role-based Access Control**: Admins, teachers, and students each have distinct roles with appropriate permissions.
- **Student Profiles**: Each student has their own profile that tracks their progress, performance, and interactions
  with the AI.
- **Teacher and Admin Panels**: Teachers and admins can manage content, users, and monitor student progress.

### 4. **Multi-tenancy Support**

- **Multiple School/Class Management**: The platform supports multiple schools or classrooms, each with their own
  isolated data and users.
- **School-specific Admins**: Each school or class has its own admin to manage the students, teachers, and curriculum.

### 5. **Performance Analytics**

- **Student Analytics**: Detailed insights into each student’s performance, including flashcard quiz results, chat
  interactions with AI, and overall progress.
- **School/Class Level Reports**: Aggregate reports for school administrators to monitor overall performance and trends
  across students and classes.

### 6. **Authentication and Security**

- **User Authentication**: Secure login for admins, teachers, and students using Laravel’s built-in authentication
  system.
- **Password Reset**: A password recovery system for all users.
- **Multi-tenancy Security**: Each tenant (school or class) has its own isolated data to ensure privacy and security.

## Technologies Used

- **Laravel Framework**: Backend framework used for routing, middleware, authentication, and database management.
- **ChatGPT Integration**: AI-powered chat using OpenAI’s API to provide intelligent responses and assistance to
  students.
- **MySQL/PostgreSQL**: Database management for user data, flashcards, progress tracking, and multi-tenancy support.
- **Redis**: Used for caching and session management.
- **Passport/Sanctum**: Laravel Passport or Sanctum for API authentication, ensuring secure communication between
  frontend and backend.
