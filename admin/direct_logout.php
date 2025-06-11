<?php
// Direct logout file untuk mengatasi masalah logout
session_start();

// Log untuk debugging
error_log("Direct logout process started");

// Simpan nama user untuk pesan sukses
$username = $_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Admin';

// Hapus semua variabel session admin
unset($_SESSION['admin_logged_in']);
unset($_SESSION['admin_username']);
unset($_SESSION['admin_id']);
unset($_SESSION['admin_name']);

// Hapus semua session
session_destroy();

// Mulai session baru untuk pesan sukses
session_start();
$_SESSION['logout_success'] = "Berhasil logout! Terima kasih, $username.";

// Log untuk debugging
error_log("Direct logout completed, redirecting to login page");

// Redirect ke login page
echo "<script>window.location.href = '/TubesYos/admin/login.php';</script>";
exit;
?>
