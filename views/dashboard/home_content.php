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
</style>

<div id="explore-our-menu">
    <a href="index.php?page=foods" class="menu-link">
        <i class="fas fa-utensils"></i> Explore Our Menu
    </a>
</div>

<div class="dashboard-stats">
    <div class="stat-box">
        <div class="stat-content">
            <h2>100+</h2>
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
