<div class="card">
    <div class="card-header">
        <h2>Order History</h2>
    </div>
    <div class="card-body">
        <div class="order-filters">
            <button class="btn active">All Orders</button>
            <button class="btn">Processing</button>
            <button class="btn">Delivered</button>
            <button class="btn">Cancelled</button>
        </div>
        
        <div class="order-list">
            <?php if (isset($orders) && !empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #<?= $order->id ?></strong>
                        </div>
                        <div class="order-date">
                            <?= date('d M Y', strtotime($order->order_date)) ?>
                        </div>
                        <div class="order-status <?= strtolower($order->status) ?>">
                            <?= $order->status ?>
                        </div>
                    </div>
                    <div class="order-content">
                        <div class="order-items">
                            <?php foreach ($order->items as $item): ?>
                            <div class="order-food-item">
                                <div class="food-img">
                                    <img src="<?= $item->image_url ?? 'https://source.unsplash.com/100x100/?food' ?>" alt="<?= $item->name ?>">
                                </div>
                                <div class="food-details">
                                    <div class="food-title"><?= $item->name ?></div>
                                    <div class="food-price">Rp <?= number_format($item->price, 0, ',', '.') ?> x <?= $item->quantity ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="order-summary">
                            <div class="order-total">
                                <span>Total:</span>
                                <strong>Rp <?= number_format($order->total, 0, ',', '.') ?></strong>
                            </div>
                            <div class="order-actions">
                                <button class="btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <?php if ($order->status === 'Processing'): ?>
                                <button class="btn btn-outline">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Sample orders for demonstration -->
                <div class="order-item">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #12345</strong>
                        </div>
                        <div class="order-date">
                            07 Jun 2025
                        </div>
                        <div class="order-status processing">
                            Processing
                        </div>
                    </div>
                    <div class="order-content">
                        <div class="order-items">
                            <div class="order-food-item">
                                <div class="food-img">
                                    <img src="https://source.unsplash.com/100x100/?pasta" alt="Italian Pasta">
                                </div>
                                <div class="food-details">
                                    <div class="food-title">Italian Pasta</div>
                                    <div class="food-price">Rp 75.000 x 2</div>
                                </div>
                            </div>
                            <div class="order-food-item">
                                <div class="food-img">
                                    <img src="https://source.unsplash.com/100x100/?salad" alt="Garden Salad">
                                </div>
                                <div class="food-details">
                                    <div class="food-title">Garden Salad</div>
                                    <div class="food-price">Rp 45.000 x 1</div>
                                </div>
                            </div>
                        </div>
                        <div class="order-summary">
                            <div class="order-total">
                                <span>Total:</span>
                                <strong>Rp 195.000</strong>
                            </div>
                            <div class="order-actions">
                                <button class="btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button class="btn btn-outline">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-item">
                    <div class="order-header">
                        <div class="order-id">
                            <strong>Order #12344</strong>
                        </div>
                        <div class="order-date">
                            05 Jun 2025
                        </div>
                        <div class="order-status delivered">
                            Delivered
                        </div>
                    </div>
                    <div class="order-content">
                        <div class="order-items">
                            <div class="order-food-item">
                                <div class="food-img">
                                    <img src="https://source.unsplash.com/100x100/?steak" alt="Grilled Steak">
                                </div>
                                <div class="food-details">
                                    <div class="food-title">Grilled Steak</div>
                                    <div class="food-price">Rp 150.000 x 1</div>
                                </div>
                            </div>
                            <div class="order-food-item">
                                <div class="food-img">
                                    <img src="https://source.unsplash.com/100x100/?soup" alt="Vegetable Soup">
                                </div>
                                <div class="food-details">
                                    <div class="food-title">Vegetable Soup</div>
                                    <div class="food-price">Rp 40.000 x 1</div>
                                </div>
                            </div>
                        </div>
                        <div class="order-summary">
                            <div class="order-total">
                                <span>Total:</span>
                                <strong>Rp 190.000</strong>
                            </div>
                            <div class="order-actions">
                                <button class="btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* Order history styles */
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
    
    .order-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .order-filters .btn {
        background: #2d2d2d;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
    }
    
    .order-filters .btn.active {
        background: #ff7a00;
        color: white;
    }
    
    .order-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .order-item {
        background: #1e1e1e;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #2d2d2d;
        border-bottom: 1px solid #3d3d3d;
    }
    
    .order-status {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
    }
      .order-status.processing {
        background: rgba(255, 193, 7, 0.15);
        color: #ffc107;
    }
    
    .order-status.delivered {
        background: rgba(40, 167, 69, 0.15);
        color: #28a745;
    }
    
    .order-status.cancelled {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }
    
    .order-id strong,
    .order-date {
        color: #ffffff;
    }
    
    .order-content {
        padding: 20px;
    }
    
    .order-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .order-food-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .order-food-item .food-img {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        overflow: hidden;
    }
    
    .order-food-item .food-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .order-food-item .food-details {
        flex: 1;
    }
    
    .order-food-item .food-title {
        font-weight: 500;
        color: #ffffff;
        margin-bottom: 5px;
    }
    
    .order-food-item .food-price {
        color: #8c92a3;
        font-size: 13px;
    }
      .order-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #2d2d2d;
    }
    
    .order-total {
        font-size: 15px;
        color: #ffffff;
    }
    
    .order-total strong {
        color: #ff7a00;
        margin-left: 5px;
    }
    
    .order-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn {
        padding: 8px 16px !important;
        font-size: 13px !important;
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid #3d3d3d;
        color: #ffffff;
    }
    
    .btn-outline:hover {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border-color: #dc3545;
        transform: translateY(-2px);
    }
</style>

<script>
    // Order filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.order-filters .btn');
        
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
    });
</script>
