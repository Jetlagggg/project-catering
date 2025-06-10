<?php
// Versi sederhana dari login.php untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Path dasar
define('BASE_PATH', dirname(__DIR__));

// Mencoba load database.php
try {
    require_once BASE_PATH . '/config/database.php';
    $db_load_success = true;
} catch (Exception $e) {
    $db_load_success = false;
    $db_error = $e->getMessage();
}

// Mencoba load AdminRepository.php
try {
    require_once BASE_PATH . '/repositories/AdminRepository.php';
    $repo_load_success = true;
} catch (Exception $e) {
    $repo_load_success = false;
    $repo_error = $e->getMessage();
}

$login_error = '';
$login_success = '';

// Proses login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Coba login dengan fallback ke admin/admin123
    if (($username === 'admin' && $password === 'admin123') || 
        ($repo_load_success && authenticateSimple($username, $password))) {
        
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_name'] = 'Administrator';
        
        $login_success = 'Login berhasil! Mengalihkan...';
        header('Location: index.php');
        exit;
    } else {
        $login_error = 'Username atau password salah';
    }
}

function authenticateSimple($username, $password) {
    try {
        $adminRepo = new AdminRepository();
        $admin = $adminRepo->findByUsername($username);
        
        if ($admin && password_verify($password, $admin['password'])) {
            return true;
        }
    } catch (Exception $e) {
        // Jika terjadi error, kembalikan false
        return false;
    }
    
    return false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Foody Catering (Simple)</title>
    <!-- Menggunakan Bootstrap untuk tampilan sederhana -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .diagnostic {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="header">
                <h2>Foody Admin</h2>
                <p>Login Panel (Simplified)</p>
            </div>
            
            <?php if ($login_error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($login_error) ?></div>
            <?php endif; ?>
            
            <?php if ($login_success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($login_success) ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <div class="mt-3 text-center">
                <a href="test_minimal.php">Run Minimal Test</a> | 
                <a href="../test.php">Test PHP</a>
            </div>
            
            <!-- Diagnostic information untuk debugging -->
            <div class="diagnostic">
                <strong>Diagnostic Info:</strong>
                <ul>
                    <li>PHP Version: <?= phpversion() ?></li>
                    <li>Session Active: <?= session_status() === PHP_SESSION_ACTIVE ? 'Yes' : 'No' ?></li>
                    <li>Database Load: <?= $db_load_success ? 'Success' : 'Failed - ' . ($db_error ?? 'Unknown error') ?></li>
                    <li>Repository Load: <?= $repo_load_success ? 'Success' : 'Failed - ' . ($repo_error ?? 'Unknown error') ?></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
