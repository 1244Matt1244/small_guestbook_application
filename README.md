# Guestbook Application

## Overview
The Guestbook Application is a PHP project that allows users to log in and add entries to a guestbook. It uses a MySQL database to store user credentials and guestbook entries. The application includes secure authentication, input validation, and error handling.

## Prerequisites
- MySQL database server
- Web server with PHP support (e.g., Apache, Nginx)
- PHP 7.4 or higher with `pdo_mysql` extension

## Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/1244Matt1244/small_guestbook_application.git
    ```
2. Create a MySQL database named `guestbook` and import the provided SQL schema.
3. Update the database connection parameters in `config.php`.

## Usage
1. Open the application in your web browser.
2. Register users by inserting them into the `users` table with a hashed password.
3. Users can log in, view existing entries, and add new ones.

## Security
- **CSRF Protection**: Tokens are used in forms to prevent CSRF attacks.
- **Password Hashing**: Passwords are hashed using PHP's `password_hash()` function.
- **Session Management**: Sessions are handled securely, with timeouts and regeneration of session IDs.
