<?php
// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=guestbook', 'username', 'password');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// User authentication
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    // Authenticate the user
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    // Assume we have a users table with username and password_hash columns
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Redirect to the guestbook page
        header('Location: guestbook.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

// Input validation
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Add entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = validate_input($_POST['message']);
    if (!empty($message)) {
        $stmt = $db->prepare("INSERT INTO entries (user_id, message) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $message]);
        // Redirect to the guestbook page to refresh entries
        header('Location: guestbook.php');
        exit();
    } else {
        $error = "Message cannot be empty.";
    }
}

// Get entries
$stmt = $db->query("SELECT * FROM entries ORDER BY id DESC");
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
