<?php
// Combined login and registration page with slider effect
// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pastikan session dimulai dan bersih
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Reset session jika ada masalah
if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    session_destroy();
    session_start();
    header('Location: slider_auth.php');
    exit;
}

// Set base path
define('BASE_PATH', dirname(__DIR__));

// Load database connection dan AdminRepository
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/repositories/AdminRepository.php';

// Load file autentikasi (tanpa redirect loop)
$loginPage = true; // Tandai ini sebagai halaman login
require_once 'auth.php';

$login_error = '';
$login_success = '';
$register_error = '';
$register_success = '';

// Cek apakah ada pesan sukses logout
if (isset($_SESSION['logout_success'])) {
    $login_success = $_SESSION['logout_success'];
    unset($_SESSION['logout_success']);
    // Log untuk debugging
    error_log("Logout success message displayed: $login_success");
}

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $login_error = 'Semua field harus diisi!';
    } else {
        if (authenticateAdmin($username, $password)) {
            // Redirect ke dashboard jika berhasil login
            header('Location: index.php');
            exit;
        } else {
            $login_error = 'Username atau password salah!';
        }
    }
}

// Process registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    
    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $register_error = 'Username dan password harus diisi.';
    } elseif ($password !== $confirm_password) {
        $register_error = 'Password dan konfirmasi password tidak sama.';
    } elseif (strlen($password) < 6) {
        $register_error = 'Password minimal harus 6 karakter.';
    } else {
        // Registrasi admin baru
        $adminRepo = new AdminRepository();
        $result = $adminRepo->registerAdmin($username, $password, $name, $email);
        
        if ($result['success']) {
            $register_success = $result['message'] . ' Silakan login.';
            // Auto-switch to login panel
            echo "<script>window.onload = function() { document.querySelector('.container').classList.remove('right-panel-active'); }</script>";
        } else {
            $register_error = $result['message'];
        }
    }
}

