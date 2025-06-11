<?php
require_once __DIR__ . '/../config/database.php';

class InvoiceRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM invoices");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM invoices WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO invoices (client_id, order_id, amount, created_at) VALUES (:client_id, :order_id, :amount, NOW())");
        return $stmt->execute([
            'client_id' => $data['client_id'],
            'order_id' => $data['order_id'],
            'amount' => $data['amount']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE invoices SET client_id = :client_id, order_id = :order_id, amount = :amount WHERE id = :id");
        return $stmt->execute([
            'client_id' => $data['client_id'],
            'order_id' => $data['order_id'],
            'amount' => $data['amount'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM invoices WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function getByStatus($status) {
    $stmt = $this->db->prepare("SELECT * FROM invoices WHERE status = :status");
    $stmt->execute(['status' => $status]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
