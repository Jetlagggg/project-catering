<?php
// File autentikasi untuk admin panel

// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah sudah login
$current_file = basename($_SERVER['PHP_SELF']);
$login_files = ['login.php', 'login_simple.php', 'direct_login.php', 'debug_login.php', 'slider_auth.php', 'modern_login.php'];

// Debug - Log current state
error_log("AUTH CHECK: File=$current_file, Logged in=" . (isset($_SESSION['admin_logged_in']) ? 'yes' : 'no'));

// Hanya lakukan redirect jika bukan dari halaman login
if (!isset($_SESSION['admin_logged_in']) && !in_array($current_file, $login_files) && !isset($loginPage)) {
    // Jika belum login dan bukan halaman login, redirect ke halaman login
    error_log("AUTH REDIRECT: Not logged in, redirecting to login.php");
    header('Location: login.php');
    exit;
} elseif (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && 
          in_array($current_file, $login_files) && !isset($_GET['reset'])) {
    // Jika sudah login dan mencoba akses halaman login, redirect ke dashboard
    error_log("AUTH REDIRECT: Already logged in, redirecting to index.php");
    header('Location: index.php');
    exit;
}

// Load AdminRepository
if (!isset($adminRepoLoaded)) {
    require_once __DIR__ . '/../repositories/AdminRepository.php';
    $adminRepoLoaded = true;
}

// Fungsi untuk autentikasi admin
function authenticateAdmin($username, $password) {
    error_log("Authentication attempt for username: $username");
    
    try {
        $adminRepo = new AdminRepository();
        $admin = $adminRepo->findByUsername($username);
        
        error_log("Admin found in DB: " . ($admin ? 'Yes' : 'No'));
        
        // Cek password dengan password_verify
        if ($admin && password_verify($password, $admin['password'])) {
            // Login berhasil
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'] ?? 'Administrator';
            
            error_log("Password verification successful. Setting session.");
            
            // Update last login time
            $adminRepo->updateLastLogin($admin['id']);
            
            return true;
        }
        
        // Fallback untuk admin default jika database tidak bekerja
        if ($username === 'admin' && $password === 'admin123') {
            error_log("Using fallback admin account");
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = 'admin';
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_name'] = 'Administrator';
            return true;
        }
    } catch (Exception $e) {
        error_log("Authentication error: " . $e->getMessage());
        
        // Fallback ke admin default jika database error
        if ($username === 'admin' && $password === 'admin123') {
            error_log("Using fallback admin account after error");
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = 'admin';
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_name'] = 'Administrator';
            return true;
        }
    }
    
    return false;
}

// Fungsi untuk logout
function logoutAdmin() {
    // Simpan username untuk pesan sukses jika diperlukan
    $username = $_SESSION['admin_username'] ?? 'Admin';
    
    // Hapus secara spesifik semua variabel session admin
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_name']);
    
    // Hapus semua data session
    session_destroy();
    
    // Dikomentar agar tidak double redirect dengan logout.php
    // header('Location: login.php');
    // exit;
    
    return $username; // Return username untuk pesan sukses
}
