<div class="card">
    <div class="card-header">
        <h2>Tambah Klien Baru</h2>
        <a href="index.php?page=clients" class="btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form method="post">
        <div class="form-group">
            <label for="name">Nama Klien</label>
            <input type="text" id="name" name="name" required placeholder="Masukkan nama klien">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="contoh@email.com">
            </div>
            
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" placeholder="Nomor telepon">
            </div>
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-save"></i> Simpan Klien
        </button>
    </form>
</div>
