<?php
$currentPage = basename($_SERVER['PHP_SELF']);

// Halaman-halaman form inventaris (semua menu akan di-disable dan non-aktif)
$formInventoryPages = ['tambah_barang.php', 'edit_barang.php', 'form_barang.php'];
$isFormPage = in_array($currentPage, $formInventoryPages);
?>

<link rel="stylesheet" href="../assets/css/styles.css">
<script src="assets/js/script.js"></script>
<script src="assets/js/dashboard-chart.php"></script>
<aside class="col-12 col-md-3 sidebar p-3 p-md-4">

    <!-- BRAND -->
    <div class="d-flex align-items-center gap-3 mb-4 mb-md-5 brand">
        <img src="../assets/img/logo-sm.png" alt="logo" width="52" height="52">
        <div>
            <div class="brand-title">SKANIDALAB</div>
            <div class="brand-subtitle">SMK Negeri 2 Magelang</div>
        </div>
    </div>

    <!-- MENU -->
    <nav class="d-flex flex-row flex-md-column gap-2 overflow-auto">

        <!-- DASHBOARD -->
        <?php if ($isFormPage): ?>
            <a href="javascript:void(0);" class="menu-item disabled" onclick="return false;">
        <?php else: ?>
            <a href="dashboard.php" class="menu-item <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
        <?php endif; ?>
            <img class="menu-icon"
                src="../assets/img/<?= (!$isFormPage && $currentPage == 'dashboard.php') ? 'dashboard.png' : 'dashboard-inactive.png' ?>"
                alt="dashboard">
            <span>Dashboard</span>
        </a>

        <!-- INVENTARIS -->
        <?php if ($isFormPage): ?>
            <a href="javascript:void(0);" class="menu-item disabled" onclick="return false;">
        <?php else: ?>
            <a href="inventaris.php" class="menu-item <?= $currentPage == 'inventaris.php' ? 'active' : '' ?>">
        <?php endif; ?>
            <img class="menu-icon"
                src="../assets/img/<?= (!$isFormPage && $currentPage == 'inventaris.php') ? 'tabel-active.png' : 'tabel-inactive.png' ?>"
                alt="inventaris">
            <span>Inventaris</span>
        </a>

        <!-- LOGOUT -->
        <a href="../modules/logout.php" class="menu-item logout-item">
            <img class="menu-icon" src="../assets/img/logout.png" alt="logout">
            <span>Logout</span>
        </a>

    </nav>

</aside>

