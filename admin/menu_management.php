<?php
// menu_management.php - Halaman untuk mengelola menu

// Aktifkan tampilan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set base path
define('BASE_PATH', dirname(__DIR__));

// Autentikasi
require_once 'auth.php';

// Load repository
require_once BASE_PATH . '/repositories/MenuRepository.php';
$menuRepo = new MenuRepository();

// Default message
$message = '';
$messageType = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // Add new menu item
    if (isset($_POST['action']) && $_POST['action'] === 'add') {$menuData = [            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'category' => $_POST['category'] ?? 'main'
        ];
        
        // Handle image upload
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/menu/';
            
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . $fileName;
            
            // Upload the file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $imagePath = 'uploads/menu/' . $fileName; // Store relative path
            } else {
                $message = 'Gagal mengupload gambar';
                $messageType = 'danger';
            }
        }
        
        $menuData['image'] = $imagePath;
        
        if ($menuRepo->create($menuData)) {
            $message = 'Menu berhasil ditambahkan';
            $messageType = 'success';
        } else {
            $message = 'Gagal menambahkan menu';
            $messageType = 'danger';
        }
    }
    
    // Update existing menu item
    else if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = $_POST['id'] ?? 0;
        $menuItem = $menuRepo->getById($id);
        
        if (!$menuItem) {
            $message = 'Menu tidak ditemukan';
            $messageType = 'danger';
        } else {            $menuData = [
                'name' => $_POST['name'] ?? $menuItem['name'],
                'description' => $_POST['description'] ?? $menuItem['description'],
                'price' => $_POST['price'] ?? $menuItem['price'],
                'category' => $_POST['category'] ?? $menuItem['category'],
                'image' => $menuItem['image_url'] // Default to existing image
            ];
            
            // Handle image upload for update
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/menu/';
                
                // Create directory if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetFilePath = $uploadDir . $fileName;
                
                // Upload the file
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {                    // Delete old image if exists
                    if ($menuItem['image_url'] && file_exists('../' . $menuItem['image_url'])) {
                        unlink('../' . $menuItem['image_url']);
                    }
                    
                    $menuData['image'] = 'uploads/menu/' . $fileName; // Store relative path
                } else {
                    $message = 'Gagal mengupload gambar baru';
                    $messageType = 'danger';
                }
            }
            
            if ($menuRepo->update($id, $menuData)) {
                $message = 'Menu berhasil diperbarui';
                $messageType = 'success';
            } else {
                $message = 'Gagal memperbarui menu';
                $messageType = 'danger';
            }
        }
    }
    
    // Delete menu item
    else if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = $_POST['id'] ?? 0;
        $menuItem = $menuRepo->getById($id);
        
        if (!$menuItem) {
            $message = 'Menu tidak ditemukan';
            $messageType = 'danger';
        } else {            // Delete the image file if exists
            if ($menuItem['image_url'] && file_exists('../' . $menuItem['image_url'])) {
                unlink('../' . $menuItem['image_url']);
            }
            
            if ($menuRepo->delete($id)) {
                $message = 'Menu berhasil dihapus';
                $messageType = 'success';
            } else {
                $message = 'Gagal menghapus menu';
                $messageType = 'danger';
            }
        }    }
}

// Get all menu items for display
$menuItems = $menuRepo->getAll();

// Count total menu items
$totalMenuItems = $menuRepo->countAll();

// Include header
$pageTitle = 'Manajemen Menu';
include_once 'views/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Menu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Menu (<?= $totalMenuItems ?>)</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">
                            <i class="fas fa-plus"></i> Tambah Menu Baru
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">Gambar</th>
                                    <th width="20%">Nama</th>
                                    <th width="25%">Deskripsi</th>
                                    <th width="10%">Harga</th>
                                    <th width="10%">Kategori</th>
                                    <th width="5%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($menuItems)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada menu</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($menuItems as $item): ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>                                            <td>
                                                <?php if (!empty($item['image_url'])): ?>
                                                    <img src="../<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" class="img-thumbnail" style="max-height: 80px;">
                                                <?php else: ?>
                                                    <div class="img-thumbnail d-flex align-items-center justify-content-center" style="max-height: 80px; width: 80px; background-color: #f8f9fa;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($item['name']) ?></td>
                                            <td><?= htmlspecialchars($item['description']) ?></td>
                                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                            <td><?= htmlspecialchars($item['category'] ?? 'main') ?></td>                                            <td>
                                                <span class="badge badge-success">
                                                    Tersedia
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">                                                    <button type="button" class="btn btn-sm btn-info btn-edit" 
                                                        data-toggle="modal" 
                                                        data-target="#editMenuModal"
                                                        data-id="<?= $item['id'] ?>"
                                                        data-name="<?= htmlspecialchars($item['name']) ?>"
                                                        data-description="<?= htmlspecialchars($item['description']) ?>"
                                                        data-price="<?= $item['price'] ?>"
                                                        data-category="<?= htmlspecialchars($item['category'] ?? 'main') ?>"
                                                        data-image="<?= $item['image_url'] ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete" 
                                                        data-toggle="modal" 
                                                        data-target="#deleteMenuModal"
                                                        data-id="<?= $item['id'] ?>"
                                                        data-name="<?= htmlspecialchars($item['name']) ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Menu Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuModalLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="form-group">
                        <label for="name">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select class="form-control" id="category" name="category">
                            <option value="main">Menu Utama</option>
                            <option value="side">Menu Sampingan</option>
                            <option value="dessert">Dessert</option>
                            <option value="drink">Minuman</option>
                        </select>
                    </div>
                      <div class="form-group">
                        <label for="image">Gambar Menu</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format yang diizinkan: JPG, JPEG, PNG. Maks 2MB.</small>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Menu Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="form-group">
                        <label for="edit_name">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_description">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_price">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_price" name="price" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_category">Kategori</label>
                        <select class="form-control" id="edit_category" name="category">
                            <option value="main">Menu Utama</option>
                            <option value="side">Menu Sampingan</option>
                            <option value="dessert">Dessert</option>
                            <option value="drink">Minuman</option>
                        </select>
                    </div>
                      <div class="form-group">
                        <label for="edit_image">Gambar Menu</label>
                        <div id="current_image_container" class="mb-2"></div>
                        <input type="file" class="form-control-file" id="edit_image" name="image" accept="image/*">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Menu Modal -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus menu <strong id="delete_menu_name"></strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                
                <form method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="delete_id">
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {        // Setup for edit modal
        $('.btn-edit').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const description = $(this).data('description');
            const price = $(this).data('price');
            const category = $(this).data('category');
            const image = $(this).data('image');
            
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_description').val(description);
            $('#edit_price').val(price);
            $('#edit_category').val(category);
            
            // Show current image if exists
            const imageContainer = $('#current_image_container');
            imageContainer.empty();
            
            if (image) {
                const img = $('<img>')
                    .attr('src', '../' + image)
                    .attr('alt', 'Current Image')
                    .addClass('img-thumbnail')
                    .css('max-height', '100px');
                imageContainer.append(img);
            } else {
                imageContainer.append('<p>Tidak ada gambar</p>');
            }
        });
        
        // Setup for delete modal
        $('.btn-delete').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            
            $('#delete_id').val(id);
            $('#delete_menu_name').text(name);
        });
    });
</script>

<?php
// Include footer
include_once 'views/footer.php';
?>
