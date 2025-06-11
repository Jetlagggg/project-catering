<!DOCTYPE html>
<html>
<head>
    <title>Logout Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 5px;
        }
        .btn-danger {
            background-color: #f44336;
        }
        .btn-warning {
            background-color: #ff9800;
        }
        pre {
            background-color: #f8f8f8;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Test Logout Admin Panel</h1>
        
        <?php
        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        // Start session
        session_start();
        
        echo "<h2>Session Status</h2>";
        echo "Session aktif: " . (session_status() === PHP_SESSION_ACTIVE ? 'Ya' : 'Tidak') . "<br>";
        echo "Session ID: " . session_id() . "<br>";
        
        echo "<h2>Login Status</h2>";
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
            echo "<p style='color:green'>Anda sedang login sebagai: <strong>" . 
                 ($_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Admin') . "</strong></p>";
        } else {
            echo "<p style='color:red'>Anda belum login</p>";
        }
        
        echo "<h2>Session Data</h2>";
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        ?>
        
        <h2>Aksi</h2>
        <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
            <a href="/TubesYos/admin/direct_logout.php" class="btn btn-danger">Logout (Link Direct)</a>
            <form method="post" action="/TubesYos/admin/direct_logout.php" style="display: inline;">
                <button type="submit" class="btn btn-warning">Logout (Form Submit)</button>
            </form>
        <?php else: ?>
            <a href="/TubesYos/admin/login.php" class="btn">Login</a>
        <?php endif; ?>
        
        <p><a href="/TubesYos/admin/" class="btn">Kembali ke Dashboard</a></p>
    </div>
</body>
</html>
