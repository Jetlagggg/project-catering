<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Foody - Premium Catering Service' ?></title>    <link rel="stylesheet" href="/TubesYos/assets/style.css">
    <link rel="stylesheet" href="/TubesYos/assets/public.css">
    <link rel="stylesheet" href="/TubesYos/assets/testimonials.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preload" href="/TubesYos/assets/img/cook.gif" as="image">
    <style>
        :root {
            --primary-color: #ffd700;
            --primary-hover: #e6c200;
            --dark-bg: #000000;
            --dark-secondary: #1a1a1a;
            --border-color: #333;
            --text-color: #f5f5f5;
            --text-secondary: #cccccc;
        }
        
        /* Enhance black and yellow theme */
        body.public-site {
            background-color: var(--dark-bg);
        }
        
        .public-header {
            border-bottom: 1px solid var(--primary-color);
        }
        
        /* Add yellow glow to active elements */
        .order-btn:hover, .hero-cta:hover, .submit-btn:hover {
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
        }
        
        /* Enhance selected elements with yellow accents */
        ::selection {
            background-color: var(--primary-color);
            color: #000;
        }
    </style>
</head>
<body class="public-site">
    <!-- Header -->
    <header class="public-header">
        <div class="public-header-container">
            <div class="public-logo">
                <a href="/TubesYos/public/">
                    <i class="fas fa-utensils logo-icon"></i>
                    <h1>Foody</h1>
                </a>
            </div>
            
            <nav class="public-nav">                <ul>
                    <li class="<?= $page === 'home' ? 'active' : '' ?>"><a href="/TubesYos/public/">Beranda</a></li>
                    <li class="<?= $page === 'foods' ? 'active' : '' ?>"><a href="/TubesYos/public/?page=menu">Menu</a></li>
                    <li class="<?= $page === 'about' ? 'active' : '' ?>"><a href="/TubesYos/public/?page=home&action=about">Tentang Kami</a></li>
                    <li class="<?= $page === 'contact' ? 'active' : '' ?>"><a href="/TubesYos/public/?page=home&action=contact">Kontak</a></li>
                </ul>
            </nav>
            
            <div class="public-cta">
                <a href="/TubesYos/public/?page=order" class="order-btn">Pesan Sekarang</a>
            </div>
            
            <button class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="public-main">
        <?php include $contentView; ?>
    </main>
    
    <!-- Footer -->
    <footer class="public-footer">
        <div class="footer-container">            <div class="footer-info">
                <div class="footer-logo">
                    <i class="fas fa-utensils logo-icon"></i>
                    <h2>Foody</h2>
                </div>
                <p>Layanan katering premium untuk semua acara Anda.</p>
            </div>
              <div class="footer-links">
                <h3>Tautan Cepat</h3>
                <ul>
                    <li><a href="/TubesYos/public/">Beranda</a></li>
                    <li><a href="/TubesYos/public/?page=menu">Menu</a></li>
                    <li><a href="/TubesYos/public/?page=home&action=about">Tentang Kami</a></li>
                    <li><a href="/TubesYos/public/?page=home&action=contact">Kontak</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h3>Hubungi Kami</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Makanan 123, Kota Lezat</p>
                <p><i class="fas fa-phone"></i> +123 456 7890</p>
                <p><i class="fas fa-envelope"></i> info@foody.com</p>
            </div>
            
            <div class="footer-social">
                <h3>Ikuti Kami</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>
          <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Foody. Hak Cipta Dilindungi.</p>
            <p><a href="/TubesYos/admin/login.php">Login Admin</a></p>
        </div>
    </footer>
    
    <script src="/TubesYos/assets/public.js"></script>
</body>
</html>
