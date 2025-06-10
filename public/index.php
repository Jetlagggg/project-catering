<?php
// Entry point untuk website promosi Foody

// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inisialisasi session
session_start();

// Set base path untuk website promosi
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', __DIR__);

// Load konfigurasi database
require_once BASE_PATH . '/config/database.php';

// Load controller yang dibutuhkan website promosi
require_once BASE_PATH . '/controllers/PublicController.php';
require_once BASE_PATH . '/controllers/MenuController.php';
require_once BASE_PATH . '/controllers/OrderController.php';

// Ambil parameter dari URL
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Tentukan controller berdasarkan page
switch ($page) {
    case 'menu':
    case 'foods':
        $controller = new MenuController('public');
        break;
    case 'order':
        $controller = new OrderController('public');
        
        // Default action untuk order di public site
        if ($action === 'index') {
            $action = 'publicIndex';
        }
        break;
    case 'home':
    default:
        $controller = new PublicController();
        break;
}

// Jalankan action
if (method_exists($controller, $action)) {
    if ($id !== null) {
        $controller->$action($id);
    } else {
        $controller->$action();
    }
} else {
    // Tampilkan halaman 404
    header("HTTP/1.0 404 Not Found");
    include BASE_PATH . '/views/public/404.php';
    exit;
}
