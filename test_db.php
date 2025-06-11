<?php
// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Impor konfigurasi database
require_once __DIR__ . '/config/database.php';

echo "<h1>Database Connection Test</h1>";

try {
    // Buat koneksi
    $database = new Database();
    $conn = $database->connect();
    
    echo "<div style='background-color:#d4edda; color:#155724; padding:20px; margin:20px; border:1px solid #c3e6cb; border-radius:5px;'>";
    echo "<h3>Database Connection Successful!</h3>";
    echo "<p>Connected to database: <strong>" . $database->db_name . "</strong></p>";
    echo "</div>";
    
    // Check if tables exist
    $tables = [
        'clients', 
        'menus', 
        'orders', 
        'order_items', 
        'invoices', 
        'admins'
    ];
    
    echo "<h2>Table Status:</h2>";
    echo "<ul>";
    
    foreach ($tables as $table) {
        $stmt = $conn->query("SHOW TABLES LIKE '$table'");
        $exists = $stmt->rowCount() > 0;
        
        if ($exists) {
            echo "<li style='color: green;'>✓ Table '$table' exists</li>";
            
            // Get row count
            $count = $conn->query("SELECT COUNT(*) FROM $table")->fetchColumn();
            echo "<ul><li>Contains $count records</li></ul>";
        } else {
            echo "<li style='color: red;'>✗ Table '$table' is missing! You need to create this table.</li>";
        }
    }
    
    echo "</ul>";
    
    // Check if admin user exists
    if (in_array('admins', $tables)) {
        $stmt = $conn->query("SELECT * FROM admins WHERE username = 'admin'");
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($admin) {
            echo "<div style='background-color:#d4edda; color:#155724; padding:20px; margin:20px; border:1px solid #c3e6cb; border-radius:5px;'>";
            echo "<h3>Admin User Exists</h3>";
            echo "<p>Username: admin</p>";
            echo "</div>";
        } else {
            echo "<div style='background-color:#fff3cd; color:#856404; padding:20px; margin:20px; border:1px solid #ffeeba; border-radius:5px;'>";
            echo "<h3>Admin User Missing</h3>";
            echo "<p>Creating default admin user (username: admin, password: admin123)</p>";
            
            // Create admin user
            $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO admins (username, password, name, email) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute(['admin', $hashedPassword, 'Admin Family 88', 'admin@example.com']);
            
            if ($result) {
                echo "<p>Admin user created successfully!</p>";
            } else {
                echo "<p>Failed to create admin user.</p>";
            }
            
            echo "</div>";
        }
    }
    
} catch(PDOException $e) {
    echo "<div style='background-color:#f8d7da; color:#721c24; padding:20px; margin:20px; border:1px solid #f5c6cb; border-radius:5px;'>";
    echo "<h3>Database Connection Error</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Check your database configuration in <code>config/database.php</code></p>";
    echo "</div>";
}
