<?php
require_once 'config/database.php';

try {
    $db = new Database();
    $conn = $db->connect();
    
    echo "Checking menus table structure:\n\n";
    
    $stmt = $conn->query('DESCRIBE menus');
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "Field: " . $column['Field'] . "\n";
        echo "Type: " . $column['Type'] . "\n";
        echo "Null: " . $column['Null'] . "\n";
        echo "Default: " . $column['Default'] . "\n";
        echo "---\n";
    }
    
    echo "\nSample data from menus table:\n\n";
    $stmt = $conn->query('SELECT * FROM menus LIMIT 3');
    $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($samples as $sample) {
        print_r($sample);
        echo "---\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
