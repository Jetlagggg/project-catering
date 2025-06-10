<?php
// File: OrderItemRepository.php
require_once __DIR__ . '/../config/database.php';

class OrderItemRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getByOrderId($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, menu_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['order_id'],
            $data['menu_id'],
            $data['quantity'],
            $data['price']
        ]);
        return $this->db->lastInsertId();
    }
    
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE order_items SET order_id = ?, menu_id = ?, quantity = ?, price = ? WHERE id = ?");
        return $stmt->execute([
            $data['order_id'],
            $data['menu_id'],
            $data['quantity'],
            $data['price'],
            $id
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM order_items WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function deleteByOrderId($orderId) {
        $stmt = $this->db->prepare("DELETE FROM order_items WHERE order_id = ?");
        return $stmt->execute([$orderId]);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM order_items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}