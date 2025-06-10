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
    <div class="menu-container">        <div class="menu-categories">
            <button class="menu-category-btn active" data-category="all">Semua</button>
            <button class="menu-category-btn" data-category="appetizers">Hidangan Pembuka</button>
            <button class="menu-category-btn" data-category="main">Hidangan Utama</button>
            <button class="menu-category-btn" data-category="desserts">Hidangan Penutup</button>
            <button class="menu-category-btn" data-category="beverages">Minuman</button>
        </div>
        
        <div class="menu-grid">
            <?php if (!empty($menus)) : ?>
                <?php foreach ($menus as $menu) : ?>
                    <div class="menu-card" data-category="<?= strtolower($menu['category'] ?? 'all') ?>">
                        <div class="menu-image">
                            <img src="<?= $menu['image_url'] ?? '/TubesYos/assets/img/food-placeholder.jpg' ?>" alt="<?= htmlspecialchars($menu['name']) ?>">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryBtns = document.querySelectorAll('.menu-category-btn');
        const menuItems = document.querySelectorAll('.menu-card');
        
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryBtns.forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get selected category
                const category = this.dataset.category;
                
                // Filter menu items
                menuItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
