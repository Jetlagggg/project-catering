<?php
// Halaman Order untuk website promosi
?>

<div class="about-hero">
    <div class="about-container">        <div class="section-title">
            <h2>Buat Pesanan Anda</h2>
        </div>
    </div>
</div>

<div class="order-section">
    <div class="order-container">
        <div class="cart-items">
            <h3>Pesanan Anda</h3>
            
            <?php if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) : ?>
                <div class="cart-items-list">
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item) : 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <h4><?= htmlspecialchars($item['name']) ?></h4>
                                <p>Rp <?= number_format($item['price'], 0, ',', '.') ?> x <?= $item['quantity'] ?></p>
                            </div>
                            <div class="cart-item-total">
                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                            </div>
                            <div class="cart-item-actions">
                                <a href="/TubesYos/public/?page=order&action=updateItem&id=<?= $item['id'] ?>&qty=<?= $item['quantity'] - 1 ?>" class="qty-btn">-</a>
                                <span class="item-qty"><?= $item['quantity'] ?></span>
                                <a href="/TubesYos/public/?page=order&action=updateItem&id=<?= $item['id'] ?>&qty=<?= $item['quantity'] + 1 ?>" class="qty-btn">+</a>
                                <a href="/TubesYos/public/?page=order&action=removeItem&id=<?= $item['id'] ?>" class="remove-btn"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="cart-total">
                    <h3>Total: Rp <?= number_format($total, 0, ',', '.') ?></h3>
                </div>
            <?php else : ?>                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Keranjang Anda kosong</p>
                    <a href="/TubesYos/public/?page=menu" class="hero-cta">Lihat Menu</a>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) : ?>
            <div class="order-form">
                <h3>Detail Pelanggan</h3>
                <form action="/TubesYos/public/?page=order&action=placeOrder" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Delivery Address</label>
                        <textarea id="address" name="address" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                        <input type="date" id="event_date" name="event_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event_time">Event Time</label>
                        <input type="time" id="event_time" name="event_time" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="guests">Number of Guests</label>
                        <input type="number" id="guests" name="guests" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Special Requirements</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Place Order</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .order-section {
        padding: 5rem 0;
    }
    
    .order-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }
    
    .cart-items, .order-form {
        background-color: #fff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .cart-items h3, .order-form h3 {
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eee;
    }
    
    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f5f5f5;
    }
    
    .cart-item-info {
        flex: 1;
    }
    
    .cart-item-info h4 {
        margin-bottom: 0.3rem;
    }
    
    .cart-item-info p {
        color: #777;
        font-size: 0.9rem;
    }
    
    .cart-item-total {
        font-weight: 600;
        margin: 0 2rem;
    }
    
    .cart-item-actions {
        display: flex;
        align-items: center;
    }
    
    .qty-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        background-color: #f5f5f5;
        border-radius: 50%;
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }
    
    .item-qty {
        margin: 0 0.5rem;
        min-width: 20px;
        text-align: center;
    }
    
    .remove-btn {
        margin-left: 1rem;
        color: #ff6b6b;
        text-decoration: none;
    }
    
    .cart-total {
        margin-top: 2rem;
        text-align: right;
    }
    
    .empty-cart {
        text-align: center;
        padding: 3rem 0;
    }
    
    .empty-cart i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 1rem;
    }
    
    .empty-cart p {
        color: #888;
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }
    
    @media (max-width: 768px) {
        .order-container {
            grid-template-columns: 1fr;
        }
    }
</style>
