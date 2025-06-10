// JavaScript untuk website promosi Foody

document.addEventListener('DOMContentLoaded', function() {
    // Navigasi mobile
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const publicNav = document.querySelector('.public-nav');
    
    if (mobileMenuToggle && publicNav) {
        mobileMenuToggle.addEventListener('click', function() {
            publicNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // Smooth scroll untuk link internal
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                if (publicNav && publicNav.classList.contains('active')) {
                    publicNav.classList.remove('active');
                    if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
                }
            }
        });
    });
    
    // Animasi untuk hero section
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
        setTimeout(() => {
            heroContent.classList.add('animated');
        }, 200);
    }
    
    // Sticky header pada scroll
    const header = document.querySelector('.public-header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });
    }
});
