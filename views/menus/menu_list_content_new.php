<div class="card">
    <div class="card-header">
        <h2>Our Menu</h2>
    </div>    <div class="card-body">
        <!-- Enhanced Menu Filter Section -->
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
                <button class="filter-btn" data-filter="main">
                    <i class="fas fa-utensils"></i>
                    <span>Hidangan Pembuka</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return ($m['category'] ?? '') === 'main'; })) ?></div>
                </button>
                <button class="filter-btn" data-filter="appetizer">
                    <i class="fas fa-leaf"></i>
                    <span>Hidangan Utama</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return ($m['category'] ?? '') === 'appetizer'; })) ?></div>
                </button>
                <button class="filter-btn" data-filter="dessert">
                    <i class="fas fa-ice-cream"></i>
                    <span>Hidangan Penutup</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return ($m['category'] ?? '') === 'dessert'; })) ?></div>
                </button>
                <button class="filter-btn" data-filter="drink">
                    <i class="fas fa-glass-water"></i>
                    <span>Minuman</span>
                    <div class="filter-badge"><?= count(array_filter($menus, function($m) { return ($m['category'] ?? '') === 'drink'; })) ?></div>
                </button>
            </div>
            
            <div class="filter-divider"></div>
        </div>        <div class="food-grid">
            <?php if (!empty($menus)): ?>
                <?php foreach ($menus as $m): ?>
                <div class="food-card">
                    <div class="food-img">
                        <?php if (!empty($m['image_url'])): ?>
                            <img src="/TubesYos/<?= $m['image_url'] ?>" alt="<?= htmlspecialchars($m['name']) ?>">
                        <?php else: ?>
                            <img src="/TubesYos/assets/img/food-placeholder.jpg" alt="<?= htmlspecialchars($m['name']) ?>">
                        <?php endif; ?>
                    </div>
                    <div class="food-content">
                        <div class="food-title"><?= htmlspecialchars($m['name']) ?></div>
                        <div class="food-desc"><?= htmlspecialchars($m['description']) ?></div>
                        <div class="food-footer">
                            <div class="food-price">Rp <?= number_format($m['price'], 0, ',', '.') ?></div>
                            <button class="add-to-cart" data-id="<?= $m['id'] ?>">
                                <i class="fas fa-plus"></i>
                            </button>
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
</div>

<style>
    /* Additional styles for food page */
    .card {
        background-color: transparent !important;
        box-shadow: none !important;
    }
    
    .card-header {
        background-color: transparent !important;
        border-bottom: none !important;
        padding-left: 0 !important;
    }
    
    .card-body {
        padding: 0 !important;
    }    
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
    
    /* Empty state styling */
    .no-menu-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        border-radius: 20px;
        padding: 40px;
        border: 2px solid rgba(255, 122, 0, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        max-width: 400px;
        margin: 0 auto;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #ff7a00;
        margin-bottom: 20px;
        opacity: 0.8;
    }
    
    .empty-state h3 {
        color: #ffffff;
        font-size: 1.5rem;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .empty-state p {
        color: #cccccc;
        font-size: 1rem;
        margin: 0;
        opacity: 0.9;
        line-height: 1.5;
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
    
    .food-card {
        background-color: #1e1e1e !important;
        border-radius: 8px !important;
    }
    
    .food-title {
        color: white !important;
    }
    
    .food-desc {
        color: #8c92a3 !important;
    }
    
    .add-to-cart {
        background: rgba(255, 122, 0, 0.2) !important;
        color: #ff7a00 !important;
    }
    
    .add-to-cart:hover,
    .add-to-cart.added {
        background: #ff7a00 !important;
        color: white !important;
        transform: rotate(180deg);
    }
</style>

<script>    // Enhanced Food filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const foodCards = document.querySelectorAll('.food-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get filter value
                const filterValue = this.getAttribute('data-filter');
                
                // Add smooth transition effect
                foodCards.forEach(card => {
                    card.style.transition = 'all 0.4s ease';
                    card.style.opacity = '0.3';
                    card.style.transform = 'scale(0.95)';
                });
                
                // Filter and show relevant cards
                setTimeout(() => {
                    foodCards.forEach(card => {
                        if (filterValue === 'all') {
                            card.style.display = 'block';
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        } else {
                            // For now, show all cards since we don't have category data in the cards
                            // In a real implementation, you would check card.dataset.category === filterValue
                            card.style.display = 'block';
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }
                    });                }, 200);
                
                console.log('Filter selected:', filterValue);
            });
        });
        
        // Add to cart functionality
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                console.log('Adding to cart:', id);
                
                // Animation to show item was added
                this.classList.add('added');
                setTimeout(() => {
                    this.classList.remove('added');
                }, 1000);
                
                // In a real implementation, you would send an AJAX request to add the item to the cart
            });
        });
    });
</script>
