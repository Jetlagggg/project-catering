<div class="hero-container">
    <img src="/TubesYos/assets/img/cook.gif" class="hero-background" alt="Cooking background">
    <div class="hero-content">
        <h1>Delicious Food For Your Events</h1>
        <p>We provide premium catering services for all your needs. From corporate events to weddings, we have the perfect menu for every occasion.</p>
        <a href="index.php?page=foods" class="hero-cta" id="explore-menu-btn">
            <i class="fas fa-utensils"></i> Explore Our Menu
        </a>
    </div>
</div>
<style>
.hero-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    height: 300px;
}
.hero-background {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.4);
}
.hero-content {
    position: relative;
    z-index: 2;
    padding: 40px;
    color: white;
}
</style>
<style>
    .explore-menu-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: var(--primary);
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }
    .explore-menu-btn:hover {
        background-color: var(--primary-dark);
    }
    
    /* Stats section */
    #explore-our-menu {
        margin-bottom: 20px;
    }
    
    .menu-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ff7a00;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
    }
    
    .menu-link:hover {
        text-decoration: underline;
    }
    
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-box {
        background: #1e1e1e;
        border-radius: 8px;
        padding: 20px;
    }
    
    .stat-content h2 {
        font-size: 24px;
        color: white;
        margin: 0 0 5px 0;
        font-weight: 700;
    }
    
    .stat-content p {
        margin: 0;
        color: #8c92a3;
    }
    
    .stat-explore {
        margin-top: 15px;
    }
    
    .stat-explore a {
        color: #ff7a00;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .stat-explore a:hover {
        text-decoration: underline;
    }
    
    @media (min-width: 768px) {
        .dashboard-stats {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    /* Food Grid Styles */
    .food-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .food-card {
        background: #1e1e1e;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .food-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
    }
    
    .food-img {
        height: 150px;
        overflow: hidden;
        position: relative;
    }
    
    .food-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .food-card:hover .food-img img {
        transform: scale(1.05);
    }
    
    .food-content {
        padding: 15px;
    }
    
    .food-title {
        font-size: 16px;
        font-weight: 600;
        color: white;
        margin-bottom: 8px;
    }
    
    .food-desc {
        font-size: 14px;
        color: #8c92a3;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    
    .food-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .food-price {
        font-size: 16px;
        font-weight: 700;
        color: #ff7a00;
    }
    
    .add-to-cart {
        background: #ff7a00;
        color: white;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    
    .add-to-cart:hover {
        background: #e66a00;
        transform: scale(1.1);
    }
    
    .no-menu-message {
        text-align: center;
        padding: 40px 20px;
        color: #8c92a3;
        grid-column: 1 / -1;
    }
    
    .no-menu-message p {
        margin-bottom: 20px;
        font-size: 16px;
    }
    
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ff7a00;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    
    .btn-primary:hover {
        background: #e66a00;
        text-decoration: none;
    }
</style>

<div id="explore-our-menu">
    <a href="index.php?page=foods" class="menu-link">
        <i class="fas fa-utensils"></i> Explore Our Menu
    </a>
</div>

<div class="dashboard-stats">    <div class="stat-box">
        <div class="stat-content">
            <h2><?= isset($popularMenus) ? count($popularMenus) : '0' ?>+</h2>
            <p>Premium Dishes</p>
        </div>
        <div class="stat-explore">
            <a href="index.php?page=foods">Explore Menu <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="stat-box">
        <div class="stat-content">
            <h2>24/7</h2>
            <p>Customer Support</p>
        </div>
        <div class="stat-explore">
            <a href="#">Contact Us <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="stat-box">
        <div class="stat-content">
            <h2>Fast</h2>
            <p>Delivery Service</p>
        </div>
        <div class="stat-explore">
            <a href="#">Learn More <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="stat-box">
        <div class="stat-content">
            <h2>4.9<sup>/5</sup></h2>
            <p>Customer Rating</p>
        </div>
        <div class="stat-more">
            <a href="#">Read Reviews <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Popular Food Items</h2>
    </div>
    <div class="card-body">
        <div class="food-grid">
            <?php if (!empty($popularMenus) && count($popularMenus) > 0): ?>
                <?php foreach ($popularMenus as $menu): ?>
                    <div class="food-card">
                        <div class="food-img">
                            <img src="<?= !empty($menu['image_url']) ? '/TubesYos/' . $menu['image_url'] : '/TubesYos/assets/img/food-placeholder.jpg' ?>" 
                                 alt="<?= htmlspecialchars($menu['name']) ?>" 
                                 onerror="this.src='/TubesYos/assets/img/food-placeholder.jpg'">
                        </div>
                        <div class="food-content">
                            <div class="food-title"><?= htmlspecialchars($menu['name']) ?></div>
                            <div class="food-desc"><?= htmlspecialchars($menu['description']) ?></div>
                            <div class="food-footer">
                                <div class="food-price">Rp <?= number_format($menu['price'], 0, ',', '.') ?></div>
                                <button class="add-to-cart">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-menu-message">
                    <p>No menu items available at the moment.</p>
                    <a href="index.php?page=menus" class="btn-primary">
                        <i class="fas fa-plus"></i> Add Menu Items
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Special Events</h2>
    </div>
    <div class="card-body">
        <p>We provide catering for various types of events:</p>
        <ul>
            <li>Corporate Events</li>
            <li>Weddings</li>
            <li>Birthday Parties</li>
            <li>Family Gatherings</li>
            <li>Office Meetings</li>
        </ul>
        <p>Contact us for custom menu options tailored to your specific needs.</p>
    </div>
</div>
