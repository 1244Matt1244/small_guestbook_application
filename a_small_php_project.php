<?php
require_once 'config.php';  // Database connection
require_once 'csrf.php';     // CSRF protection
require_once 'validation.php'; // Input validation
require_once 'session.php';  // Session management

session_start();

// User authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die('CSRF validation failed.');
    }

    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    if (!isValidUsername($username) || !isValidPassword($password)) {
        $error = "Invalid input format.";
    } else {
        // Fetch user from the database
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(); // Prevent session fixation
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: guestbook.php');
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}

// Add guestbook entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die('CSRF validation failed.');
    }

    $message = validate_input($_POST['message']);
    if (!empty($message)) {
        $stmt = $db->prepare("INSERT INTO entries (user_id, message) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $message]);
        header('Location: guestbook.php');
        exit();
    } else {
        $error = "Message cannot be empty.";
    }
}

// Fetch entries
$stmt = $db->query("SELECT entries.*, users.username FROM entries JOIN users ON entries.user_id = users.id ORDER BY entries.id DESC");
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
