<?php
// Dashboard admin panel
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        <p>Welcome back, <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?>!</p>
    </div>
    
    <!-- Statistik Overview -->
    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-info">
                <h3>Orders</h3>
                <p class="stat-count"><?= $stats['totalOrders'] ?? 0 ?></p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="stat-info">
                <h3>Menu Items</h3>
                <p class="stat-count"><?= $stats['totalMenus'] ?? 0 ?></p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Clients</h3>
                <p class="stat-count"><?= $stats['totalClients'] ?? 0 ?></p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div class="stat-info">
                <h3>Invoices</h3>
                <p class="stat-count"><?= $stats['totalInvoices'] ?? 0 ?></p>
                <p class="stat-sub-count"><?= $stats['unpaidInvoices'] ?? 0 ?> unpaid</p>
            </div>
        </div>
    </div>
    
    <!-- Recent Orders & Popular Menu Items -->
    <div class="dashboard-panels">
        <div class="panel">
            <div class="panel-header">
                <h3>Recent Orders</h3>
                <a href="/TubesYos/admin/?page=orders" class="view-all">View All <i class="fas fa-angle-right"></i></a>
            </div>
            <div class="panel-content">
                <?php if (!empty($stats['recentOrders'])) : ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stats['recentOrders'] as $order) : ?>
                                <tr>
                                    <td>#<?= $order['id'] ?></td>
                                    <td><?= htmlspecialchars($order['client_name'] ?? 'Unknown') ?></td>
                                    <td><?= date('d M Y', strtotime($order['order_date'])) ?></td>
                                    <td>
                                        <span class="badge status-<?= strtolower($order['status']) ?>">
                                            <?= htmlspecialchars($order['status']) ?>
                                        </span>
                                    </td>
                                    <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="empty-state">
                        <i class="fas fa-info-circle"></i>
                        <p>No recent orders found</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="panel">
            <div class="panel-header">
                <h3>Popular Menu Items</h3>
                <a href="/TubesYos/admin/?page=menus" class="view-all">View All <i class="fas fa-angle-right"></i></a>
            </div>
            <div class="panel-content">
                <?php if (!empty($stats['popularMenus']) && count($stats['popularMenus']) > 0) : ?>
                    <div class="popular-menu-grid">
                        <?php foreach (array_slice($stats['popularMenus'], 0, 4) as $menu) : ?>
                            <div class="popular-menu-item">
                                <div class="menu-thumb">
                                    <?php if (!empty($menu['image_url'])) : ?>
                                        <img src="<?= $menu['image_url'] ?>" alt="<?= htmlspecialchars($menu['name']) ?>">
                                    <?php else : ?>
                                        <div class="no-image"><i class="fas fa-utensils"></i></div>
                                    <?php endif; ?>
                                </div>
                                <div class="menu-info">
                                    <h4><?= htmlspecialchars($menu['name']) ?></h4>
                                    <div class="menu-price">Rp <?= number_format($menu['price'], 0, ',', '.') ?></div>
                                    <div class="menu-category"><?= htmlspecialchars($menu['category'] ?? 'Uncategorized') ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <i class="fas fa-info-circle"></i>
                        <p>No menu items found</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-container {
        padding: 1.5rem;
    }
    
    .dashboard-header {
        margin-bottom: 2rem;
    }
    
    .dashboard-header h2 {
        display: flex;
        align-items: center;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }
    
    .dashboard-header h2 i {
        margin-right: 0.5rem;
        color: #ff6b6b;
    }
    
    .dashboard-header p {
        color: #aaa;
    }
    
    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    
    .stat-card {
        background-color: #333;
        border-radius: 10px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-right: 1rem;
    }
    
    .stat-card:nth-child(1) .stat-icon {
        background-color: rgba(99, 179, 237, 0.2);
        color: #63b3ed;
    }
    
    .stat-card:nth-child(2) .stat-icon {
        background-color: rgba(72, 187, 120, 0.2);
        color: #48bb78;
    }
    
    .stat-card:nth-child(3) .stat-icon {
        background-color: rgba(246, 173, 85, 0.2);
        color: #f6ad55;
    }
    
    .stat-card:nth-child(4) .stat-icon {
        background-color: rgba(237, 100, 166, 0.2);
        color: #ed64a6;
    }
    
    .stat-info h3 {
        font-size: 1rem;
        color: #ccc;
        margin-bottom: 0.3rem;
    }
    
    .stat-count {
        font-size: 2rem;
        font-weight: bold;
        color: #fff;
        margin: 0;
    }
    
    .stat-sub-count {
        font-size: 0.9rem;
        color: #aaa;
        margin-top: 0.2rem;
    }
    
    .dashboard-panels {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 1.5rem;
    }
    
    .panel {
        background-color: #333;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .panel-header {
        background-color: #3a3a3a;
        padding: 1.2rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .panel-header h3 {
        font-size: 1.2rem;
        color: #fff;
        margin: 0;
    }
    
    .view-all {
        color: #ff6b6b;
        text-decoration: none;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        transition: color 0.3s ease;
    }
    
    .view-all i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }
    
    .view-all:hover {
        color: #ff5252;
    }
    
    .view-all:hover i {
        transform: translateX(3px);
    }
    
    .panel-content {
        padding: 1.5rem;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.8rem;
        text-align: left;
    }
    
    .data-table th {
        color: #ccc;
        font-weight: 500;
        border-bottom: 1px solid #444;
    }
    
    .data-table td {
        color: #aaa;
        border-top: 1px solid #3a3a3a;
    }
    
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-completed,
    .status-paid {
        background-color: rgba(72, 187, 120, 0.2);
        color: #48bb78;
    }
    
    .status-pending {
        background-color: rgba(246, 173, 85, 0.2);
        color: #f6ad55;
    }
    
    .status-cancelled,
    .status-unpaid {
        background-color: rgba(245, 101, 101, 0.2);
        color: #f56565;
    }
    
    .status-processing {
        background-color: rgba(99, 179, 237, 0.2);
        color: #63b3ed;
    }
    
    .empty-state {
        text-align: center;
        padding: 2rem 0;
    }
    
    .empty-state i {
        font-size: 2.5rem;
        color: #555;
        margin-bottom: 1rem;
    }
    
    .empty-state p {
        color: #777;
    }
    
    .popular-menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .popular-menu-item {
        background-color: #3a3a3a;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .popular-menu-item:hover {
        transform: translateY(-5px);
    }
    
    .menu-thumb {
        height: 120px;
        overflow: hidden;
    }
    
    .menu-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .popular-menu-item:hover .menu-thumb img {
        transform: scale(1.1);
    }
    
    .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #444;
        color: #aaa;
        font-size: 2rem;
    }
    
    .menu-info {
        padding: 1rem;
    }
    
    .menu-info h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
        color: #eee;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .menu-price {
        font-weight: bold;
        color: #ff6b6b;
        margin-bottom: 0.3rem;
    }
    
    .menu-category {
        font-size: 0.8rem;
        color: #888;
    }
    
    @media (max-width: 768px) {
        .dashboard-panels {
            grid-template-columns: 1fr;
        }
        
        .popular-menu-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }
</style>
