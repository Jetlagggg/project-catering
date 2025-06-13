<div class="hero-container">
    <img src="/TubesYos/assets/img/cook.gif" class="hero-background" alt="Latar belakang memasak">
    <div class="hero-content">
        <h1>Makanan Lezat Untuk Acara Anda</h1>
        <p>Kami menyediakan layanan katering premium untuk semua kebutuhan Anda. Dari acara perusahaan hingga pernikahan, kami memiliki menu sempurna untuk setiap kesempatan.</p>
        <a href="/TubesYos/public/?page=menu" class="hero-cta" id="explore-menu-btn">
            <i class="fas fa-utensils"></i> Jelajahi Menu Kami
        </a>
    </div>
</div>

<div class="features-section">
    <div class="feature-container">        <div class="feature-box">
            <div class="feature-icon">
                <i class="fas fa-award"></i>
            </div>
            <h3>Kualitas Premium</h3>
            <p>Kami hanya menggunakan bahan-bahan segar dan berkualitas tinggi dalam semua hidangan kami.</p>
        </div>
        
        <div class="feature-box">
            <div class="feature-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h3>Pengiriman Cepat</h3>
            <p>Layanan pengiriman tepat waktu untuk memastikan acara Anda berjalan lancar.</p>
        </div>
        
        <div class="feature-box">
            <div class="feature-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>Layanan Profesional</h3>
            <p>Staf terlatih kami memberikan layanan terbaik untuk acara Anda.</p>
        </div>
        
        <div class="feature-box">
            <div class="feature-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h3>Pilihan Diet</h3>
            <p>Menu khusus tersedia untuk berbagai kebutuhan diet.</p>
        </div>
    </div>
</div>

<div class="popular-section">    <div class="section-header">
        <h2>Menu Populer</h2>
        <a href="/TubesYos/public/?page=menu" class="view-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
    </div>
      <div class="food-grid">
        <?php if (!empty($popularMenus)): ?>
            <?php foreach ($popularMenus as $menu): ?>
            <div class="food-card">
                <div class="food-img">
                    <?php if (!empty($menu['image_url'])): ?>
                        <img src="/TubesYos/<?= $menu['image_url'] ?>" alt="<?= htmlspecialchars($menu['name']) ?>">
                    <?php else: ?>
                        <img src="/TubesYos/assets/img/food-placeholder.jpg" alt="<?= htmlspecialchars($menu['name']) ?>">
                    <?php endif; ?>
                </div>
                <div class="food-content">
                    <div class="food-title"><?= htmlspecialchars($menu['name']) ?></div>
                    <div class="food-desc"><?= htmlspecialchars($menu['description']) ?></div>
                    <div class="food-footer">
                        <div class="food-price">Rp <?= number_format($menu['price'], 0, ',', '.') ?></div>
                        <a href="/TubesYos/public/?page=order&action=addItem&id=<?= $menu['id'] ?>" class="order-now-btn">Pesan</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-menu-message">
                <div class="empty-state">
                    <i class="fas fa-utensils empty-icon"></i>
                    <h3>Belum Ada Menu</h3>
                    <p>Menu masih kosong. Silahkan tambahkan menu baru melalui panel admin.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="testimonials-section">    <div class="section-header">
        <h2>Apa Kata Pelanggan Kami</h2>
        <p class="section-subtitle">Jangan hanya percaya kata-kata kami - lihat apa yang dikatakan para pelanggan</p>
    </div>
    
    <div class="testimonials-container">
        <div class="testimonial-box">            <div class="testimonial-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">"Family 88 menyediakan katering yang luar biasa untuk acara perusahaan kami. Makanannya lezat dan layanannya sempurna. Tim kami sangat terkesan dengan kualitas dan penyajiannya. Sangat direkomendasikan!"</p>
            <div class="testimonial-author">
                <div class="author-avatar">BS</div>
                <div class="author-info">
                    <h4>Icang</h4>
                    <p>Acara Perusahaan</p>
                </div>
            </div>
        </div>
        
        <div class="testimonial-box">            <div class="testimonial-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">"Kami menyewa Family 88 untuk resepsi pernikahan kami, dan mereka melakukan pekerjaan yang luar biasa. Menu disesuaikan dengan sempurna sesuai selera kami, dan tamu-tamu kami tidak berhenti memuji makanannya! Stafnya profesional dan sopan."</p>
            <div class="testimonial-author">
                <div class="author-avatar">DA</div>
                <div class="author-info">
                    <h4>Maudy Azzahra Nurul Qolbi</h4>
                    <p>Resepsi Pernikahan</p>
                </div>
            </div>
        </div>
        
        <div class="testimonial-box">            <div class="testimonial-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="testimonial-text">"Makanannya lezat dan penyajiannya sangat indah. Family 88 membuat kumpul keluarga kami benar-benar spesial. Semua orang berkomentar betapa lezatnya semua hidangan. Terima kasih telah membuat acara kami berkesan!"</p>
            <div class="testimonial-author">
                <div class="author-avatar">RP</div>
                <div class="author-info">
                    <h4>Yoshua Pandawinatha</h4>
                    <p>Kumpul Keluarga</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cta-section">    <div class="cta-content">
        <h2>Siap Merencanakan Acara Anda?</h2>
        <p>Hubungi kami hari ini untuk mendiskusikan kebutuhan katering Anda dan dapatkan menu khusus untuk acara spesial Anda.</p>
        <div class="cta-buttons">
            <a href="/TubesYos/public/?page=order" class="primary-btn">Pesan Sekarang</a>
            <a href="/TubesYos/public/?page=home&action=contact" class="secondary-btn">Hubungi Kami</a>
        </div>
    </div>
</div>
