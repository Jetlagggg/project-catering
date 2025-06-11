<?php
// Halaman Menu untuk website promosi
?>

<div class="about-hero">
    <div class="about-container">        <div class="section-title">
            <h2>Menu Kami</h2>
            <p>Jelajahi pilihan lezat kami untuk acara Anda berikutnya</p>
        </div>
    </div>
</div>

<div class="menu-section">
    <div class="menu-container">        <!-- Enhanced Menu Filter Section -->
        <div class="menu-filter-container">
            <div class="filter-header">
                <h3 class="filter-title">
                    <i class="fas fa-filter"></i>
                    Kategori Menu
                </h3>
                <p class="filter-subtitle">Pilih kategori yang Anda inginkan</p>
            </div>
              <div class="food-filters">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-th-large"></i>
                    <span>Semua</span>
                    <div class="filter-badge"><?= count($menus) ?></div>
                </button>
                <button class="filter-btn" data-filter="appetizers">
                    <i class="fas fa-utensils"></i>
                    <span>Hidangan Pembuka</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return strtolower($m['category'] ?? '') === 'appetizers'; })) ?></div>
                </button>
                <button class="filter-btn" data-filter="main">
                    <i class="fas fa-leaf"></i>
                    <span>Hidangan Utama</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return strtolower($m['category'] ?? '') === 'main'; })) ?></div>
                </button>
                <button class="filter-btn" data-filter="desserts">
                    <i class="fas fa-ice-cream"></i>
                    <span>Hidangan Penutup</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return strtolower($m['category'] ?? '') === 'desserts'; })) ?></div>
                </button>
                <button class="filter-btn" data-filter="beverages">
                    <i class="fas fa-glass-water"></i>
                    <span>Minuman</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return strtolower($m['category'] ?? '') === 'beverages'; })) ?></div>
                </button>
            </div>
            
            <div class="filter-divider"></div>
        </div>
        
        <div class="menu-grid">
            <?php if (!empty($menus)) : ?>                <?php foreach ($menus as $menu) : ?>
                    <div class="menu-card" data-category="<?= strtolower($menu['category'] ?? 'all') ?>">
                        <div class="menu-image">
                            <?php if (!empty($menu['image_url'])): ?>
                                <img src="/TubesYos/<?= $menu['image_url'] ?>" alt="<?= htmlspecialchars($menu['name']) ?>">
                            <?php else: ?>
                                <img src="/TubesYos/assets/img/food-placeholder.jpg" alt="<?= htmlspecialchars($menu['name']) ?>">
                            <?php endif; ?>
                        </div>
                        <div class="menu-info">
                            <h3><?= htmlspecialchars($menu['name']) ?></h3>
                            <div class="menu-price">Rp <?= number_format($menu['price'], 0, ',', '.') ?></div>
                            <div class="menu-desc"><?= htmlspecialchars($menu['description']) ?></div>                            <a href="/TubesYos/public/?page=order&action=addItem&id=<?= $menu['id'] ?>" class="order-btn">Tambahkan ke Pesanan</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-menu-message">
                    <p>Tidak ada menu tersedia saat ini. Silakan periksa kembali nanti.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* Enhanced Menu Filter Styling */
    .menu-filter-container {
        background: linear-gradient(135deg, rgba(30, 30, 30, 0.95) 0%, rgba(45, 45, 45, 0.95) 100%);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 40px;
        border: 2px solid rgba(255, 122, 0, 0.1);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }
    
    .filter-header {
        text-align: center;
        margin-bottom: 25px;
    }
    
    .filter-title {
        color: #ff7a00;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }
    
    .filter-title i {
        font-size: 1.5rem;
        background: linear-gradient(45deg, #ff7a00, #ffa500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .filter-subtitle {
        color: #cccccc;
        font-size: 1rem;
        margin: 0;
        opacity: 0.8;
    }
    
    .food-filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .filter-btn {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        color: #ffffff;
        padding: 18px 20px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 14px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 122, 0, 0.1), transparent);
        transition: all 0.8s ease;
    }
    
    .filter-btn:hover::before {
        left: 100%;
    }
    
    .filter-btn i {
        font-size: 1.2rem;
        color: #ff7a00;
        transition: all 0.3s ease;
    }
    
    .filter-btn span {
        flex: 1;
        text-align: left;
    }
    
    .filter-badge {
        background: rgba(255, 122, 0, 0.2);
        color: #ff7a00;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        min-width: 25px;
        text-align: center;
        border: 1px solid rgba(255, 122, 0, 0.3);
    }
    
    .filter-btn:hover {
        background: linear-gradient(135deg, #3d3d3d 0%, #2a2a2a 100%);
        border-color: rgba(255, 122, 0, 0.3);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 122, 0, 0.15);
    }
    
    .filter-btn:hover i {
        color: #ffa500;
        transform: scale(1.1);
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #ff7a00 0%, #e66500 100%);
        color: #ffffff;
        border-color: #ff7a00;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(255, 122, 0, 0.3);
    }
    
    .filter-btn.active i {
        color: #ffffff;
        transform: scale(1.15);
    }
    
    .filter-btn.active .filter-badge {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.3);
    }
    
    .filter-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #ff7a00 50%, transparent 100%);
        border-radius: 1px;
        opacity: 0.3;
    }
    
    /* Menu card and image styling */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }
    
    .menu-card {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease;
        border: 2px solid rgba(255, 122, 0, 0.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(255, 122, 0, 0.2);
        border-color: rgba(255, 122, 0, 0.3);
    }
    
    .menu-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }
    
    .menu-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .menu-card:hover .menu-image img {
        transform: scale(1.1);
    }
    
    .menu-info {
        padding: 25px;
    }
    
    .menu-info h3 {
        color: #ffffff;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    
    .menu-price {
        color: #ff7a00;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .menu-desc {
        color: #cccccc;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
        opacity: 0.9;
    }
    
    .order-btn {
        background: linear-gradient(135deg, #ff7a00 0%, #e66500 100%);
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-block;
        border: none;
        cursor: pointer;
    }
    
    .order-btn:hover {
        background: linear-gradient(135deg, #e66500 0%, #cc5500 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 122, 0, 0.4);
        text-decoration: none;
        color: #ffffff;
    }
    
    .no-menu-message {
        text-align: center;
        padding: 60px 20px;
        color: #888;
        font-size: 1.1rem;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .menu-filter-container {
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .food-filters {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .filter-btn {
            padding: 15px 18px;
            font-size: 13px;
        }
        
        .filter-title {
            font-size: 1.5rem;
        }
    }
    
    @media (max-width: 480px) {
        .filter-btn span {
            font-size: 12px;
        }
        
        .filter-btn i {
            font-size: 1rem;
        }
    }
</style>

<script>
    // Enhanced Menu filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const menuItems = document.querySelectorAll('.menu-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get filter value
                const filterValue = this.getAttribute('data-filter');
                
                // Add smooth transition effect
                menuItems.forEach(card => {
                    card.style.transition = 'all 0.4s ease';
                    card.style.opacity = '0.3';
                    card.style.transform = 'scale(0.95)';
                });
                
                // Filter and show relevant cards
                setTimeout(() => {
                    menuItems.forEach(card => {
                        if (filterValue === 'all') {
                            card.style.display = 'block';
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        } else {
                            // Check if card matches the filter
                            const cardCategory = card.getAttribute('data-category');
                            if (cardCategory === filterValue) {
                                card.style.display = 'block';
                                card.style.opacity = '1';
                                card.style.transform = 'scale(1)';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });                }, 200);
                
                console.log('Filter selected:', filterValue);
            });
        });
    });
</script>
