<?php
require_once __DIR__ . '/../config/koneksi.php';

$data = mysqli_query(
    $conn,
    "SELECT * FROM inventaris ORDER BY tgl_update DESC"
);

$queryTotal = mysqli_query(
    $conn,
    "SELECT SUM(stok) AS total FROM inventaris"
);

$totalData = mysqli_fetch_assoc($queryTotal);
$total = $totalData['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Inventaris</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0">

            <?php include __DIR__ . '/layouts/sidebar.php'; ?>

            <main class="col-12 col-md-9 main-content p-4">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4 top-bar">

                    <div>
                        <div class="page-title">Data Inventaris</div>
                        <div class="page-subtitle">Kelola seluruh data barang laboratorium komputer</div>
                    </div>

                    <?php if (isset($_GET['success'])) : ?>
                        <div class="custom-alert success-alert">
                            <div class="d-flex align-items-center gap-3">
                                <div class="alert-left">
                                    <img src="../assets/img/check-circle.png" alt="success">
                                </div>
                                <div class="alert-text">
                                    <?php
                                    if ($_GET['success'] == 1) echo 'Data barang berhasil ditambahkan';
                                    elseif ($_GET['success'] == 2) echo 'Data barang berhasil diupdate';
                                    elseif ($_GET['success'] == 3) echo 'Data barang berhasil dihapus';
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['failed'])) : ?>
                        <div class="custom-alert failed-alert">
                            <div class="d-flex align-items-center gap-3">
                                <div class="alert-left">
                                    <img src="../assets/img/x-circle.png" alt="failed">
                                </div>
                                <div class="alert-text">
                                    <?php
                                    if ($_GET['failed'] == 1) echo 'Data barang gagal ditambahkan';
                                    elseif ($_GET['failed'] == 2) echo 'Data barang gagal diupdate';
                                    elseif ($_GET['failed'] == 3) echo 'Data barang gagal dihapus';
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="d-flex justify-content-between align-items-center gap-3 mb-4 action-bar">

                    <div class="search-box d-flex align-items-center gap-2">
                        <img class="menu-icon" src="../assets/img/search.png" alt="search">
                        <input type="text" id="searchInput" placeholder="Cari nama barang atau kode aset..." autocomplete="off">
                    </div>

                    <a href="form.php" class="btn-add">
                        <img src="../assets/img/plus.png" alt="plus">
                        <span>Tambah Barang</span>
                    </a>

                </div>

                <div class="table-card">
                    <div class="table-responsive">
                        <table class="table align-middle" id="inventarisTable">

                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kode Aset</th>
                                    <th>Kondisi</th>
                                    <th>Stok</th>
                                    <th>Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                                    <tr>

                                        <td class="fw-medium">
                                            <?= htmlspecialchars($row['nama_barang']) ?>
                                        </td>

                                        <td class="text-muted">
                                            <?= htmlspecialchars($row['kode_aset']) ?>
                                        </td>

                                        <td>
                                            <?php if ($row['kondisi'] == 'Baik') : ?>
                                                <span class="badge-status good">Baik</span>
                                            <?php elseif ($row['kondisi'] == 'Rusak') : ?>
                                                <span class="badge-status bad">Rusak</span>
                                            <?php else : ?>
                                                <span class="badge-status repair">Perbaikan</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-muted">
                                            <?= $row['stok'] ?>
                                        </td>

                                        <td class="text-muted">
                                            <?= date('d M Y', strtotime($row['tgl_update'])) ?>
                                        </td>

                                        <td>
                                            <div class="action-wrapper">

                                                <a href="form.php?id=<?= $row['id_barang'] ?>">
                                                    <img src="../assets/img/edit.png" class="action-icon" alt="Edit">
                                                </a>

                                                <a href="../modules/proses_barang.php?hapus=<?= $row['id_barang'] ?>"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <img src="../assets/img/trash.png" class="action-icon" alt="Delete">
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </main>

        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.custom-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            }
        }, 4000);

        document.getElementById('searchInput').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('#inventarisTable tbody tr');

            rows.forEach(row => {
                const nama = row.cells[0].textContent.toLowerCase();
                const kode = row.cells[1].textContent.toLowerCase();
                row.style.display = (nama.includes(keyword) || kode.includes(keyword)) ? '' : 'none';
            });
        });
    </script>

</body>

</html>