<?php
// File debugging untuk mendeteksi masalah
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h3>PHP Environment Check</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Error display setting: " . ini_get('display_errors') . "</p>";
echo "<p>Error reporting level: " . error_reporting() . "</p>";

// Cek Session
session_start();
echo "<h3>Session Check</h3>";
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Active: " . (session_status() === PHP_SESSION_ACTIVE ? "Yes" : "No") . "</p>";

// Cek Database
echo "<h3>Database Check</h3>";
try {
    require_once dirname(__DIR__) . '/config/database.php';
    $database = new Database();
    $conn = $database->connect();
    echo "<p style='color:green'>Database connection successful!</p>";
    
    // Check if admins table exists
    $stmt = $conn->prepare("SHOW TABLES LIKE 'admins'");
    $stmt->execute();
    $tableExists = $stmt->rowCount() > 0;
    
    echo "<p>Admins table exists: " . ($tableExists ? "Yes" : "No") . "</p>";
    
    if ($tableExists) {
        // Check if any admin exists
        $stmt = $conn->query("SELECT COUNT(*) as count FROM admins");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>Number of admins in database: " . $result['count'] . "</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color:red'>Database connection error: " . $e->getMessage() . "</p>";
}

// Cek File Paths
echo "<h3>File Path Check</h3>";
echo "<p>Current script: " . __FILE__ . "</p>";
echo "<p>Document root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Base path: " . dirname(__DIR__) . "</p>";
echo "<p>Login.php exists: " . (file_exists(__DIR__ . '/login.php') ? "Yes" : "No") . "</p>";
echo "<p>Auth.php exists: " . (file_exists(__DIR__ . '/auth.php') ? "Yes" : "No") . "</p>";
echo "<p>AdminRepository.php exists: " . (file_exists(dirname(__DIR__) . '/repositories/AdminRepository.php') ? "Yes" : "No") . "</p>";

// Check if admin.css exists
echo "<p>Admin CSS exists: " . (file_exists(__DIR__ . '/css/admin.css') ? "Yes" : "No") . "</p>";
echo "<p>Admin CSS filesize: " . (file_exists(__DIR__ . '/css/admin.css') ? filesize(__DIR__ . '/css/admin.css') . " bytes" : "N/A") . "</p>";

// Output directory structure for admin folder
echo "<h3>Admin Folder Structure</h3>";
function listFolderFiles($dir, $indent = 0) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        echo str_repeat("&nbsp;", $indent * 4) . $file;
        if (is_dir($dir . '/' . $file)) {
            echo " (folder)<br>";
            listFolderFiles($dir . '/' . $file, $indent + 1);
        } else {
            echo "<br>";
        }
    }
}

listFolderFiles(__DIR__);
?>
