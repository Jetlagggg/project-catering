<?php
// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current page
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>    <title><?= $pageTitle ?? 'Admin Panel - Foody Catering' ?></title>
    <link rel="stylesheet" href="../admin/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* CSS Backup untuk memastikan tampilan admin bekerja */
        body {
            background-color: #000000;
            color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            background-color: #121212;
            border-right: 1px solid #333333;
        }        .main-header {
            background-color: #121212;
            border-bottom: 1px solid #333333;
        }
        
        .logout-btn {
            padding: 4px 10px;
            border-radius: 4px;
            border: 1px solid #ffd700;
            color: #ffd700;
            transition: all 0.3s;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .logout-btn:hover {
            background-color: #ffd700;
            color: #000000;
            transform: translateY(-2px);
        }
        
        .admin-profile {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <button class="mobile-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">
                <i class="fas fa-utensils logo-icon"></i>
                <h1>Foody Admin</h1>
            </div>            <div class="header-spacer"></div>            <div class="admin-profile">
                <span class="admin-name"><?= $_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Admin' ?></span>
                <!-- Simple logout button -->
                <a href="/TubesYos/admin/force_logout.php" class="logout-btn btn btn-sm btn-outline-warning ml-2" title="Logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </header>
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-profile">
                <div class="user-avatar">
                    <?= substr($_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'AD', 0, 2) ?>
                </div>
                <span><?= $_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Administrator' ?></span>
            </div>
            
            <ul class="sidebar-menu">
                <li class="<?= $current_page === 'index' ? 'active' : '' ?>">
                    <a href="index.php">
                        <i class="fas fa-tachometer-alt"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?= $current_page === 'menu_management' ? 'active' : '' ?>">
                    <a href="menu_management.php">
                        <i class="fas fa-utensils"></i> 
                        <span>Manajemen Menu</span>
                    </a>
                </li>
                <li class="<?= $current_page === 'orders' ? 'active' : '' ?>">
                    <a href="orders.php">
                        <i class="fas fa-shopping-cart"></i> 
                        <span>Pesanan</span>
                    </a>
                </li>
                <li class="<?= $current_page === 'users' ? 'active' : '' ?>">
                    <a href="users.php">
                        <i class="fas fa-users"></i> 
                        <span>Pengguna</span>
                    </a>
                </li>
                <li class="<?= $current_page === 'settings' ? 'active' : '' ?>">
                    <a href="settings.php">
                        <i class="fas fa-cog"></i> 
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>        </aside>
        
        <!-- Main Content Wrapper -->
        <div class="main-content">
        <!-- Content will be inserted here -->
