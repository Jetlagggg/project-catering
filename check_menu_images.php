<?php
require_once 'config/database.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    echo "Checking current menus in database:\n\n";
    
    $stmt = $conn->query('SELECT id, name, description, price, image_url, category FROM menus ORDER BY id DESC LIMIT 10');
    $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($menus)) {
        echo "No menus found in database.\n";
    } else {
        foreach ($menus as $menu) {
            echo "ID: " . $menu['id'] . "\n";
            echo "Name: " . $menu['name'] . "\n";
            echo "Image: " . ($menu['image_url'] ?? 'No image') . "\n";
            echo "Category: " . ($menu['category'] ?? 'No category') . "\n";
            
            // Check if image file exists
            if ($menu['image_url']) {
                $imagePath = $menu['image_url'];
                if (file_exists($imagePath)) {
                    echo "Image file: EXISTS\n";
                } else {
                    echo "Image file: NOT FOUND at $imagePath\n";
                }
            }
            echo "---\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
