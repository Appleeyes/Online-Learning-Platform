# Online Learning Platform

[![Build Status](https://github.com/Appleeyes/Online-Learning-Platform/workflows/Online%20Learning%20Platform/badge.svg)](https://github.com/Appleeyes/Online-Learning-Platform/actions) [![License](https://img.shields.io/badge/License-Apache-blue.svg)](license) [![Repo Size](https://img.shields.io/github/repo-size/Appleeyes/Online-Learning-Platform.svg)]() [![Contributors](https://img.shields.io/github/contributors/Appleeyes/Online-Learning-Platform.svg)]() ![Code Coverage](https://img.shields.io/badge/coverage-90%25-brightgreen) ![Last Commit](https://img.shields.io/github/last-commit/Appleeyes/Online-Learning-Platform)

## Overview


Online learning platform is a full blown learning platform developed using PHP/symfony framewok with twig template. Instructors can upload courses, and students can enroll and learn. The platform include features such as user registration and authentication, course creation and management for instructors, as well as enrollment, learning path, and progress tracking for students. And alo admin dashboard for admins.

## Table of Contents

- [Main Features](#main-features)
- [Technology Used](#technology-used)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Main Features

1. **User Registration and Authentication:**
   - Instructors and students should be able to register and authenticate into the platform.

2. **Course Creation, Uploading, and Management for Instructors:**
   - Instructors should have the ability to create, upload, and manage courses.

3. **Enrollment, Learning Path, and Progress Tracking for Students:**
   - Students should be able to enroll in courses, follow a learning path, and track their progress.

## Technology Used

1. **Symfony 6.3 Framework:**
   - Utilized Symfony 6.3 as the main framework for development.

2. **Twig for Templates:**
   - Used Twig for creating templates to render views.

3. **Symfony Maker Bundle:**
   - Implemented Symfony Maker Bundle to create entities, controllers, migrations, and other necessary components.

4. **CRUD Operations:**
   - Developed CRUD operations for each entity where needed.

5. **Symfony Forms:**
   - Used Symfony Forms for displaying forms within the application.

6. **Composer:**
   - Managed project dependencies using Composer.

7. **MySQL Database:**
   - Set up a MySQL database for storing data related to users, courses, and other entities.

8. **Docker Compose:**
   - Implemented a Docker Compose file for creating containers to ensure a consistent development environment.

9. **Doctrine ORM:**
   - Utilized Doctrine ORM for database interactions, including the creation and application of migrations.

10. **Config Files:**
    - Organized configuration settings using YAML files in the `config` directory.

11. **Nice Template:**
   - Applied a visually appealing template to enhance the user interface of the platform.

12. **Acceptance Tests:**
   - Implemented acceptance tests (Codeception ) for login, registration, adding a course, and deleting a course.

13. **Easyadmin Bundle:**
   - Used Easyadmin bundle for Admin CRUD.

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- **Docker:** You need Docker and Docker Compose installed on your local machine.
- **Compser:** You need composer to manage the project
- **PHP:** You need php installed on your local machine

### Installation

1. Clone the repository:

   ```shell
   git clone https://github.com/Appleeyes/Online-Learning-Platform.git
   cd Online-Learning-Platform

2. Run your Composer to install all dependencies
   ```shell
   composer install

3. Create a `.env.local` file and copy environment variables for your database in the `.env.example` and `env` file and make sure you assign your preferred value.

4. Create your database (make sure you already set up the .env.local and other .env files)

   ```shell
   php bin/console database:create

5. Create your database migrations:

   ```shell
   php bin/console make:migrations

6. Run the database migrations to create the required tables:

   ```shell
   php bin/console doctrine:migrations:migrate


## Usage

1. Start the development server:

   ```shell
   symfony server:start

2. Access the site on `http//localhost:8000` after serving the symfony server.

3. Navigate to ``/registration`` to register and get access into the site to explore.

You can now explore the features of Online Learning Platform.

## Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request.

## License

This project is licensed under the [Apache](license) License.

