### Guestbook Application Documentation

#### Overview
The Guestbook Application is a simple PHP project that allows users to log in and add entries to a guestbook. It uses a MySQL database to store user credentials and guestbook entries. The application includes basic authentication, input validation, and error handling.

#### Prerequisites
- A MySQL database server
- A web server with PHP support (e.g., Apache, Nginx)
- PHP 7.0 or higher

#### Database Schema
The application requires two tables in the MySQL database:

1. **users** table:
    - `id` (int): Primary key, auto-increment
    - `username` (varchar): Username
    - `password_hash` (varchar): Hashed password

2. **entries** table:
    - `id` (int): Primary key, auto-increment
    - `user_id` (int): Foreign key, references `users.id`
    - `message` (text): Guestbook entry message

#### Installation
1. Clone the repository to your web server directory:
    ```sh
    git clone https://github.com/1244Matt1244/small_guestbook_application.git
    ```
2. Set up the database:
    - Create a new database named `guestbook`.
    - Import the provided SQL schema to create the `users` and `entries` tables.
3. Update the database connection parameters in the PHP script:
    ```php
    $db = new PDO('mysql:host=localhost;dbname=guestbook', 'username', 'password');
    ```

#### Usage
1. **Login**:
    - Navigate to the application URL in your web browser.
    - Enter your username and password in the login form and submit.
    - If authentication is successful, you will be redirected to the guestbook page.

2. **Add Entry**:
    - On the guestbook page, enter your message in the textarea and submit.
    - Your entry will be added to the guestbook and displayed on the page.

#### Features
- **Authentication**: Users must log in with a valid username and password.
- **Input Validation**: User inputs are sanitized and validated to prevent SQL injection and XSS attacks.
- **Error Handling**: Error messages are displayed to the user for invalid login attempts and empty messages.

#### Security
- **Password Hashing**: Passwords are hashed using PHP's `password_hash` function and stored in the database.
- **Prepared Statements**: PDO prepared statements are used to prevent SQL injection.
- **HTML Sanitization**: User inputs are sanitized using `htmlspecialchars` to prevent XSS attacks.

#### Maintenance
- **Updates**: Check the GitHub repository for updates and new features.
- **Backup**: Regularly backup your database to prevent data loss.

#### Contact
For any issues or suggestions, please contact the repository maintainer at [1244Matt1244](https://github.com/1244Matt1244).

---

This documentation provides a basic understanding of the Guestbook Application's functionality, setup, and usage. For further customization or enhancements, refer to the source code and feel free to contribute to the project.
