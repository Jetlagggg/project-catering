<div class="card">
    <div class="card-header">
        <h2><?= isset($invoice) ? 'Edit Faktur' : 'Buat Faktur' ?></h2>
        <a href="index.php?page=invoices" class="btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form method="post">
        <div class="form-row">
            <div class="form-group">
                <label for="invoice_number">No. Faktur</label>
                <input type="text" id="invoice_number" name="invoice_number" required 
                       value="<?= isset($invoice) ? htmlspecialchars($invoice['invoice_number']) : 'INV-' . date('Ymd') . '-' . rand(1000, 9999) ?>" 
                       <?= isset($invoice) ? '' : 'readonly' ?>>
            </div>
            
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" id="date" name="date" required 
                       value="<?= isset($invoice) ? $invoice['date'] : date('Y-m-d') ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="client_id">Klien</label>
                <select id="client_id" name="client_id" required>
                    <option value="">-- Pilih Klien --</option>
                    <?php foreach ($clients as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= (isset($invoice) && $invoice['client_id'] == $c['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="amount">Jumlah (Rp)</label>
                <input type="number" id="amount" name="amount" required 
                       value="<?= isset($invoice) ? $invoice['amount'] : '' ?>" 
                       placeholder="Total tagihan">
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="unpaid" <?= (isset($invoice) && $invoice['status'] == 'unpaid') ? 'selected' : '' ?>>Belum Dibayar</option>
                <option value="partial" <?= (isset($invoice) && $invoice['status'] == 'partial') ? 'selected' : '' ?>>Sebagian Dibayar</option>
                <option value="paid" <?= (isset($invoice) && $invoice['status'] == 'paid') ? 'selected' : '' ?>>Lunas</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Catatan tambahan untuk faktur ini"><?= isset($invoice) ? htmlspecialchars($invoice['notes']) : '' ?></textarea>
        </div>

        <button type="submit" class="btn">
            <i class="fas fa-save"></i> <?= isset($invoice) ? 'Update Faktur' : 'Simpan Faktur' ?>
        </button>
    </form>
</div>
