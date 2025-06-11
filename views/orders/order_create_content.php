<div class="card">
    <div class="card-header">
        <h2>Tambah Pesanan Baru</h2>
        <a href="index.php?page=orders" class="btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form method="post">
        <div class="form-group">
            <label for="client_id">Klien</label>
            <select id="client_id" name="client_id" required>
                <option value="">-- Pilih Klien --</option>
                <?php foreach ($clients as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="menu_id">Menu</label>
            <select id="menu_id" name="menu_id" required>
                <option value="">-- Pilih Menu --</option>
                <?php foreach ($menus as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?> - Rp <?= number_format($m['price'], 2, ',', '.') ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Jumlah</label>
            <input type="number" id="quantity" name="quantity" required min="1" placeholder="Jumlah pesanan">
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-save"></i> Simpan Pesanan
        </button>
    </form>
</div>
