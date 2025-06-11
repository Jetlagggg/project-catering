<div class="card">
    <div class="card-header">
        <h2>Daftar Pesanan</h2>
        <a href="index.php?page=orders&action=create" class="btn">
            <i class="fas fa-plus"></i> Tambah Pesanan
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Klien</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
                <tr>
                    <td><?= htmlspecialchars($o['client_name']) ?></td>
                    <td><?= htmlspecialchars($o['menu_name']) ?></td>
                    <td><?= $o['quantity'] ?></td>
                    <td>Rp <?= number_format($o['quantity'] * $o['price'], 2, ',', '.') ?></td>
                    <td class="action-col">
                        <a href="index.php?page=invoices&action=create&order_id=<?= $o['id'] ?>" class="btn-icon btn-warning">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </a>
                        <a href="index.php?page=orders&action=edit&id=<?= $o['id'] ?>" class="btn-icon">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?page=orders&action=delete&id=<?= $o['id'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus pesanan ini?')" 
                           class="btn-icon btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pesanan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
