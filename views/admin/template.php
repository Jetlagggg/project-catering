<!DOCTYPE html>
<html>
<head>
    <title><?= $pageTitle ?? 'Family 88 - Admin Panel' ?></title>
    <link rel="stylesheet" href="/TubesYos/assets/style.css">
    <link rel="stylesheet" href="/TubesYos/assets/fixes_new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="dark-mode">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <button class="mobile-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">
                <i class="fas fa-utensils logo-icon"></i>
                <h1>Family 88 Admin</h1>
            </div>
            <div class="header-spacer"></div>
            <div class="admin-profile">
                <span class="admin-name"><?= $_SESSION['admin_username'] ?? 'Admin' ?></span>
                <a href="/TubesYos/admin/logout.php" class="logout-btn" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </header>
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-profile">
                <button class="user-btn">
                    <div class="user-avatar">AD</div>
                    <span>Administrator</span>
                </button>
            </div>
            
            <div class="client-app">
                <h3>Admin Panel</h3>
            </div>
            
            <ul class="sidebar-menu">
                <li class="<?= $page === 'dashboard' || $page === 'home' ? 'active' : '' ?>">
                    <a href="/TubesYos/admin/index.php?page=dashboard">
                        <i class="fas fa-tachometer-alt"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?= $page === 'menus' || $page === 'foods' ? 'active' : '' ?>">
                    <a href="/TubesYos/admin/index.php?page=foods">
                        <i class="fas fa-utensils"></i> 
                        <span>Manage Foods</span>
                    </a>
                </li>
                <li class="<?= $page === 'clients' ? 'active' : '' ?>">
                    <a href="/TubesYos/admin/index.php?page=clients">
                        <i class="fas fa-users"></i> 
                        <span>Clients</span>
                    </a>
                </li>
                <li class="<?= $page === 'orders' || $page === 'history' ? 'active' : '' ?>">
                    <a href="/TubesYos/admin/index.php?page=history">
                        <i class="fas fa-clipboard-list"></i> 
                        <span>Orders</span>
                    </a>
                </li>
                <li class="<?= $page === 'invoices' ? 'active' : '' ?>">
                    <a href="/TubesYos/admin/index.php?page=invoices">
                        <i class="fas fa-file-invoice-dollar"></i> 
                        <span>Invoices</span>
                    </a>
                </li>
                <li>
                    <a href="/TubesYos/public/" target="_blank">
                        <i class="fas fa-globe"></i> 
                        <span>View Website</span>
                    </a>
                </li>
                <li>
                    <a href="/TubesYos/admin/logout.php">
                        <i class="fas fa-sign-out-alt"></i> 
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="content">
            <div class="page-header">
                <h2>
                    <span>
                        <?= isset($page) ? ucfirst($page) : 'Dashboard' ?>
                    </span>
                    <div class="header-breadcrumb">
                        <a href="/TubesYos/admin/index.php?page=dashboard">Dashboard</a> 
                        <?php if(isset($page) && $page !== 'home' && $page !== 'dashboard'): ?>
                        <i class="fas fa-chevron-right"></i>
                        <span><?= ucfirst($page) ?></span>
                        <?php endif; ?>
                    </div>
                </h2>
            </div>
            
            <div class="content-wrapper">
                <?php include $contentView; ?>
            </div>
        </main>
    </div>
    
    <script src="/TubesYos/assets/theme.js"></script>
</body>
</html>
