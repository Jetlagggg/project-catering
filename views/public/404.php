<?php
// Halaman 404 Not Found untuk website promosi
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - Foody Catering</title>
    <link rel="stylesheet" href="/TubesYos/assets/style.css">
    <link rel="stylesheet" href="/TubesYos/assets/public.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            
            <nav class="public-nav">
                <ul>
                    <li><a href="/TubesYos/public/">Home</a></li>
                    <li><a href="/TubesYos/public/?page=menu">Menu</a></li>
                    <li><a href="/TubesYos/public/?page=home&action=about">About Us</a></li>
                    <li><a href="/TubesYos/public/?page=home&action=contact">Contact</a></li>
                </ul>
            </nav>
            
            <div class="public-cta">
                <a href="/TubesYos/public/?page=order" class="order-btn">Order Now</a>
            </div>
            
            <button class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="public-main">
        <div class="error-section">
            <div class="error-container">
                <div class="error-content">
                    <div class="error-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <h1>404</h1>
                    <h2>Page Not Found</h2>
                    <p>Oops! The page you are looking for does not exist or has been moved.</p>
                    <a href="/TubesYos/public/" class="hero-cta">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="public-footer">
        <div class="footer-container">
            <div class="footer-info">
                <div class="footer-logo">
                    <i class="fas fa-utensils logo-icon"></i>
                    <h2>Foody</h2>
                </div>
                <p>Premium catering services for all your events.</p>
            </div>
            
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/TubesYos/public/">Home</a></li>
                    <li><a href="/TubesYos/public/?page=menu">Menu</a></li>
                    <li><a href="/TubesYos/public/?page=home&action=about">About Us</a></li>
                    <li><a href="/TubesYos/public/?page=home&action=contact">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>123 Catering Street, Foodville, Indonesia 12345</p>
                <p>Email: info@foodycatering.com</p>
                <p>Phone: +62 123-456-7890</p>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; <?= date('Y') ?> Foody Catering. All rights reserved.</p>
        </div>
    </footer>

    <style>
        .error-section {
            padding: 5rem 0;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }
        
        .error-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .error-content {
            text-align: center;
        }
        
        .error-icon {
            font-size: 5rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }
        
        .error-content h1 {
            font-size: 6rem;
            color: #ff6b6b;
            margin: 0;
            line-height: 1;
        }
        
        .error-content h2 {
            font-size: 2rem;
            color: #333;
            margin: 0.5rem 0 1.5rem 0;
        }
        
        .error-content p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const publicNav = document.querySelector('.public-nav');
            
            if (mobileMenuToggle && publicNav) {
                mobileMenuToggle.addEventListener('click', function() {
                    publicNav.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>
