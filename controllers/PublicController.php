<?php
// Controller khusus untuk website promosi

class PublicController {
    public function __construct() {
        // Constructor
        // Inisialisasi cart jika belum ada
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }
    
    public function index() {
        // Tampilkan halaman beranda website promosi
        $page = 'home';
        $pageTitle = 'Foody - Premium Catering Service';
        $contentView = BASE_PATH . '/views/public/home.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
    
    public function about() {
        // Tampilkan halaman tentang kami
        $page = 'about';
        $pageTitle = 'About Us - Foody Catering';
        $contentView = BASE_PATH . '/views/public/about.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
    
    public function contact() {
        // Tampilkan halaman kontak
        $page = 'contact';
        $pageTitle = 'Contact Us - Foody Catering';
        $contentView = BASE_PATH . '/views/public/contact.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
    
    public function contactSubmit() {
        // Process contact form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // In a real application, you would save this to a database
            // and perhaps send an email notification
            
            // For now, just redirect with a success message
            $_SESSION['contact_success'] = true;
            header('Location: /TubesYos/public/?page=home&action=contactSuccess');
            exit;
        }
        
        // If not POST, redirect to contact page
        header('Location: /TubesYos/public/?page=home&action=contact');
        exit;
    }
    
    public function contactSuccess() {
        // Tampilkan halaman sukses setelah submit form kontak
        $page = 'contact';
        $pageTitle = 'Message Sent - Foody Catering';
        $contentView = BASE_PATH . '/views/public/contact_success.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
    
    public function orderProcess() {
        // Tampilkan halaman form order
        $page = 'order';
        $pageTitle = 'Place Your Order - Foody Catering';
        $contentView = BASE_PATH . '/views/public/orders/order_form.php';
        
        include BASE_PATH . '/views/public/template.php';
    }
}
