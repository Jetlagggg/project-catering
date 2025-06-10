<?php
require_once __DIR__ . '/../repositories/InvoiceRepository.php';

class InvoiceController {
    private $repo;

    public function __construct() {
        $this->repo = new InvoiceRepository();
    }public function index() {
        $invoices = $this->repo->getAll();
        $page = 'invoices';
        $pageTitle = 'Daftar Faktur - Foody Catering';
        $contentView = 'views/invoices/invoice_list_content.php';
        include 'views/template_new.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repo->create($_POST);
            header("Location: index.php?page=invoices");
        } else {            $page = 'invoices';
            $pageTitle = 'Buat Faktur - Foody Catering';
            $contentView = 'views/invoices/invoice_form_content.php';
            include 'views/template_new.php';
        }
    }    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repo->update($id, $_POST);
            header("Location: index.php?page=invoices");
        } else {            $invoice = $this->repo->findById($id);
            $page = 'invoices';
            $pageTitle = 'Edit Faktur - Foody Catering';
            $contentView = 'views/invoices/invoice_form_content.php';
            include 'views/template_new.php';
        }
    }

    public function delete($id) {
        $this->repo->delete($id);
        header("Location: index.php?page=invoices");
    
        if (empty($_POST['client_id']) || empty($_POST['amount'])) {
    $_SESSION['error'] = "Semua field wajib diisi!";
    header("Location: index.php?page=invoices&action=create");
    exit;
}

    }
}
