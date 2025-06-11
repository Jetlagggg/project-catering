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
<head>    <title><?= $pageTitle ?? 'Admin Panel - Family 88 Catering' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Admin CSS - Load AFTER Bootstrap -->
    <link rel="stylesheet" href="css/admin.css">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script><style>        /* CSS Backup untuk memastikan tampilan admin bekerja */
        body {
            background-color: #000000 !important;
            color: #ffffff !important;
            font-family: 'Poppins', sans-serif !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }
          .wrapper {
            display: flex !important;
            min-height: 100vh !important;
            position: relative !important;
            background-color: #000000 !important;
        }
        
        /* OVERRIDE SIDEBAR STYLING */
        .sidebar {
            width: 280px !important;
            background: linear-gradient(180deg, #121212 0%, #1a1a1a 50%, #121212 100%) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            z-index: 99 !important;
            border-right: 2px solid #ffd700 !important;
            overflow-y: auto !important;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.4) !important;
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem !important;
            border-bottom: 2px solid #333333 !important;
            text-align: center !important;
            background: linear-gradient(135deg, #000000 0%, #121212 100%) !important;
            position: relative !important;
        }
        
        .sidebar-brand h2 {
            color: #ffd700 !important;
            font-size: 1.8rem !important;
            font-weight: 700 !important;
            margin: 0 !important;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.4) !important;
        }
        
        .sidebar-brand p {
            color: #cccccc !important;
            font-size: 0.9rem !important;
            margin: 0.8rem 0 0 0 !important;
        }
        
        .user-profile {
            padding: 2rem 1.5rem !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            border-bottom: 2px solid #333333 !important;
            background: linear-gradient(135deg, #1a1a1a 0%, #121212 100%) !important;
            margin: 1rem !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 215, 0, 0.1) !important;
        }
        
        .user-avatar {
            background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%) !important;
            color: #000000 !important;
            width: 70px !important;
            height: 70px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: 700 !important;
            font-size: 1.8rem !important;
            margin-bottom: 1.2rem !important;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4) !important;
        }
        
        .user-info h3 {
            color: #ffffff !important;
            font-size: 1.2rem !important;
            font-weight: 600 !important;
            margin: 0 0 0.5rem 0 !important;
        }
        
        .user-info p {
            color: #cccccc !important;
            font-size: 0.9rem !important;
            margin: 0 !important;
            padding: 0.3rem 1rem !important;
            background: rgba(255, 215, 0, 0.1) !important;
            border-radius: 20px !important;
            border: 1px solid rgba(255, 215, 0, 0.2) !important;
        }
        
        .sidebar-menu {
            list-style: none !important;
            padding: 1.5rem 1rem !important;
            margin: 0 !important;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.8rem !important;
        }
        
        .sidebar-menu li a {
            color: #ffffff !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            padding: 1.2rem 1.5rem !important;
            transition: all 0.3s ease !important;
            border-radius: 12px !important;
            background: rgba(255, 255, 255, 0.02) !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
        }
        
        .sidebar-menu li a i {
            width: 28px !important;
            height: 28px !important;
            margin-right: 1.2rem !important;
            font-size: 1.2rem !important;
            text-align: center !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 8px !important;
            background: rgba(255, 215, 0, 0.1) !important;
            color: #ffd700 !important;
        }
        
        .sidebar-menu li.active a {
            background: linear-gradient(90deg, rgba(255, 215, 0, 0.15) 0%, rgba(255, 215, 0, 0.05) 100%) !important;
            color: #ffd700 !important;
            border-color: rgba(255, 215, 0, 0.3) !important;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2) !important;
        }
        
        .sidebar-menu li.active a i {
            background: #ffd700 !important;
            color: #000000 !important;
        }
        
        .sidebar-menu li:hover a {
            background: linear-gradient(90deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 215, 0, 0.02) 100%) !important;
            color: #ffd700 !important;
            transform: translateX(8px) !important;
            border-color: rgba(255, 215, 0, 0.2) !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3) !important;
        }
        
        .sidebar-menu li:hover a i {
            background: #ffd700 !important;
            color: #000000 !important;
            transform: scale(1.1) !important;
        }        .main-header {
            background-color: #121212 !important;
            border-bottom: 1px solid #333333 !important;
            margin-left: 280px !important;
            padding: 0 2rem !important;
            height: 70px !important;
            display: flex !important;
            align-items: center !important;
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            left: 280px !important;
            z-index: 98 !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;
        }
        
        .main-content {
            margin-left: 280px !important;
            margin-top: 70px !important;
            padding: 2rem !important;
            min-height: calc(100vh - 70px) !important;
            background-color: #000000 !important;
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
          /* Pastikan semua teks berwarna putih */
        h1, h2, h3, h4, h5, h6, p, div, span, td, th, .card-body, .content-wrapper {
            color: #ffffff !important;
        }
        
        .card {
            background-color: #121212 !important;
            color: #ffffff !important;
            border: 1px solid #333333 !important;
            border-radius: 10px !important;
            margin-bottom: 1.5rem !important;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .card h5 {
            color: #ffd700 !important;
            font-weight: 600 !important;
            margin-bottom: 1rem !important;
        }
        
        .table {
            color: #ffffff !important;
            background-color: transparent !important;
        }
        
        .table th {
            color: #ffd700 !important;
            background-color: #1a1a1a !important;
            border-color: #333333 !important;
        }
        
        .table td {
            border-color: #333333 !important;
            background-color: transparent !important;
        }
        
        .btn {
            border-radius: 8px !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }
        
        .btn-warning {
            background-color: #ffd700 !important;
            border-color: #ffd700 !important;
            color: #000000 !important;
        }
        
        .btn-warning:hover {
            background-color: #e6c200 !important;
            border-color: #e6c200 !important;
            transform: translateY(-2px) !important;
        }
        
        .content-header {
            margin-bottom: 2rem !important;
            padding-bottom: 1rem !important;
            border-bottom: 1px solid #333333 !important;
        }
        
        .content-header h1 {
            color: #ffd700 !important;
            font-size: 2rem !important;
            font-weight: 600 !important;
            margin: 0 !important;
        }
        
        .breadcrumb {
            background: none !important;
            padding: 0 !important;
            margin: 0.5rem 0 0 0 !important;
        }
        
        .breadcrumb-item {
            color: #cccccc !important;
        }
        
        .breadcrumb-item.active {
            color: #ffd700 !important;
        }
    </style>
</head>
<body>    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-content">
                    <h2><i class="fas fa-utensils"></i> Family 88</h2>
                    <p>Admin Dashboard</p>
                </div>
            </div>
            
            <div class="user-profile">
                <div class="user-avatar">
                    <?= substr($_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'AD', 0, 2) ?>
                </div>
                <div class="user-info">
                    <h3><?= $_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Administrator' ?></h3>
                    <p>Administrator</p>
                </div>
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

        <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const wrapper = document.querySelector('.wrapper');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    wrapper.classList.toggle('sidebar-open');
                });
                
                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        if (!e.target.closest('.sidebar') && !e.target.closest('.mobile-toggle')) {
                            wrapper.classList.remove('sidebar-open');
                        }
                    }
                });
            }
        });
        </script>
