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
    <title>Login - SKANIDALAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>

<div class="login-wrapper">
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

                        <div class="school-name">
                            SMK NEGERI 2 MAGELANG
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="right-side w-100">

                    <div class="login-content">

                        <div class="user-icon">
                            <img src="../assets/img/user.png" alt="User Icon">
                        </div>

                        <h2 class="app-name">SKANIDALAB</h2>

                        <form action="../modules/login_process.php" method="POST">

                            <div class="input-group-custom">
                                <input type="text" name="username" class="form-control custom-input" placeholder="Username" required autocomplete="off">
                            </div>

                            <div class="input-group-custom">
                                <input type="password" name="password" class="form-control custom-input" placeholder="Password" required autocomplete="off">
                            </div>

                            <button type="submit" class="btn-login">Login</button>

                        </form>

                        <div class="register-text">
                            <span>Belum punya akun?</span>
                            <a href="register.php">Daftar</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>