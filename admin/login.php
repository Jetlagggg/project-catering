<?php
// Halaman login untuk admin panel

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
    header('Location: login.php');
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

$error = '';
$success = '';

// Cek apakah ada pesan sukses logout
if (isset($_SESSION['logout_success'])) {
    $success = $_SESSION['logout_success'];
    unset($_SESSION['logout_success']);
    // Log untuk debugging
    error_log("Logout success message displayed: $success");
}

// Process the login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Semua field harus diisi!';
    } else {
        if (authenticateAdmin($username, $password)) {
            // Redirect ke dashboard jika berhasil login
            header('Location: index.php');
            exit;
        } else {
            $error = 'Username atau password salah!';
        }
    }
}

// Process registration
$register_error = '';
$register_success = '';

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
    <title>Login - Family 88 Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color:rgb(0, 0, 0);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }          .container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.15), 
                        0 10px 10px rgba(0,0,0,0.12);
            position: relative;
            overflow: hidden;
            width: 800px;
            max-width: 100%;
            min-height: 550px;
            animation: fadeIn 1s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }
        
        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }
        
        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }
        
        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }
        
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }
          @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        h1, form span, .social-container, form button, .input-group {
            animation: fadeIn 0.5s forwards;
        }
        
        .input-group:nth-child(1) { animation-delay: 0.1s; }
        .input-group:nth-child(2) { animation-delay: 0.2s; }
        .input-group:nth-child(3) { animation-delay: 0.3s; }
        .input-group:nth-child(4) { animation-delay: 0.4s; }
        .input-group:nth-child(5) { animation-delay: 0.5s; }
        
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }
        
        .container.right-panel-active .overlay-container{
            transform: translateX(-100%);
        }        .overlay {
            background-repeat: no-repeat;
            background-position: 0 0;
            color:rgb(0, 0, 0);
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        
        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }
        
        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            background-size: cover;
            background-position: center;
        }
        
        .overlay-left {
            transform: translateX(-20%);
            background-image: url('../assets/img/login.gif');
        }
          .overlay-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }
          .overlay-right {
            right: 0;
            transform: translateX(0);
            background-image: url('../assets/img/login.gif');
        }
        
        .overlay-right::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }        .overlay-panel h1, .overlay-panel p, .overlay-panel button {
            position: relative;
            z-index: 2;
            animation: fadeInScale 0.8s ease;
        }
        
        @keyframes fadeInScale {
            0% { opacity: 0; transform: translateY(20px) scale(0.9); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
          .overlay-panel h1 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            letter-spacing: 0.5px;
        }
        
        .overlay-panel p {
            font-size: 16px;
            margin-bottom: 25px;
            line-height: 1.6;
            max-width: 280px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
            transition: all 0.6s ease-in-out;
        }
        
        h1 {
            font-weight: bold;
            margin: 0 0 15px 0;
            font-size: 24px;
            color: #333;
        }
        
        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);            color: #333;
            font-size: 16px;
        }
        
        form input {
            background-color: rgba(0, 0, 0, 0.3);
            border: none;
            padding: 12px 15px 12px 45px;
            margin: 8px 0;
            width: 100%;
            border-radius: 25px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
          form input:focus {
            outline: none;
            background-color: #f5f5f5;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 10px 0 20px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
        }
        
        .remember-me input {
            width: auto;
            margin: 0 5px 0 0;
        }
          .forgot-link {
            color: #555;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-link:hover {
            color: #000;
            text-decoration: underline;
        }          button.btn-primary {
            border-radius: 25px;
            border: 1px solid #333;
            background-color: #333;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        button.btn-primary:hover {
            background-color: #444;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        button.btn-primary:active {
            transform: scale(0.95);        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
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
            background-image: url('../assets/img/login.gif');
            background-size: cover;
            background-position: center;
        }        .overlay-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }        .overlay-right {
            right: 0;
            transform: translateX(0);
            background-image: url('../assets/img/login.gif');
            background-size: cover;
            background-position: center;
        }        .overlay-right::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;            color: #333;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .social-container a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: #fff;
        }
        
        .social-container a:nth-child(1):hover {
            background-color: #3b5998; /* Facebook color */
            border-color: #3b5998;
        }
        
        .social-container a:nth-child(2):hover {
            background-color: #db4437; /* Google color */
            border-color: #db4437;
        }
        
        .social-container a:nth-child(3):hover {
            background-color: #0077b5; /* LinkedIn color */
            border-color: #0077b5;
        }        /* Error and success messages */
        .error-message, .success-message {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 25px;
            text-align: left;
            width: 100%;
            font-size: 14px;
            display: flex;
            align-items: center;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-message {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.3);
            color: #e74c3c;
        }
        
        .error-message i, .success-message i {
            margin-right: 10px;
            font-size: 16px;
        }

        .success-message {
            background-color: rgba(46, 204, 113, 0.1);
            border: 1px solid rgba(46, 204, 113, 0.3);
            color: #2ecc71;
        }
          .home-link {
            margin-top: 40px;
            text-align: center;
        }
        
        .home-link a {
            color: #fff;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .home-link a i {
            margin-right: 6px;
        }
        
        .home-link a:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }
          .login-header h1 {
            font-size: 24px;
            color: #ffd700; /* Gold color for title */
            margin-bottom: 5px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        
        .login-header p {
            color: #ffffff; /* White text */
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
          .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #ffffff; /* White color for labels */
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid #333; /* Darker border */
            border-radius: 8px;
            transition: var(--transition);
            color: #ffffff; /* White text */
            background-color: #121212; /* Dark input background */
        }
        
        .form-control:focus {
            outline: none;
            border-color: #ffd700; /* Gold border on focus */
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2); /* Gold glow */
        }
          .btn {
            display: inline-block;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            text-decoration: none;
        }
          button.ghost {
            background-color: transparent;
            border: 2px solid #ffffff;
            color: #ffffff;
            border-radius: 25px;
            padding: 12px 45px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 14px;
        }
        
        button.ghost:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
          button.ghost:active {
            transform: translateY(-1px);
        }
        
        .form-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .form-subtitle:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background-color: #5cc9c1;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        
        form:hover .form-subtitle:after {
            width: 80px;
        }
          .btn-primary {
            background-color: #ffd700; /* Gold button */
            color: #000000; /* Black text */
            width: 100%;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3); /* Gold glow */
        }
        
        .btn-primary:hover {
            background-color: #f5cc00; /* Slightly darker gold on hover */
            transform: translateY(-2px); /* Subtle lift effect */
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
          .remember-me label {
            font-size: 14px;
            color: #cccccc; /* Light gray text */
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            font-size: 14px;
            color: #ffd700; /* Gold link */
            text-decoration: none;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
            color: #fff; /* White text on hover */
        }
        
        .social-login {
            margin-top: 30px;
            text-align: center;
        }
          .social-login p {
            color: #cccccc; /* Light gray text */
            margin-bottom: 15px;
            position: relative;
        }
        
        .social-login p::before,
        .social-login p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #333; /* Darker separator line */
        }
        
        .social-login p::before {
            left: 0;
        }
        
        .social-login p::after {
            right: 0;
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
          .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            border: 1px solid #333; /* Darker border */
            border-radius: 8px;
            transition: var(--transition);
            text-decoration: none;
            color: #ffffff; /* White text */
            font-size: 14px;
            background-color: #121212; /* Dark background */
        }
        
        .social-icon i {
            margin-right: 8px;
            font-size: 18px;
        }
        
        .social-icon.google i {
            color: #DB4437; /* Keep Google red */
        }
        
        .social-icon.facebook i {
            color: #4267B2; /* Keep Facebook blue */
        }
        
        .social-icon:hover {
            background-color: #1a1a1a; /* Slightly lighter on hover */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Shadow for depth */
            border-color: #555; /* Lighter border on hover */
        }
          .sign-up {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #cccccc; /* Light gray text */
        }
        
        .sign-up a {
            color: #ffd700; /* Gold link */
            text-decoration: none;
            font-weight: 600;
        }
        
        .sign-up a:hover {
            text-decoration: underline;
            color: #ffffff; /* White text on hover */
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2); /* Darker red background */
            color: #ff6b6b; /* Brighter red text */
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.2); /* Darker green background */
            color: #2ecc71; /* Brighter green text */
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }
          .brand-icon {
            font-size: 24px;
            color: #ffd700; /* Gold icon */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 215, 0, 0.2); /* Gold background with opacity */
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.3); /* Gold glow */
        }
        
        .brand-name {
            font-size: 20px;
            font-weight: 700;
            color: #ffd700; /* Gold text */
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5); /* Shadow for better visibility */
        }/* Responsive adjustments */        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                min-height: 500px;
                width: 90%;
            }
            
            form {
                padding: 0 30px;
            }
            
            .overlay-panel {
                padding: 0 20px;
            }
            
            .overlay-panel h1 {
                font-size: 22px;
            }
            
            .overlay-panel p {
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 15px;
            }
            
            .container {
                height: 100%;
                min-height: 90vh;
                width: 100%;
                border-radius: 15px;
            }
            
            form {
                padding: 0 20px;
            }
            
            h1 {
                font-size: 20px;
            }
            
            .overlay-panel h1 {
                font-size: 20px;
            }
            
            .overlay-panel p {
                font-size: 13px;
                margin-bottom: 15px;
            }
            
            button.ghost {
                padding: 10px 25px;
                font-size: 12px;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .forgot-link {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>    <div class="container <?php echo $start_on_register ? 'right-panel-active' : ''; ?>">
        <div class="form-container sign-up-container">
            <form method="post" action="login.php">
                <input type="hidden" name="action" value="register">                <h1>Register hire.</h1>
                <div class="social-container">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span class="form-subtitle">or use your email for registration</span>
                
                <?php if ($register_error): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?= $register_error ?>
                </div>
                <?php endif; ?>
                
                <?php if ($register_success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> <?= $register_success ?>
                </div>
                <?php endif; ?>
                  <div class="input-group">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" placeholder="Name" />
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email" />
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-user-circle"></i></span>
                    <input type="text" name="username" placeholder="Username" required />
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-shield-alt"></i></span>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="post" action="login.php">
                <input type="hidden" name="action" value="login">                <h1>Hello Friend!</h1>
                <div class="social-container">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span class="form-subtitle">If you already have an account login here and have fun!</span>
                
                <?php if ($error): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> <?= $success ?>
                </div>
                <?php endif; ?>
                  <div class="input-group">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="username" placeholder="Username" required />
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">                <div class="overlay-panel overlay-left">
                    <h1>If you already have an account login here and have fun!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Login</button>
                    <div class="home-link">
                        <a href="../index.php"><i class="fas fa-home"></i> Kembali ke Website</a>
                    </div>
                </div>                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start your journey with us</p>
                    <button class="ghost" id="signUp">SIGN UP</button>
                    <div class="home-link">
                        <a href="../index.php"><i class="fas fa-home"></i> Kembali ke Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.querySelector('.container');

            signUpButton.addEventListener('click', () => {
                container.classList.add('right-panel-active');
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove('right-panel-active');
            });
        });
    </script>
</body>
</html>
