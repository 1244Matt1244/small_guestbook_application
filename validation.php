<?php
function validate_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function isValidUsername($username) {
    // Example: Ensure username is alphanumeric and between 3-20 characters
    return preg_match('/^[a-zA-Z0-9]{3,20}$/', $username);
}

function isValidPassword($password) {
    // Example: Ensure password is at least 8 characters with numbers and letters
    return strlen($password) >= 8 && preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password);
}
?>
