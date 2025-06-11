<?php
// Very minimalistic test file for admin folder
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Send plain text response
header('Content-Type: text/plain');

// Basic information
echo "PHP Version: " . phpversion() . "\n";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Path: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "URL Path: " . $_SERVER['REQUEST_URI'] . "\n\n";

// Test database connection
echo "Testing database connection...\n";
try {
    require_once '../config/database.php';
    $database = new Database();
    $conn = $database->connect();
    echo "Database connection: SUCCESS\n";
} catch (Exception $e) {
    echo "Database connection: FAILED\n";
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\nEnd of test.";
?>
