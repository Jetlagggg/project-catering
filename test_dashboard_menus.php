<?php
require_once 'config/database.php';
require_once 'repositories/MenuRepository.php';

$menuRepo = new MenuRepository();
$menus = $menuRepo->getAll();

echo "Total menus in database: " . count($menus) . "\n";

if (count($menus) > 0) {
    echo "Sample menus:\n";
    foreach (array_slice($menus, 0, 3) as $menu) {
        echo "- " . $menu['name'] . " (Rp " . number_format($menu['price'], 0, ',', '.') . ")\n";
        echo "  Image: " . ($menu['image_url'] ?? 'No image') . "\n";
    }
} else {
    echo "No menu items found in database.\n";
}

// Test getPopular method
$popularMenus = $menuRepo->getPopular(4);
echo "\nPopular menus (limit 4): " . count($popularMenus) . "\n";
foreach ($popularMenus as $menu) {
    echo "- " . $menu['name'] . " (Rp " . number_format($menu['price'], 0, ',', '.') . ")\n";
}
