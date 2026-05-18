<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SKANIDALAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="register-wrapper">
    <div class="main-frame container-fluid p-0">
        <div class="row g-0 h-100">
            <div class="col-md-6 d-flex">
                <div class="left-side w-100">
                    <div class="overlay"></div>
                    <div class="left-content">
                        <div class="title-wrapper">
                            <h1 class="title-main">SISTEM MANAJEMEN</h1>
                            <h1 class="title-sub">INVENTARIS <span>LAB KOMPUTER</span></h1>
                        </div>
                        <div class="logo-wrapper">
                            <img src="../assets/img/logo.png" alt="Logo Sekolah">
                        </div>
                        <div class="school-name">SMK NEGERI 2 MAGELANG</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="right-side w-100">
                    <div class="register-content">
                        <div class="user-icon">
                            <img src="../assets/img/user.png" alt="User Icon">
                        </div>
                        <h2 class="app-name">Buat Akun Baru</h2>

                        <!-- Tampilkan pesan error/success -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show w-100 text-center" role="alert">
                                <?php 
                                $error = $_GET['error'];
                                if ($error == 'empty') echo "Semua field wajib diisi!";
                                elseif ($error == 'username_taken') echo "Username sudah digunakan. Silakan pilih yang lain.";
                                elseif ($error == 'password_mismatch') echo "Password dan konfirmasi password tidak cocok!";
                                elseif ($error == 'password_weak') echo "Password minimal 6 karakter!";
                                elseif ($error == 'db_error') echo "Terjadi kesalahan database. Silakan coba lagi.";
                                else echo "Registrasi gagal. Periksa kembali data Anda.";
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                            <div class="alert alert-success alert-dismissible fade show w-100 text-center" role="alert">
                                Registrasi berhasil! Silakan <a href="login.php" class="alert-link">login</a>.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="../modules/register_process.php" method="POST">
                            <div class="input-group-custom">
                                <input type="text" name="username" class="form-control custom-input" placeholder="Username" required  autocomplete="off">
                            </div>
                            <div class="input-group-custom">
                                <input type="password" name="password" class="form-control custom-input" placeholder="Password" required autocomplete="off">
                            </div>
                            <div class="input-group-custom">
                                <input type="password" name="confirm_password" class="form-control custom-input" placeholder="Konfirmasi Password" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn-register">Daftar</button>
                        </form>

                        <div class="login-text">
                            <span>Sudah punya akun?</span>
                            <a href="login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>