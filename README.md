# Task-CRUD Application

## Getting Started

To run the project, ensure that PHP 8 and Composer are installed on your machine.

- If PHP is not installed, follow the appropriate guide to install it: [PHP Installation Guide](https://www.php.net/manual/en/install.php)

- If Composer is not installed, download and install it from [Composer Official Website](https://getcomposer.org/download/)

### Install Dependencies

Run the following command in your terminal to install project dependencies:

```bash
composer install
```

### Create Environment File

Create a `.env` file in the project root by copying the contents from `.env.example`:

```bash
mv .env.example .env
```

### Configure Database

In the `.env` file, substitute the database credentials with your own:

```dotenv
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Generate App Key

Generate the application key using:

```bash
php artisan key:generate
```

### Migrate Tables

Migrate tables using:

```bash
php artisan migrate
```

### Seed Values for Projects and Tasks

Seed dummy values for the projects and tasks module using:

```bash
php artisan db:seed
```

Note: Please ensure that there are dummy values for the projects.
### Run the Application

Start the application by running the following command:

```bash
php artisan serve
```

This will launch the application, and you can access it in your browser at [http://localhost:8000](http://localhost:8000).

