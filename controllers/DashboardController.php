<?php
require_once BASE_PATH . '/repositories/ClientRepository.php';
require_once BASE_PATH . '/repositories/InvoiceRepository.php';
require_once BASE_PATH . '/repositories/OrderRepository.php';
require_once BASE_PATH . '/repositories/MenuRepository.php';

class DashboardController {
    private $clientRepo;
    private $invoiceRepo;
    private $orderRepo;
    private $menuRepo;
    
    public function __construct() {
        $this->clientRepo = new ClientRepository();
        $this->invoiceRepo = new InvoiceRepository();
        $this->orderRepo = new OrderRepository();
        $this->menuRepo = new MenuRepository();
    }
      public function index() {
        // Cek apakah kita menggunakan rute lama atau baru
        if (defined('BASE_PATH')) {
            // Untuk rute baru (dipisah public/admin)
            $page = 'dashboard';
            $pageTitle = 'Dashboard - Family 88 Admin Panel';
            
            // Statistik untuk dashboard
            $totalClients = count($this->clientRepo->getAll());
            $totalInvoices = count($this->invoiceRepo->getAll());
            $unpaidInvoices = count($this->invoiceRepo->getByStatus('unpaid'));
            $totalOrders = $this->orderRepo->countAll();
            $totalMenus = count($this->menuRepo->getAll());
            
            // Load recent data
            $recentOrders = $this->orderRepo->getRecent(5);
            $popularMenus = $this->menuRepo->getAll(); // Sementara gunakan getAll()
            
            // Siapkan data untuk dashboard
            $stats = [
                'totalOrders' => $totalOrders,
                'totalMenus' => $totalMenus,
                'totalClients' => $totalClients,
                'totalInvoices' => $totalInvoices,
                'unpaidInvoices' => $unpaidInvoices,
                'recentOrders' => $recentOrders,
                'popularMenus' => $popularMenus
            ];
              $contentView = BASE_PATH . '/views/admin/dashboard/dashboard.php';
            include BASE_PATH . '/views/admin/template.php';
        } else {
            // Untuk rute lama (sebelum dipisah)
            $totalClients = count($this->clientRepo->getAll());            $totalInvoices = count($this->invoiceRepo->getAll());
            $unpaidInvoices = count($this->invoiceRepo->getByStatus('unpaid'));
            
            // Load popular menus from database for dashboard
            $popularMenus = $this->menuRepo->getPopular(4); // Get 4 popular menu items
            
            include __DIR__ . '/../views/dashboard/index.php';
        }
    }
}
