<?php
// Simple and direct logout file
// Aktifkan error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Log untuk debugging
file_put_contents('logout_debug.log', date('Y-m-d H:i:s') . " - Logout started\n", FILE_APPEND);
file_put_contents('logout_debug.log', date('Y-m-d H:i:s') . " - Session before: " . print_r($_SESSION, true) . "\n", FILE_APPEND);

// Hapus semua variabel session
$_SESSION = array();

// Hapus cookie session jika ada
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Destroy session
session_destroy();

// Start new session for success message
session_start();
$_SESSION['logout_success'] = "Anda berhasil logout.";

file_put_contents('logout_debug.log', date('Y-m-d H:i:s') . " - Session after: " . print_r($_SESSION, true) . "\n", FILE_APPEND);
file_put_contents('logout_debug.log', date('Y-m-d H:i:s') . " - Redirecting to login page\n", FILE_APPEND);

// Redirect dengan absolute path
echo '<script>window.location.href = "/TubesYos/admin/login.php";</script>';
?>
