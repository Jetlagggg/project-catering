<?php
require_once __DIR__ . '/../config/database.php';

class ClientRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ambil semua client
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM clients");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cari client berdasarkan ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // tambah client baru
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO clients (name, phone, address) VALUES (:name, :phone, :address)");
        return $stmt->execute([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);
    }

    // update client
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE clients SET name = :name, phone = :phone, address = :address WHERE id = :id");
        return $stmt->execute([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'id' => $id
        ]);
    }

    // hapus client
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
