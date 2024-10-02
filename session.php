<?php
session_start();

// Set session timeout (e.g., 30 minutes)
$timeout = 1800;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    // Session has expired
    session_unset();
    session_destroy();
    header('Location: login.php?session_expired=true');
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp
?>
