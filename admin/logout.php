<?php
// Halaman logout untuk admin panel
session_start();

// Simpan nama user sebelum logout untuk pesan sukses
$username = $_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Admin';

// Load file autentikasi
require_once 'auth.php';

// Logout admin - fungsi return username
$loggedOutUsername = logoutAdmin();

// Mulai session baru untuk pesan sukses
session_start();
$_SESSION['logout_success'] = "Berhasil logout! Terima kasih, $username.";

// Log untuk debugging
error_log("Logout process completed for user: $username");

// Redirect ke halaman login modern
header('Location: modern_login.php');
exit;
?>
