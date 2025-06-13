<?php
// Entry point untuk admin panel Family 88

// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Add simple debug log
error_log('Admin dashboard loading: ' . date('Y-m-d H:i:s'));

// Inisialisasi session
session_start();

// Set base path untuk admin panel
define('BASE_PATH', dirname(__DIR__));
define('ADMIN_PATH', __DIR__);

// Load konfigurasi database
require_once BASE_PATH . '/config/database.php';

// Load repositories
require_once BASE_PATH . '/repositories/MenuRepository.php';
require_once BASE_PATH . '/repositories/AdminRepository.php';

// Cek autentikasi admin
require_once 'auth.php';

// Initialize repositories
$menuRepo = new MenuRepository();
$adminRepo = new AdminRepository();

// Get statistics
$menuCount = $menuRepo->countAll();
$menuItems = $menuRepo->getPopular(5);
$admin = $adminRepo->getAdminById($_SESSION['admin_id']);

// Set page title
$pageTitle = 'Dashboard Admin';

// Include the header
include_once 'views/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Menu Terdaftar</h5>
                            <div class="d-flex align-items-center mt-3">
                                <i class="fas fa-utensils fa-3x text-warning"></i>
                                <h2 class="ml-3"><?= $menuCount ?></h2>
                            </div>
                            <div class="mt-3">
                                <a href="menu_management.php" class="btn btn-sm btn-outline-warning">Kelola Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Terakhir Login</h5>
                            <div class="d-flex align-items-center mt-3">
                                <i class="fas fa-clock fa-3x text-info"></i>
                                <div class="ml-3">
                                    <?php if ($admin && $admin['last_login']): ?>
                                        <h5><?= date('d M Y, H:i', strtotime($admin['last_login'])) ?></h5>
                                    <?php else: ?>
                                        <h5>Data tidak tersedia</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Info Admin</h5>
                            <div class="d-flex align-items-center mt-3">
                                <i class="fas fa-user fa-3x text-primary"></i>
                                <div class="ml-3">
                                    <h5><?= $_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?></h5>
                                    <?php if ($admin && $admin['email']): ?>
                                        <p><?= $admin['email'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Menu Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($menuItems)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data menu</td>
                                            </tr>
                                        <?php else: ?>                                            <?php foreach ($menuItems as $menu): ?>
                                                <tr>
                                                    <td><?= $menu['id'] ?></td>
                                                    <td><?= htmlspecialchars($menu['name']) ?></td>
                                                    <td>Rp <?= number_format($menu['price'], 0, ',', '.') ?></td>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            Tersedia
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Akses Cepat</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <a href="menu_management.php" class="btn btn-warning btn-block">
                                        <i class="fas fa-utensils mr-2"></i> Kelola Menu
                                    </a>
                                </div>                <div class="col-md-6 mb-3">
                    <a href="order_management.php" class="btn btn-info btn-block">
                        <i class="fas fa-shopping-cart mr-2"></i> Pesanan
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="#" class="btn btn-success btn-block">
                        <i class="fas fa-users mr-2"></i> Pelanggan
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="../index.php" target="_blank" class="btn btn-secondary btn-block">
                        <i class="fas fa-globe mr-2"></i> Lihat Website
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="force_logout.php" class="btn btn-danger btn-block">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include_once 'views/footer.php';
?>
