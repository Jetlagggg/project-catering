<?php
require_once BASE_PATH . '/repositories/OrderRepository.php';
require_once BASE_PATH . '/repositories/ClientRepository.php';
require_once BASE_PATH . '/repositories/MenuRepository.php';

class OrderController {
    private $repo;
    private $clientRepo;
    private $menuRepo;
    private $site;

    public function __construct($site = 'admin') {
        $this->repo = new OrderRepository();
        $this->clientRepo = new ClientRepository();
        $this->menuRepo = new MenuRepository();
        $this->site = $site; // 'admin' atau 'public'
    }    public function index() {
        $orders = $this->repo->getAll();
        
        // Ensure orders is an array
        if (!is_array($orders)) $orders = [];
        
        $page = 'orders';
        $pageTitle = 'Daftar Pesanan - Family 88 Catering';
        $contentView = 'views/orders/order_list_content.php';
        include 'views/template_new.php';    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'client_id' => $_POST['client_id'],
                'menu_id' => $_POST['menu_id'],
                'quantity' => $_POST['quantity'],
                'order_date' => date('Y-m-d H:i:s'),
                'status' => 'pending'
            ];
            $this->repo->create($data);
            
            // Get the last order with details
            $order = $this->repo->getLastOrderWithDetail(); 
            
            if ($order && !empty($order)) {
                $total = $order['quantity'] * $order['price'];
                $clientPhone = preg_replace('/[^0-9]/', '', $order['phone']);
                $clientPhone = (substr($clientPhone, 0, 1) === '0') ? '62' . substr($clientPhone, 1) : $clientPhone;

                $message = "Halo {$order['client_name']},\nPesanan Anda:\nMenu: {$order['menu_name']}\nJumlah: {$order['quantity']}\nTotal: Rp " . number_format($total, 0, ',', '.') . "\nTerima kasih telah memesan catering kami!";
                $waLink = "https://wa.me/{$clientPhone}?text=" . urlencode($message);

                // Redirect ke WhatsApp
                header("Location: $waLink");
                exit;
            }
            
            header('Location: index.php?page=orders');
            exit;
        } else {
            $clients = $this->clientRepo->getAll();
            $menus = $this->menuRepo->getAll();
            
            // Ensure arrays are properly initialized
            if (!is_array($clients)) $clients = [];
            if (!is_array($menus)) $menus = [];
            
            $page = 'orders';
            $pageTitle = 'Tambah Pesanan - Family 88 Catering';
            $contentView = 'views/orders/order_create_content.php';
            include 'views/template_new.php';
        }
    }

    public function delete($id) {
        $this->repo->delete($id);
        header('Location: index.php?page=orders');
    }

    public function history() {
        // In a real application, we would filter by customer ID
        $orders = $this->repo->getAll();
        include 'views/orders/history.php';
    }
// Methods for public website
    
    public function publicIndex() {
        if ($this->site !== 'public') {
            header('Location: /TubesYos/admin/?page=orders');
            exit;
        }
        
        // Show order form for public site
        $page = 'order';
        $pageTitle = 'Place Your Order - Family 88 Catering';
        $contentView = BASE_PATH . '/views/public/orders/order_form.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
    
    public function addItem($id = null) {
        if ($this->site !== 'public' || $id === null) {
            header('Location: /TubesYos/public/?page=menu');
            exit;
        }
        
        // Get menu item
        $menu = $this->menuRepo->getById($id);
        if (!$menu) {
            header('Location: /TubesYos/public/?page=menu');
            exit;
        }
        
        // Add to cart
        $found = false;
        
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            unset($item); // Unset reference
        }
        
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $id,
                'name' => $menu['name'],
                'price' => $menu['price'],
                'quantity' => 1
            ];
        }
        
        // Redirect back to menu or to cart
        header('Location: /TubesYos/public/?page=order');
        exit;
    }
    
    public function updateItem($id = null) {
        if ($this->site !== 'public' || $id === null || !isset($_GET['qty'])) {
            header('Location: /TubesYos/public/?page=order');
            exit;
        }
        
        $qty = intval($_GET['qty']);
        
        // Update cart item quantity
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => &$item) {
                if ($item['id'] == $id) {
                    if ($qty > 0) {
                        $item['quantity'] = $qty;
                    } else {
                        // Remove if quantity is 0
                        unset($_SESSION['cart'][$key]);
                    }
                    break;
                }
            }
            unset($item); // Unset reference
            
            // Reindex array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        
        // Redirect to cart
        header('Location: /TubesYos/public/?page=order');
        exit;
    }
    
    public function removeItem($id = null) {
        if ($this->site !== 'public' || $id === null) {
            header('Location: /TubesYos/public/?page=order');
            exit;
        }
        
        // Remove item from cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            
            // Reindex array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        
        // Redirect to cart
        header('Location: /TubesYos/public/?page=order');
        exit;
    }
    
    public function placeOrder() {
        if ($this->site !== 'public' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /TubesYos/public/?page=order');
            exit;
        }
        
        // Check if cart is empty
        if (empty($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            header('Location: /TubesYos/public/?page=menu');
            exit;
        }
        
        // In a real application, you would:
        // 1. Create a client record
        // 2. Create an order record
        // 3. Create order items for each cart item
        // 4. Send confirmation email
        // 5. Clear the cart
        
        // For now, just simulate the process
        $_SESSION['order_success'] = true;
        $_SESSION['cart'] = []; // Clear cart
        
        // Redirect to success page
        header('Location: /TubesYos/public/?page=order&action=success');
        exit;
    }
    
    public function success() {
        if ($this->site !== 'public') {
            header('Location: /TubesYos/public/');
            exit;
        }
        
        // Check if there's a success flag
        if (!isset($_SESSION['order_success']) || $_SESSION['order_success'] !== true) {
            header('Location: /TubesYos/public/?page=menu');
            exit;
        }
        
        // Clear success flag
        unset($_SESSION['order_success']);
        
        // Display success page
        $page = 'order';
        $pageTitle = 'Order Confirmed - Family 88 Catering';
        $contentView = BASE_PATH . '/views/public/orders/order_success.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
}
