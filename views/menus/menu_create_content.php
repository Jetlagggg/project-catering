<div class="card">
    <div class="card-header">
        <h2>Tambah Menu Baru</h2>
        <a href="index.php?page=menus" class="btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form method="post">
        <div class="form-group">
            <label for="name">Nama Menu</label>
            <input type="text" id="name" name="name" required placeholder="Masukkan nama menu">
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="3" placeholder="Deskripsi menu"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Harga (Rp)</label>
            <input type="number" id="price" name="price" required placeholder="Harga menu">
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-save"></i> Simpan Menu
        </button>
    </form>
</div>
