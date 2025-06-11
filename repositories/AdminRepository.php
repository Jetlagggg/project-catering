<?php
// AdminRepository.php - Repository untuk mengelola data admins
require_once __DIR__ . '/../config/database.php';

class AdminRepository {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function verifyLogin($username, $password) {
        $admin = $this->findByUsername($username);
        
        // Log verification attempt
        error_log("Verifying login for $username - User found: " . ($admin ? 'Yes' : 'No'));
        
        if ($admin && password_verify($password, $admin['password'])) {
            // Password matches in database
            error_log("Password verification successful for $username");
            return $admin;
        }
        
        // Fallback untuk admin default jika database tidak cocok
        if ($username === 'admin' && $password === 'admin123') {
            error_log("Using fallback admin credentials for $username");
            return [
                'id' => 1,
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@example.com'
            ];
        }
        
        return false;
    }

    public function registerAdmin($username, $password, $name, $email) {
        try {
            // Check if username already exists
            if ($this->findByUsername($username)) {
                return ['success' => false, 'message' => 'Username sudah digunakan.'];
            }

            // Check if email already exists
            if ($email && $this->findByEmail($email)) {
                return ['success' => false, 'message' => 'Email sudah digunakan.'];
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new admin
            $stmt = $this->db->prepare("INSERT INTO admins (username, password, name, email, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
            $result = $stmt->execute([$username, $hashedPassword, $name, $email]);
            
            if ($result) {
                return ['success' => true, 'message' => 'Registrasi berhasil.'];
            } else {
                return ['success' => false, 'message' => 'Gagal mendaftarkan admin.'];
            }
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error database: ' . $e->getMessage()];
        }
    }    public function updateLastLogin($id) {
        $stmt = $this->db->prepare("UPDATE admins SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function getAllAdmins() {
        $stmt = $this->db->prepare("SELECT id, username, name, email, last_login, created_at FROM admins ORDER BY id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateAdmin($id, $data) {
        try {
            // Check if username is changed and already exists
            if (isset($data['username']) && !empty($data['username'])) {
                $existingUser = $this->findByUsername($data['username']);
                if ($existingUser && $existingUser['id'] != $id) {
                    return ['success' => false, 'message' => 'Username sudah digunakan.'];
                }
            }
            
            // Check if email is changed and already exists
            if (isset($data['email']) && !empty($data['email'])) {
                $existingEmail = $this->findByEmail($data['email']);
                if ($existingEmail && $existingEmail['id'] != $id) {
                    return ['success' => false, 'message' => 'Email sudah digunakan.'];
                }
            }
            
            // Build the update query dynamically based on provided data
            $queryParts = [];
            $params = [];
            
            if (isset($data['username']) && !empty($data['username'])) {
                $queryParts[] = "username = ?";
                $params[] = $data['username'];
            }
            
            if (isset($data['name']) && !empty($data['name'])) {
                $queryParts[] = "name = ?";
                $params[] = $data['name'];
            }
            
            if (isset($data['email']) && !empty($data['email'])) {
                $queryParts[] = "email = ?";
                $params[] = $data['email'];
            }
            
            if (isset($data['password']) && !empty($data['password'])) {
                $queryParts[] = "password = ?";
                $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            
            // Add id at the end of parameters
            $params[] = $id;
            
            if (empty($queryParts)) {
                return ['success' => false, 'message' => 'Tidak ada data untuk diperbarui.'];
            }
            
            $query = "UPDATE admins SET " . implode(", ", $queryParts) . " WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute($params);
            
            if ($result) {
                return ['success' => true, 'message' => 'Data admin berhasil diperbarui.'];
            } else {
                return ['success' => false, 'message' => 'Gagal memperbarui data admin.'];
            }
        } catch (PDOException $e) {
            error_log("Admin update error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error database: ' . $e->getMessage()];
        }
    }
    
    public function deleteAdmin($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM admins WHERE id = ?");
            $result = $stmt->execute([$id]);
            
            if ($result) {
                return ['success' => true, 'message' => 'Admin berhasil dihapus.'];
            } else {
                return ['success' => false, 'message' => 'Gagal menghapus admin.'];
            }
        } catch (PDOException $e) {
            error_log("Admin delete error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error database: ' . $e->getMessage()];
        }
    }
    
    public function getAdminById($id) {
        $stmt = $this->db->prepare("SELECT id, username, name, email, last_login, created_at FROM admins WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
