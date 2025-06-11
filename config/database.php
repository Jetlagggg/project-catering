<?php
class Database {    
    private $host = 'localhost';
    public $db_name = 'tubes_db'; // Database yang sudah ada, public untuk akses di check_connection.php
    private $username = 'root';
    private $password = '';
    public $conn;
    
    public function connect() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=".$this->host.";dbname=".$this->db_name;
            $this->conn = new PDO(
                $dsn,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Cek apakah connection berhasil
            if ($this->conn) {
                // Koneksi berhasil
                error_log("Database connection successful to {$this->host}/{$this->db_name}");
            }
        } catch(PDOException $e) {
            // Log error
            error_log("Database Connection Error: ".$e->getMessage());
            
            // Tampilkan error secara jelas untuk debugging
            echo "<div style='background-color:#f8d7da; color:#721c24; padding:20px; margin:20px; border:1px solid #f5c6cb; border-radius:5px;'>";
            echo "<h3>Database Connection Error</h3>";
            echo "<p>".$e->getMessage()."</p>";
            echo "<p>Cek apakah database '{$this->db_name}' sudah dibuat dan XAMPP sedang berjalan.</p>";
            echo "</div>";
            exit;
        }
        return $this->conn;
    }
}
