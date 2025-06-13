<?php
require_once BASE_PATH . '/repositories/MenuRepository.php';

class MenuController {
    private $repo;
    private $site;

    public function __construct($site = 'admin') {
        $this->repo = new MenuRepository();
        $this->site = $site; // 'admin' atau 'public'
    }    public function index() {
        $menus = $this->repo->getAll();
        $page = 'menus';
          if ($this->site === 'admin') {
            // Tampilkan halaman admin
            $pageTitle = 'Daftar Menu - Family 88 Catering Admin';
            $contentView = BASE_PATH . '/views/admin/menus/menu_list_content.php';
            include BASE_PATH . '/views/admin/template.php';
        } else {
            // Tampilkan halaman publik
            $pageTitle = 'Menu - Family 88 Catering';
            $contentView = BASE_PATH . '/views/public/menus/menu_list.php';
            include BASE_PATH . '/views/public/template.php';
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];
            $this->repo->create($data);
            header('Location: index.php?page=menus');        } else {
            $page = 'menus';
            $pageTitle = 'Tambah Menu - Family 88 Catering';
            $contentView = 'views/menus/menu_create_content.php';
            include 'views/template_new.php';
        }
    }

    public function delete($id) {
        $this->repo->delete($id);
        header('Location: index.php?page=menus');
    }    public function foods() {
        $menus = $this->repo->getAll();
        
        if ($this->site === 'admin') {
            // Tampilkan halaman admin            $page = 'foods';
            $pageTitle = 'Foods Menu - Family 88 Catering Admin';
            $contentView = BASE_PATH . '/views/admin/menus/menu_list_content.php';
            include BASE_PATH . '/views/admin/template.php';
        } else {
            // Tampilkan halaman publik            $page = 'foods';
            $pageTitle = 'Our Foods - Family 88 Catering';
            $contentView = BASE_PATH . '/views/public/menus/foods.php';
            include BASE_PATH . '/views/public/template.php';
        }
    }
}
