<!DOCTYPE html>
<html>
<head>    <title><?= $pageTitle ?? 'Foody - Sistem Pengelolaan Catering' ?></title>
    <link rel="preload" href="/TubesYos/assets/img/cook.gif" as="image">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/fixes_new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="dark-mode">
    <div class="wrapper">        <!-- Header -->        <header class="main-header">
            <button class="mobile-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>            <div class="logo">
                <i class="fas fa-utensils logo-icon"></i>
                <h1>Foody</h1>
            </div>
            <div class="header-spacer"></div>
        </header><!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-profile">
                <button class="user-btn">
                    <div class="user-avatar">DU</div>
                    <span>Demo User</span>
                </button>
            </div>
            
            <div class="client-app">
                <h3>Client App</h3>
            </div>
            
            <ul class="sidebar-menu">
                <li class="<?= $page === 'dashboard' || $page === 'home' ? 'active' : '' ?>">
                    <a href="index.php?page=dashboard">
                        <i class="fas fa-home"></i> 
                        <span>Home</span>
                    </a>
                </li>
                <li class="<?= $page === 'menus' || $page === 'foods' ? 'active' : '' ?>">
                    <a href="index.php?page=foods">
                        <i class="fas fa-utensils"></i> 
                        <span>Foods</span>
                    </a>
                </li>
                <li class="<?= $page === 'history' ? 'active' : '' ?>">
                    <a href="index.php?page=history">
                        <i class="fas fa-history"></i> 
                        <span>History Order</span>
                    </a>
                </li>
            </ul>
        </aside>
          <!-- Main Content -->
        <main class="content">
            <div class="page-header">
                <h2>
                    <span>
                        <?= isset($page) ? ucfirst($page) : 'Home' ?>
                    </span>
                    <div class="header-breadcrumb">
                        <a href="index.php?page=dashboard">Home</a> 
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
    </div>    <script src="assets/theme.js"></script>
</body>
</html>
