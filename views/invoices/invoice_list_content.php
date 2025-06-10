<div class="card">
    <div class="card-header">
        <h2>Daftar Faktur</h2>
        <a href="index.php?page=invoices&action=create" class="btn">
            <i class="fas fa-plus"></i> Buat Faktur
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Faktur</th>
                <th>Klien</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $i): ?>
                <tr>
                    <td><?= htmlspecialchars($i['invoice_number']) ?></td>
                    <td><?= htmlspecialchars($i['client_name']) ?></td>
                    <td><?= date('d M Y', strtotime($i['date'])) ?></td>
                    <td>Rp <?= number_format($i['amount'], 2, ',', '.') ?></td>
                    <td>
                        <?php if ($i['status'] === 'paid'): ?>
                            <span class="badge badge-success">Lunas</span>
                        <?php elseif ($i['status'] === 'partial'): ?>
                            <span class="badge badge-pending">Sebagian</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Belum Bayar</span>
                        <?php endif; ?>
                    </td>
                    <td class="action-col">
                        <a href="index.php?page=invoices&action=view&id=<?= $i['id'] ?>" class="btn-icon btn-warning">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="index.php?page=invoices&action=edit&id=<?= $i['id'] ?>" class="btn-icon">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?page=invoices&action=delete&id=<?= $i['id'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus faktur ini?')" 
                           class="btn-icon btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (empty($invoices)): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data faktur</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .badge-success {
        background-color: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
        border: 1px solid rgba(46, 204, 113, 0.3);
    }
    
    .badge-danger {
        background-color: rgba(231, 76, 60, 0.2);
        color: #e74c3c;
        border: 1px solid rgba(231, 76, 60, 0.3);
    }
    
    .badge-pending {
        background-color: rgba(241, 196, 15, 0.2);
        color: #f1c40f;
        border: 1px solid rgba(241, 196, 15, 0.3);
    }
</style>
