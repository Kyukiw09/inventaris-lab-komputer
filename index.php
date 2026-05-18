<?php

session_start();

if (isset($_SESSION['login'])) {
    header("Location: views/dashboard.php");
    exit;
} else {
    header("Location: views/login.php");
    exit;
}