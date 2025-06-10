<?php
// Test untuk proses logout
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

echo "<h1>Test Proses Logout</h1>";

// Tampilkan status login saat ini
echo "<h2>Status Login Sebelum Logout:</h2>";
echo "admin_logged_in: " . (isset($_SESSION['admin_logged_in']) ? 'yes' : 'no') . "<br>";
echo "admin_username: " . ($_SESSION['admin_username'] ?? 'tidak ada') . "<br>";
echo "admin_id: " . ($_SESSION['admin_id'] ?? 'tidak ada') . "<br>";

// Jika tidak login, tampilkan link untuk login
if (!isset($_SESSION['admin_logged_in'])) {
    echo "<p>Anda belum login. <a href='login.php'>Login disini</a></p>";
} else {
    // Tampilkan link untuk logout
    echo "<p>Anda sudah login. <a href='logout.php'>Logout disini</a></p>";
    
    // Tampilkan link untuk dashboard
    echo "<p><a href='index.php'>Pergi ke Dashboard</a></p>";
}

// Tampilkan semua data session untuk debugging
echo "<h2>Semua Data Session:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Tambahkan link untuk kembali ke halaman login
echo "<p><a href='login.php'>Kembali ke Login</a></p>";
?>
