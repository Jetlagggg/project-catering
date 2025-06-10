<?php
class Invoice {
    private $conn;
    private $table = 'invoices';

    public $id;
    public $client_id;
    public $invoice_number;
    public $amount;
    public $due_date;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT 
                    i.id, 
                    i.invoice_number, 
                    i.amount, 
                    i.due_date, 
                    i.status, 
                    i.created_at, 
                    c.name as client_name 
                  FROM ' . $this->table . ' i 
                  LEFT JOIN clients c ON i.client_id = c.id 
                  ORDER BY i.created_at DESC';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET 
                    client_id = :client_id, 
                    invoice_number = :invoice_number, 
                    amount = :amount, 
                    due_date = :due_date, 
                    status = :status';
        
        $stmt = $this->conn->prepare($query);
        
        $this->client_id = htmlspecialchars(strip_tags($this->client_id));
        $this->invoice_number = htmlspecialchars(strip_tags($this->invoice_number));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->status = htmlspecialchars(strip_tags($this->status));
        
        $stmt->bindParam(':client_id', $this->client_id);
        $stmt->bindParam(':invoice_number', $this->invoice_number);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':status', $this->status);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
