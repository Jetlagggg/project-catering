<?php
// Halaman registrasi admin baru

// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pastikan session dimulai dan bersih
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login page with register flag
header('Location: login.php?register=1');
exit;

// The code below is kept for backwards compatibility but will not execute

// Set base path
define('BASE_PATH', dirname(__DIR__));

// Load database connection dan AdminRepository
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/repositories/AdminRepository.php';

// Load file autentikasi (tanpa redirect loop)
$loginPage = true; // Tandai ini sebagai halaman login
require_once 'auth.php';

$error = '';
$success = '';

// Cek apakah form registrasi disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    
    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'Username dan password harus diisi.';
    } elseif ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak sama.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal harus 6 karakter.';
    } else {
        // Registrasi admin baru
        $adminRepo = new AdminRepository();
        $result = $adminRepo->registerAdmin($username, $password, $name, $email);
        
        if ($result['success']) {
            $success = $result['message'] . ' Silakan <a href="login.php">login</a>.';
        } else {
            $error = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration - Foody Catering</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* CSS Tambahan untuk memastikan tampilan registrasi bekerja */
        body {
            background-color: #000000;
            color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: radial-gradient(circle at center, rgba(255, 215, 0, 0.08) 0%, rgba(0, 0, 0, 0) 70%);
        }
        .login-box {
            background-color: #121212;
            border: 1px solid #333333;
            border-radius: 10px;
            padding: 2rem;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        .login-logo i {
            color: #ffd700;
        }
        .btn-primary {
            background-color: #ffd700;
            color: #000000;
            border: none;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #e6c200;
            color: #000000;
        }
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-utensils"></i>
                    <h1>Foody</h1>
                </div>
                <p>Registrasi Admin Baru</p>
            </div>
            
            <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
            <?php endif; ?>
            
            <form class="login-form" method="post" action="register.php">
                <div class="form-group">
                    <label for="username">Username <span class="required">*</span></label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password <span class="required">*</span></label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
            
            <div class="back-to-site">
                <a href="login.php">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
