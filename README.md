# Laravel Project

Laravel - 10

## Prerequisites

Before you begin, make sure you have the following requirements in place:

-   PHP (^8.1) installed on your system
-   Composer - Dependency manager for PHP
-   MySQL or another database of your choice
-   Laravel's server requirements (You can find these in the Laravel documentation)

## Getting Started

Follow these steps to clone and run the project on your local environment:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/mizan8102/mediusware-coding-test.git
    cd project-name
    composer install
    ````

Create a copy of the .env.example file and save it as .env. Update the configuration values in the .env file, including your database connection details.

```bash
php artisan migrate

```

```bash
php artisan serve

```


Access the application in postman at http://localhost:8000/api or the URL provided by the php artisan serve command.

Base URL: http://localhost:8000/api
