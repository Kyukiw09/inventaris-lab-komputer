<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/register.php");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (empty($username) || empty($password) || empty($confirm_password)) {
    header("Location: ../views/register.php?error=empty");
    exit;
}

if ($password !== $confirm_password) {
    header("Location: ../views/register.php?error=password_mismatch");
    exit;
}

if (strlen($password) < 6) {
    header("Location: ../views/register.php?error=password_weak");
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "SELECT id_user FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    header("Location: ../views/register.php?error=username_taken");
    exit;
}
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../views/register.php?success=1");
    exit;
} else {
    header("Location: ../views/register.php?error=db_error");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>