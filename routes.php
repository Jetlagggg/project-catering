<?php
// Note: This file digunakan untuk routing lama sebelum pemisahan admin/public
// Sekarang sebaiknya menggunakan admin/index.php atau public/index.php

session_start();

// Base path untuk jalur file yang benar
define('BASE_PATH', __DIR__);

// Load controller
require_once BASE_PATH . '/controllers/ClientController.php';
require_once BASE_PATH . '/controllers/MenuController.php';
require_once BASE_PATH . '/controllers/OrderController.php';
require_once BASE_PATH . '/controllers/InvoiceController.php';
require_once BASE_PATH . '/controllers/DashboardController.php';

// Ambil parameter dari URL
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Tentukan controller berdasarkan page
switch ($page) {
    case 'clients':
        $controller = new ClientController();
        break;    case 'menus':
    case 'foods':
        $controller = new MenuController();
        break;case 'orders':
    case 'history':
        $controller = new OrderController();
        break;
    case 'invoices':
        $controller = new InvoiceController();
        break;
    case 'dashboard':
    default:
        $controller = new DashboardController();
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
    echo "404 - Halaman tidak ditemukan.";
}
