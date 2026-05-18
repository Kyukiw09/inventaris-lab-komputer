<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/login.php");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    header("Location: ../views/login.php?error=empty");
    exit;
}

// Gunakan prepared statement
$stmt = mysqli_prepare($conn, "SELECT id_user, username, password FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    header("Location: ../views/dashboard.php");
    exit;
} else {
    header("Location: ../views/login.php?error=not_found");
    exit;
}
?>