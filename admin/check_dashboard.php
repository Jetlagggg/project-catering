<?php
// Script to check if dashboard can be rendered properly

// Enable error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Make sure we are logged in
if (!isset($_SESSION['admin_logged_in'])) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = 'debugger';
    $_SESSION['admin_id'] = 1;
    $_SESSION['admin_name'] = 'Debug User';
}

// Set base path for admin panel
define('BASE_PATH', dirname(__DIR__));
define('ADMIN_PATH', __DIR__);

try {
    // Load essential files
    require_once BASE_PATH . '/config/database.php';
    echo "✓ Database config loaded<br>";
    
    require_once BASE_PATH . '/repositories/MenuRepository.php';
    echo "✓ MenuRepository loaded<br>";
    
    require_once BASE_PATH . '/repositories/AdminRepository.php';
    echo "✓ AdminRepository loaded<br>";
    
    // Initialize repositories
    $menuRepo = new MenuRepository();
    echo "✓ MenuRepository initialized<br>";
    
    $adminRepo = new AdminRepository();
    echo "✓ AdminRepository initialized<br>";
    
    // Get data for dashboard
    $menuCount = $menuRepo->countAll();
    echo "✓ Menu count: $menuCount<br>";
    
    $menuItems = $menuRepo->getPopular(5);
    echo "✓ Popular menu items retrieved: " . count($menuItems) . "<br>";
    
    $admin = $adminRepo->getAdminById($_SESSION['admin_id']);
    echo "✓ Admin info retrieved: " . ($admin ? 'Yes' : 'No') . "<br>";
    
    // Set page title
    $pageTitle = 'Dashboard Admin';
    echo "✓ Page title set<br>";
    
    // Test if header can be included
    echo "Trying to include header...<br>";
    ob_start();
    include_once 'views/header.php';
    $header = ob_get_clean();
    echo "✓ Header template processed<br>";
    
    // Test if footer can be included
    echo "Trying to include footer...<br>";
    ob_start();
    include_once 'views/footer.php';
    $footer = ob_get_clean();
    echo "✓ Footer template processed<br>";
    
    echo "<div style='background-color: #dff0d8; color: #3c763d; padding: 15px; border-radius: 4px; margin-top: 20px;'>
        <strong>Success!</strong> All components of the dashboard are loading correctly.
        <p><a href='index.php' class='btn btn-success'>Go to Dashboard</a></p>
    </div>";
    
} catch (Exception $e) {
    echo "<div style='background-color: #f2dede; color: #a94442; padding: 15px; border-radius: 4px; margin-top: 20px;'>
        <strong>Error:</strong> " . $e->getMessage() . "
    </div>";
    
    echo "<h3>Stack trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
