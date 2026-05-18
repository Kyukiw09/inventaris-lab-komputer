<?php
require_once __DIR__ . '/../config/koneksi.php';

$edit = false;
$dataEdit = null;

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $queryEdit = mysqli_query(
        $conn,
        "SELECT * FROM inventaris WHERE id_barang = '$id'"
    );

    $dataEdit = mysqli_fetch_assoc($queryEdit);

    if ($dataEdit) {
        $edit = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $edit ? 'Edit Barang' : 'Tambah Barang' ?> - SKANIDALAB
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    

</head>

<body>

    <div class="container-fluid">
        <div class="row g-0">

            <?php include __DIR__ . '/layouts/sidebar.php'; ?>

            <main class="col-md-9 main-content">

                <div>
                    <div class="page-title">
                        <?= $edit ? 'Edit Barang' : 'Form Barang' ?>
                    </div>
                    <div class="page-subtitle">
                        Tambah dan edit data inventaris laboratorium
                    </div>
                </div>

                <div class="form-card">

                    <form action="../modules/proses_barang.php" method="POST" autocomplete="off">

                        <?php if ($edit) : ?>
                            <input type="hidden" name="id" value="<?= $dataEdit['id_barang'] ?>">
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="form-label">Nama Barang</label>
                            <input
                                type="text"
                                name="nama_barang"
                                class="form-control-custom"
                                placeholder="Masukkan nama barang"
                                autocomplete="off"
                                required
                                value="<?= $edit ? htmlspecialchars($dataEdit['nama_barang']) : '' ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kode Aset</label>
                            <input
                                type="text"
                                name="kode_aset"
                                class="form-control-custom"
                                placeholder="Masukkan kode aset"
                                autocomplete="off"
                                required
                                value="<?= $edit ? htmlspecialchars($dataEdit['kode_aset']) : '' ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kondisi</label>
                            <div class="custom-select-wrapper">

                                <input
                                    type="hidden"
                                    name="kondisi"
                                    id="kondisiInput"
                                    required
                                    value="<?= $edit ? htmlspecialchars($dataEdit['kondisi']) : '' ?>">

                                <button
                                    class="custom-select-btn dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown">
                                    <span id="selectedText">
                                        <?= $edit ? htmlspecialchars($dataEdit['kondisi']) : 'Pilih kondisi barang' ?>
                                    </span>
                                </button>

                                <ul class="dropdown-menu custom-dropdown">
                                    <li>
                                        <button type="button" class="dropdown-item" onclick="setKondisi('Baik')">Baik</button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item" onclick="setKondisi('Rusak')">Rusak</button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item" onclick="setKondisi('Perbaikan')">Perbaikan</button>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Stok</label>
                            <input
                                type="number"
                                name="stok"
                                class="form-control-custom"
                                placeholder="Masukkan stok"
                                autocomplete="off"
                                required
                                value="<?= $edit ? $dataEdit['stok'] : '' ?>">
                        </div>

                        <div class="d-flex gap-3 justify-content-end flex-column flex-md-row button-group">

                            <a href="inventaris.php" class="btn btn-custom btn-cancel">Batal</a>

                            <button
                                type="submit"
                                name="<?= $edit ? 'edit' : 'tambah' ?>"
                                class="btn btn-custom btn-save">
                                <?= $edit ? 'Update' : 'Simpan' ?>
                            </button>

                        </div>

                    </form>

                </div>

            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function setKondisi(value) {
            document.getElementById('kondisiInput').value = value;
            document.getElementById('selectedText').innerText = value;
        }
    </script>

</body>

</html>