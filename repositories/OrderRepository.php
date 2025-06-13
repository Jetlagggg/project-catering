<?php
require_once __DIR__ . '/../config/database.php';

class OrderRepository {
    private static $instance = null;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new OrderRepository();
        }
        return self::$instance;
    }    public function getAll() {
        try {
            $sql = "SELECT o.*, c.name as client_name, m.name as menu_name, m.price 
                    FROM orders o 
                    LEFT JOIN clients c ON o.client_id = c.id 
                    LEFT JOIN menus m ON o.menu_id = m.id 
                    ORDER BY o.order_date DESC";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return is_array($result) ? $result : [];
        } catch (Exception $e) {
            error_log("Error in OrderRepository::getAll(): " . $e->getMessage());
            return [];
        }
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO orders (client_id, menu_id, quantity, order_date, status) VALUES (:client_id, :menu_id, :quantity, :order_date, :status)");
        return $stmt->execute([
            'client_id' => $data['client_id'],
            'menu_id' => $data['menu_id'],
            'quantity' => $data['quantity'],
            'order_date' => $data['order_date'],
            'status' => $data['status']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE orders SET client_id = :client_id, menu_id = :menu_id, quantity = :quantity, order_date = :order_date, status = :status WHERE id = :id");
        return $stmt->execute([
            'client_id' => $data['client_id'],
            'menu_id' => $data['menu_id'],
            'quantity' => $data['quantity'],
            'order_date' => $data['order_date'],
            'status' => $data['status'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Count total orders
    public function countAll() {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM orders");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }
    
    // Get recent orders with client info
    public function getRecent($limit = 5) {
        $sql = "SELECT o.*, c.name as client_name 
                FROM orders o 
                LEFT JOIN clients c ON o.client_id = c.id 
                ORDER BY o.order_date DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Get orders by status
    public function getByStatus($status) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);    }
    
    public function getLastOrderWithDetail() {
        $sql = "SELECT o.*, c.name as client_name, c.phone, m.name as menu_name, m.price 
                FROM orders o 
                LEFT JOIN clients c ON o.client_id = c.id 
                LEFT JOIN menus m ON o.menu_id = m.id 
                ORDER BY o.id DESC 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
