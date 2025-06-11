<div class="card">
    <div class="card-header">
        <h2>Daftar Klien</h2>
        <a href="index.php?page=clients&action=create" class="btn">
            <i class="fas fa-plus"></i> Tambah Klien
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                    <td class="action-col">
                        <a href="index.php?page=clients&action=edit&id=<?= $c['id'] ?>" class="btn-icon">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?page=clients&action=delete&id=<?= $c['id'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus klien ini?')" 
                           class="btn-icon btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (empty($clients)): ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data klien</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    .text-center {
        text-align: center;
    }
</style>
