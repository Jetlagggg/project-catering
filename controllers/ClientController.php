<?php
require_once __DIR__ . '/../repositories/ClientRepository.php';

class ClientController {
    private $repo;

    public function __construct() {
        $this->repo = new ClientRepository();
    }public function index() {
        $clients = $this->repo->getAll();
        $page = 'clients';
        $pageTitle = 'Daftar Klien - Foody Catering';
        $contentView = 'views/clients/client_list_content.php';
        include 'views/template_new.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone']
            ];
            $this->repo->create($data);
            header('Location: index.php?page=clients');
        } else {            $page = 'clients';
            $pageTitle = 'Tambah Klien - Foody Catering';
            $contentView = 'views/clients/client_create_content.php';
            include 'views/template_new.php';
        }
    }

    public function delete($id) {
        $this->repo->delete($id);
        header('Location: index.php?page=clients');
    }
}
