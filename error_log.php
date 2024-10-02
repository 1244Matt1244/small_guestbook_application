<?php
ini_set('log_errors', 1);
ini_set('error_log', 'logs/php_errors.log');  // Store logs in a 'logs' directory

// Custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $logMessage = "Error [$errno]: $errstr in $errfile on line $errline";
    error_log($logMessage);
    return true;
}

set_error_handler('customErrorHandler');
?>