// Check if we should start on the register panel
$start_on_register = isset($_GET['register']) && $_GET['register'] == 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Foody Admin - Login & Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ffd700;
            --secondary-color: #000000;
            --text-color: #ffffff;
            --light-text: #cccccc;
            --border-color: #333333;
            --danger-color: #ff6b6b;
            --success-color: #2ecc71;
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        html, body {
            height: 100%;
            overflow: hidden;
        }
        
        body {
            background-color: #000000;
            background-image: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        
        /* Container styles */
        .container {
            position: relative;
            width: 900px;
            height: 600px;
            max-width: 100%;
            min-height: 500px;
            background: #000;
            border-radius: 15px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                        0 10px 10px rgba(0,0,0,0.22);
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../assets/img/login.gif');
            background-size: cover;
            background-position: 0 0;
            z-index: 1;
            transition: transform 0.6s ease-in-out;
        }
        
        .container.right-panel-active::before {
            transform: translateX(-50%);
        }
        
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            transition: all 0.6s ease-in-out;
            z-index: 2;
        }
        
        .sign-in-container {
            left: 0;
            z-index: 2;
        }
        
        .sign-up-container {
            left: 0;
            opacity: 0;
            width: 50%;
            z-index: 1;
        }
        
        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }
        
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }
        
        /* Overlay container */
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 10;
        }
        
        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }
        
        .overlay {
            position: relative;
            color: #fff;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            background-color: rgba(0, 0, 0, 0.7);
        }
        
        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }
        
        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        
        .overlay-left {
            transform: translateX(-20%);
        }
        
        .overlay-right {
            right: 0;
            transform: translateX(0);
        }
        
        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }
        
        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
        
        /* Form styles */
        form {
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            padding: 50px 50px;
            height: 100%;
            justify-content: center;
            text-align: center;
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        p {
            font-size: 14px;
            margin-bottom: 20px;
            color: var(--light-text);
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: #121212;
            color: var(--text-color);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        }
        
        button {
            padding: 12px 20px;
            border-radius: 20px;
            border: 1px solid var(--primary-color);
            background-color: var(--primary-color);
            color: #000;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
            margin-top: 15px;
        }
        
        button:hover {
            background-color: #e6c200;
        }
        
        button:active {
            transform: scale(0.95);
        }
        
        button.ghost {
            background-color: transparent;
            border-color: #ffffff;
            color: #ffffff;
        }
        
        button.ghost:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .social-container {
            margin: 20px 0;
        }
        
        .social-container a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .social-container a:hover {
            background-color: var(--primary-color);
            color: #000;
            transform: translateY(-3px);
        }
        
        .alert {
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            color: var(--danger-color);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: var(--success-color);
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        .brand-container {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            z-index: 20;
        }
        
        .brand-icon {
            font-size: 24px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 215, 0, 0.2);
            border-radius: 8px;
            margin-right: 10px;
        }
        
        .brand-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .home-link {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 20;
            background-color: var(--primary-color);
            color: #000;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }
        
        .home-link i {
            margin-right: 5px;
        }
        
        .home-link:hover {
            background-color: #e6c200;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .container {
                width: 90%;
                height: 80vh;
            }
            
            .form-container form {
                padding: 20px;
            }
            
            .overlay-panel {
                padding: 20px;
            }
            
            h1 {
                font-size: 20px;
            }
            
            .overlay-container, .form-container {
                width: 100%;
            }
            
            .sign-in-container {
                left: 0;
                width: 100%;
                z-index: 2;
            }
            
            .sign-up-container {
                left: 0;
                width: 100%;
                opacity: 0;
                z-index: 1;
            }
            
            .container::before {
                background-position: center; 
            }
            
            .overlay-container {
                display: none;
            }
            
            .container.right-panel-active .sign-in-container {
                transform: translateX(-100%);
            }
            
            .container.right-panel-active .sign-up-container {
                transform: translateX(0);
                opacity: 1;
                z-index: 5;
            }
            
            .mobile-toggle {
                display: block;
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 20;
                text-align: center;
                width: 100%;
            }
            
            .brand-container {
                top: 10px;
                left: 10px;
            }
            
            .home-link {
                bottom: 10px;
                right: 10px;
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="brand-container">
        <div class="brand-icon">
            <i class="fas fa-utensils"></i>
        </div>
        <div class="brand-name">Foody Admin</div>
    </div>
    
    <a href="../index.php" class="home-link">
        <i class="fas fa-home"></i> Kembali ke Website
    </a>
    
    <div class="container <?php echo $start_on_register ? 'right-panel-active' : ''; ?>">
        <!-- Login Form Container -->
        <div class="form-container sign-in-container">
            <form method="post" action="slider_auth.php">
                <input type="hidden" name="action" value="login">
                <h1>Welcome Back</h1>
                <p>Masuk ke dashboard admin Anda</p>
                
                <?php if ($login_error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i> <?= $login_error ?>
                </div>
                <?php endif; ?>
                
                <?php if ($login_success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <?= $login_success ?>
                </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username Anda" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" required>
                </div>
                
                <div style="text-align: right; margin-bottom: 15px;">
                    <a href="#" style="color: var(--primary-color); text-decoration: none; font-size: 14px;">Lupa Password?</a>
                </div>
                
                <button type="submit">Masuk</button>
                
                <div class="social-container">
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </form>
        </div>
        
        <!-- Register Form Container -->
        <div class="form-container sign-up-container">
            <form method="post" action="slider_auth.php">
                <input type="hidden" name="action" value="register">
                <h1>Buat Akun</h1>
                <p>Daftar sebagai administrator baru</p>
                
                <?php if ($register_error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i> <?= $register_error ?>
                </div>
                <?php endif; ?>
                
                <?php if ($register_success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <?= $register_success ?>
                </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="reg-name">Nama Lengkap</label>
                    <input type="text" name="name" id="reg-name" class="form-control" placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="form-group">
                    <label for="reg-email">Email</label>
                    <input type="email" name="email" id="reg-email" class="form-control" placeholder="Masukkan email">
                </div>
                
                <div class="form-group">
                    <label for="reg-username">Username</label>
                    <input type="text" name="username" id="reg-username" class="form-control" placeholder="Pilih username" required>
                </div>
                
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" name="password" id="reg-password" class="form-control" placeholder="Pilih password (min. 6 karakter)" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm-password">Konfirmasi Password</label>
                    <input type="password" name="confirm_password" id="confirm-password" class="form-control" placeholder="Konfirmasi password" required>
                </div>
                
                <button type="submit">Daftar</button>
            </form>
        </div>
        
        <!-- Overlay Panel -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Selamat Datang Kembali!</h1>
                    <p>Untuk tetap terhubung dengan kami, silakan login dengan informasi akun Anda</p>
                    <button class="ghost" id="signIn">Masuk</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Halo, Teman!</h1>
                    <p>Daftar dengan informasi personal Anda untuk mengakses panel admin restoran</p>
                    <button class="ghost" id="signUp">Daftar</button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Toggle (Only visible on small screens) -->
        <div class="mobile-toggle" style="display: none;">
            <button class="ghost" id="mobileToggle">Beralih ke Daftar</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const mobileToggle = document.getElementById('mobileToggle');
            
            // Handle panel toggle
            signUpButton.addEventListener('click', () => {
                container.classList.add('right-panel-active');
                updateMobileButtonText();
            });
            
            signInButton.addEventListener('click', () => {
                container.classList.remove('right-panel-active');
                updateMobileButtonText();
            });
            
            // Handle mobile toggle button
            mobileToggle.addEventListener('click', () => {
                container.classList.toggle('right-panel-active');
                updateMobileButtonText();
            });
            
            // Update mobile button text
            function updateMobileButtonText() {
                if (container.classList.contains('right-panel-active')) {
                    mobileToggle.textContent = 'Beralih ke Login';
                } else {
                    mobileToggle.textContent = 'Beralih ke Daftar';
                }
            }
            
            // Show mobile toggle on small screens
            function handleWindowResize() {
                const mobileToggleDiv = document.querySelector('.mobile-toggle');
                if (window.innerWidth <= 768) {
                    mobileToggleDiv.style.display = 'block';
                } else {
                    mobileToggleDiv.style.display = 'none';
                }
            }
            
            // Initial setup
            handleWindowResize();
            updateMobileButtonText();
            
            // Listen for window resize
            window.addEventListener('resize', handleWindowResize);
        });
    </script>
</body>
</html>
