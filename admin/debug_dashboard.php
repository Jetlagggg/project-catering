<?php
// Debug script to check admin dashboard loading

// Enable error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<h1>Admin Dashboard Debug</h1>";
echo "<h2>Session Variables:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>PHP Info:</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";

// Check class availability
echo "<h2>Class Availability:</h2>";
echo "AdminRepository exists: " . (class_exists('AdminRepository') ? 'Yes' : 'No') . "<br>";
echo "MenuRepository exists: " . (class_exists('MenuRepository') ? 'No, will load' : 'No, will load') . "<br>";

// Try to load repositories
echo "<h2>Loading Repositories:</h2>";
try {
    require_once '../repositories/MenuRepository.php';
    echo "MenuRepository loaded successfully<br>";
    
    require_once '../repositories/AdminRepository.php';
    echo "AdminRepository loaded successfully<br>";
    
    $menuRepo = new MenuRepository();
    echo "MenuRepository instantiated<br>";
    
    $menuCount = $menuRepo->countAll();
    echo "Menu count: $menuCount<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

// Add a link to go back to dashboard
echo "<hr>";
echo "<a href='index.php'>Go back to dashboard</a>";
?>
