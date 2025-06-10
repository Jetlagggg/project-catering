<div class="card">
    <div class="card-header">
        <h2>Our Menu</h2>
    </div>
    <div class="card-body">
        <div class="food-filters">
            <button class="btn active">All</button>
            <button class="btn">Main Course</button>
            <button class="btn">Appetizers</button>
            <button class="btn">Desserts</button>
            <button class="btn">Beverages</button>
        </div>
        
        <div class="food-grid">
            <?php foreach ($menus as $m): ?>
            <div class="food-card">
                <div class="food-img">
                    <img src="<?= $m['image_url'] ?? 'https://source.unsplash.com/500x300/?food' ?>" alt="<?= $m['name'] ?>">
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
            
            <?php if (empty($menus)): ?>
            <!-- Dummy items if no menu exists -->
            <div class="food-card">
                <div class="food-img">
                    <img src="https://source.unsplash.com/500x300/?pasta" alt="Pasta">
                </div>
                <div class="food-content">
                    <div class="food-title">Italian Pasta</div>
                    <div class="food-desc">Delicious pasta with homemade tomato sauce and fresh herbs.</div>
                    <div class="food-footer">
                        <div class="food-price">Rp 75.000</div>
                        <button class="add-to-cart">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="food-img">
                    <img src="https://source.unsplash.com/500x300/?salad" alt="Garden Salad">
                </div>
                <div class="food-content">
                    <div class="food-title">Garden Salad</div>
                    <div class="food-desc">Fresh vegetables with our signature dressing.</div>
                    <div class="food-footer">
                        <div class="food-price">Rp 45.000</div>
                        <button class="add-to-cart">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="food-img">
                    <img src="https://source.unsplash.com/500x300/?steak" alt="Grilled Steak">
                </div>
                <div class="food-content">
                    <div class="food-title">Grilled Steak</div>
                    <div class="food-desc">Premium beef steak served with seasoned vegetables.</div>
                    <div class="food-footer">
                        <div class="food-price">Rp 150.000</div>
                        <button class="add-to-cart">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="food-img">
                    <img src="https://source.unsplash.com/500x300/?dessert" alt="Chocolate Dessert">
                </div>
                <div class="food-content">
                    <div class="food-title">Chocolate Dessert</div>
                    <div class="food-desc">Rich chocolate cake with a side of fresh berries.</div>
                    <div class="food-footer">
                        <div class="food-price">Rp 55.000</div>
                        <button class="add-to-cart">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="food-img">
                    <img src="https://source.unsplash.com/500x300/?soup" alt="Vegetable Soup">
                </div>
                <div class="food-content">
                    <div class="food-title">Vegetable Soup</div>
                    <div class="food-desc">Hearty vegetable soup made with fresh local ingredients.</div>
                    <div class="food-footer">
                        <div class="food-price">Rp 40.000</div>
                        <button class="add-to-cart">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="food-card">
                <div class="food-img">
                    <img src="https://source.unsplash.com/500x300/?sandwich" alt="Club Sandwich">
                </div>
                <div class="food-content">
                    <div class="food-title">Club Sandwich</div>
                    <div class="food-desc">Classic club sandwich with chicken, bacon, and fresh vegetables.</div>
                    <div class="food-footer">
                        <div class="food-price">Rp 65.000</div>
                        <button class="add-to-cart">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
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
    
    .food-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .food-filters .btn {
        background: #2d2d2d;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
    }
    
    .food-filters .btn.active {
        background: #ff7a00;
        color: white;
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

<script>
    // Food filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.food-filters .btn');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Filter logic would go here in a real implementation
                console.log('Filter selected:', this.textContent.trim());
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
