<?php

require_once __DIR__ . '/../config/koneksi.php';

if (isset($_POST['tambah'])) {

    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $kode_aset   = htmlspecialchars($_POST['kode_aset']);
    $kondisi     = htmlspecialchars($_POST['kondisi']);
    $stok        = (int) $_POST['stok'];

    $query = mysqli_query($conn, "
        INSERT INTO inventaris (
            nama_barang,
            kode_aset,
            kondisi,
            stok,
            tgl_update
        ) VALUES (
            '$nama_barang',
            '$kode_aset',
            '$kondisi',
            '$stok',
            NOW()
        )
    ");

    if ($query) {
        header("Location: ../views/inventaris.php?success=1");
        exit;
    } else {
        header("Location: ../views/inventaris.php?failed=1");
        exit;
    }
}

if (isset($_POST['edit'])) {

    $id          = (int) $_POST['id'];
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $kode_aset   = htmlspecialchars($_POST['kode_aset']);
    $kondisi     = htmlspecialchars($_POST['kondisi']);
    $stok        = (int) $_POST['stok'];

    $query = mysqli_query($conn, "
        UPDATE inventaris SET
            nama_barang = '$nama_barang',
            kode_aset   = '$kode_aset',
            kondisi     = '$kondisi',
            stok        = '$stok',
            tgl_update  = NOW()
        WHERE id_barang = '$id'
    ");

    if ($query) {
        header("Location: ../views/inventaris.php?success=2");
        exit;
    } else {
        header("Location: ../views/inventaris.php?failed=2");
        exit;
    }
}

if (isset($_GET['hapus'])) {

    $id = (int) $_GET['hapus'];

    $query = mysqli_query($conn, "
        DELETE FROM inventaris
        WHERE id_barang = '$id'
    ");

    if ($query) {
        header("Location: ../views/inventaris.php?success=3");
        exit;
    } else {
        header("Location: ../views/inventaris.php?failed=3");
        exit;
    }
}

header("Location: ../views/inventaris.php");
exit;