<?php
require_once __DIR__ . '/../config/koneksi.php';

// Ambil total stok
$totalQuery = mysqli_query($conn, "SELECT SUM(stok) AS total FROM inventaris");
$total = mysqli_fetch_assoc($totalQuery)['total'] ?? 0;

// Jumlah barang dengan kondisi Baik
$baik = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(stok) AS jml FROM inventaris WHERE kondisi='Baik'"))['jml'] ?? 0;

// Jumlah barang dengan kondisi Rusak
$rusak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(stok) AS jml FROM inventaris WHERE kondisi='Rusak'"))['jml'] ?? 0;

// Jumlah barang dengan kondisi Perbaikan
$perbaikan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(stok) AS jml FROM inventaris WHERE kondisi='Perbaikan'"))['jml'] ?? 0;

// Data untuk tabel (5 data terbaru)
$data = mysqli_query($conn, "SELECT * FROM inventaris ORDER BY tgl_update DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SKANIDALAB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR (dipanggil dari file terpisah) -->
        <?php include __DIR__ . '/layouts/sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-md-9 main-content p-4">

            <h4 class="fw-semibold mb-1">Dashboard</h4>
            <p class="text-muted mb-4">Selamat datang di SKANIDALAB</p>

            <!-- STAT CARDS -->
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="stat-card">
                        <img src="../assets/img/shield-check.png" alt="Baik" width="40">
                        <div class="stat-title">Barang Baik</div>
                        <div class="stat-value"><?= $baik ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="stat-card">
                        <img src="../assets/img/wrench.png" alt="Perbaikan" width="40">
                        <div class="stat-title">Perbaikan</div>
                        <div class="stat-value"><?= $perbaikan ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="stat-card">
                        <img src="../assets/img/triangular-alert.png" alt="Rusak" width="40">
                        <div class="stat-title">Barang Rusak</div>
                        <div class="stat-value"><?= $rusak ?></div>
                    </div>
                </div>
            </div>

            <!-- TOTAL + DONUT CHART -->
            <div class="row g-3 mt-2">
                <div class="col-12 col-lg-8">
                    <div class="total-card">
                        <img src="../assets/img/package.png" alt="Total" class="mb-3" width="84" height="84">
                        <div class="total-title">Total Barang Inventaris</div>
                        <div class="total-value"><?= $total ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="donut-card">
                        <div class="donut-wrapper">
                            <canvas id="inventoryDonut"></canvas>
                        </div>
                        <div class="donut-center"><?= $total ?></div>
                    </div>
                </div>
            </div>

            <!-- TABLE RINGKASAN -->
            <div class="row g-3 mt-3">
                <div class="col-12">
                    <div class="table-card">
                        <div class="mb-3">
                            <h4 class="fw-semibold mb-1">Ringkasan Inventaris</h4>
                            <p class="text-muted mb-0">Barang terbaru dan barang yang memerlukan perhatian</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle custom-table">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Kode Aset</th>
                                        <th>Kondisi</th>
                                        <th>Stok</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($data) > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($data)): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                                <td><?= htmlspecialchars($row['kode_aset']) ?></td>
                                                <td>
                                                    <?php if ($row['kondisi'] == 'Baik'): ?>
                                                        <span class="badge-status good">Baik</span>
                                                    <?php elseif ($row['kondisi'] == 'Rusak'): ?>
                                                        <span class="badge-status bad">Rusak</span>
                                                    <?php else: ?>
                                                        <span class="badge-status repair">Perbaikan</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $row['stok'] ?></td>
                                                <td><?= date('d M Y', strtotime($row['tgl_update'])) ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data inventaris.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    new Chart(document.getElementById('inventoryDonut'), {
        type: 'doughnut',
        data: {
            labels: ['Baik', 'Perbaikan', 'Rusak'],
            datasets: [{
                data: [<?= $baik ?>, <?= $perbaikan ?>, <?= $rusak ?>],
                backgroundColor: ['#A3B087', '#D4A017', '#C96868'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
</script>

</body>
</html>