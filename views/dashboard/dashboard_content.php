<div class="dashboard-stats">
    <div class="stat-box stat-teal">
        <div class="stat-content">
            <h2><?= $totalClients ?></h2>
            <p>New Orders</p>
        </div>
        <div class="stat-more">
            <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="stat-box stat-green">
        <div class="stat-content">
            <h2>53<sup>%</sup></h2>
            <p>Bounce Rate</p>
        </div>
        <div class="stat-more">
            <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="stat-box stat-yellow">
        <div class="stat-content">
            <h2><?= $totalInvoices ?></h2>
            <p>User Registrations</p>
        </div>
        <div class="stat-more">
            <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="stat-box stat-red">
        <div class="stat-content">
            <h2><?= $unpaidInvoices ?></h2>
            <p>Unique Visitors</p>
        </div>
        <div class="stat-more">
            <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Tindakan Cepat</h2>
    </div>
    <div class="dashboard-actions">
        <a href="index.php?page=clients&action=create" class="btn">
            <i class="fas fa-user-plus"></i> Tambah Klien Baru
        </a>
        <a href="index.php?page=orders&action=create" class="btn">
            <i class="fas fa-plus-circle"></i> Buat Pesanan Baru
        </a>
        <a href="index.php?page=menus&action=create" class="btn">
            <i class="fas fa-utensils"></i> Tambah Menu Baru
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Pesanan Terbaru</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Klien</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dummy data for demo purposes -->
            <tr>
                <td>1</td>
                <td>PT Maju Jaya</td>
                <td>05 Jun 2025</td>
                <td><span class="badge badge-success">Selesai</span></td>
                <td>Rp 2,500,000</td>
                <td class="action-col">
                    <a href="#" class="btn-icon btn-warning"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn-icon"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>CV Berkah Abadi</td>
                <td>06 Jun 2025</td>
                <td><span class="badge badge-pending">Proses</span></td>
                <td>Rp 1,750,000</td>
                <td class="action-col">
                    <a href="#" class="btn-icon btn-warning"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn-icon"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>PT Sukses Mandiri</td>
                <td>07 Jun 2025</td>
                <td><span class="badge badge-danger">Belum Bayar</span></td>
                <td>Rp 3,200,000</td>
                <td class="action-col">
                    <a href="#" class="btn-icon btn-warning"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn-icon"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
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
