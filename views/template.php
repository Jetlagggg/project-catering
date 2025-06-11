<!DOCTYPE html>
<html>
<head>
    <title><?= $pageTitle ?? 'Family 88 - Sistem Pengelolaan Catering' ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/fixes_new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="dark-mode">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <div class="logo">
                <i class="fas fa-leaf logo-icon"></i>
                <h1>Family 88</h1>
            </div>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="user-controls">
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
                <div class="user-menu">
                    <button class="user-btn">
                        <img src="https://ui-avatars.com/api/?name=Demo+User&background=random" alt="User" class="user-avatar">
                        <span>Demo</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Sidebar -->        <aside class="sidebar">
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
                    <a href="index.php?page=menus">
                        <i class="fas fa-utensils"></i> 
                        <span>Foods</span>
                    </a>
                </li>
                <li class="<?= $page === 'cart' ? 'active' : '' ?>">
                    <a href="index.php?page=cart">
                        <i class="fas fa-shopping-cart"></i> 
                        <span>Cart</span>
                    </a>
                </li>
                <li class="<?= $page === 'orders' ? 'active' : '' ?>">
                    <a href="index.php?page=orders">
                        <i class="fas fa-clipboard-list"></i> 
                        <span>Order</span>
                    </a>
                </li>
                <li class="<?= $page === 'chat' ? 'active' : '' ?>">
                    <a href="index.php?page=chat">
                        <i class="fas fa-comments"></i> 
                        <span>Chat</span>
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Main Content -->        <main class="content">
            <div class="page-header">
                <h2>
                    <span>
                        <?= isset($page) ? ucfirst($page) : 'Home' ?>
                    </span>
                    <?php if(isset($page) && $page === 'dashboard'): ?>
                    <div class="header-breadcrumb">
                        <a href="index.php?page=dashboard">Home</a> 
                        <i class="fas fa-chevron-right"></i>
                        <span>Dashboard</span>
                    </div>
                    <?php endif; ?>
                </h2>
            </div>
            
            <div class="content-wrapper">
                <?php include $contentView; ?>
            </div>
        </main>
    </div>    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.wrapper').classList.toggle('sidebar-collapsed');
            // Store user preference in localStorage
            const isCollapsed = document.querySelector('.wrapper').classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });

        // Theme toggle
        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('light-theme');
            const isLightTheme = document.body.classList.contains('light-theme');
            localStorage.setItem('lightTheme', isLightTheme);
            
            const themeIcon = this.querySelector('i');
            if (themeIcon.classList.contains('fa-moon')) {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        });
        
        // Load user preferences on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Restore sidebar state
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed) {
                document.querySelector('.wrapper').classList.add('sidebar-collapsed');
            }
            
            // Restore theme
            const lightTheme = localStorage.getItem('lightTheme') === 'true';
            if (lightTheme) {
                document.body.classList.add('light-theme');
                document.querySelector('.theme-btn i').classList.replace('fa-moon', 'fa-sun');
            }
        });
    </script>
</body>
</html>
